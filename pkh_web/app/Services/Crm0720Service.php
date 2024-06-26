<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use Carbon\Carbon;

class Crm0720Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        // $sqlParam = array();
        $date       = Carbon::createFromFormat('Y-m-d', substr($param['month'], 0, 7) . '-01');
        $endOfMonth = $date->endOfMonth();
        $sqlParam   = [
            $date->startOfMonth()->format('Y-m-d'),
            $date->startOfMonth()->format('Y-m-d'),
            $date->startOfMonth()->format('Y-m-d'),
            $date->endOfMonth()->format('Y-m-d'),
            $date->startOfMonth()->format('Y-m-d'),
            $date->endOfMonth()->format('Y-m-d'),
        ];

        $sql = "
                select
                  a.store_id
                  , a.name
                  , w.name salesman_name
                  , a.address
                  , a.accountant_store_id
                  , b.total total_lastmonth
                  , b.total_with_discount total_with_discount_lastmonth
                  , coalesce(c.payment_money, 0) payment_lastmonth
                  , coalesce(d.total, 0) total_thismonth
                  , coalesce(d.total_with_discount, 0) total_with_discount_thismonth
                  , coalesce(e.payment_money, 0) payment_thismonth
                  , coalesce(e.payment_money_plus, 0) payment_plus_thismonth
                  , coalesce(e.payment_money_minus, 0) payment_minus_thismonth

                from
                  mst_store a
                  left join users w on
                   a.salesman_id = w.id
                   join (
                    select
                      a.store_id
                      , sum(a.total) total
                      , sum(a.total_with_discount) total_with_discount
                    from
                      trn_store_delivery a
                    where
                      a.delivery_date < ?
                      and a.delivery_sts in (1,4,8,9)
                      and a.active_flg = '1'
                      and a.order_type = 1
                    group by
                      store_id
                  ) b
                    on a.store_id = b.store_id
                  left join (
                    select
                      a.store_id
                      , sum(a.payment_money) payment_money
                    from
                      trn_payment a
                    where
                      a.payment_date < ?
                      and a.active_flg = '1'
                    group by
                      store_id
                  ) c
                    on a.store_id = c.store_id
                  left join (
                    select
                      a.store_id
                      , sum(a.total) total
                      , sum(a.total_with_discount) total_with_discount
                    from
                      trn_store_delivery a
                    where
                      a.delivery_date between ? and ?
                      and a.delivery_sts in (1,4,8,9)
                      and a.active_flg = '1'
                       and a.order_type = 1
                    group by
                      store_id
                  ) d
                    on a.store_id = d.store_id
                  left join (
                    select
                      a.store_id
                      , sum(case when a.payment_type = 0 or a.payment_type = 1 then a.payment_money else 0 end) payment_money
                      , sum(case when a.payment_type = 3 then a.payment_money else 0 end) payment_money_plus
                      , sum(case when a.payment_type = 4 then a.payment_money else 0 end) payment_money_minus
                    from
                      trn_payment a
                    where
                      a.payment_date between ? and ?
                      and a.active_flg = '1'
                    group by
                      store_id
                  ) e
                    on a.store_id = e.store_id
                where a.first_order is not null
        ";
        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);

        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'accountant_store_id', 'a.accountant_store_id', $sqlParam);

// $result = array();

        if (isset($param["filter_type"]) && '1' == $param["filter_type"]) {
            $sql .= " and (b.total_with_discount - coalesce(c.payment_money, 0) + coalesce(d.total_with_discount, 0) - coalesce(e.payment_money, 0) - coalesce(e.payment_money_plus, 0) - coalesce(e.payment_money_minus, 0)) > 0 ";
            $sql .= " order by (b.total_with_discount - coalesce(c.payment_money, 0) + coalesce(d.total_with_discount, 0) - coalesce(e.payment_money, 0) - coalesce(e.payment_money_plus, 0) - coalesce(e.payment_money_minus, 0)) desc";
        } elseif (isset($param["filter_type"]) && '2' == $param["filter_type"]) {
            $sql .= " and (b.total_with_discount - coalesce(c.payment_money, 0) + coalesce(d.total_with_discount, 0) - coalesce(e.payment_money, 0) - coalesce(e.payment_money_plus, 0) - coalesce(e.payment_money_minus, 0)) < 0 ";
            $sql .= " order by (b.total_with_discount - coalesce(c.payment_money, 0) + coalesce(d.total_with_discount, 0) - coalesce(e.payment_money, 0) - coalesce(e.payment_money_plus, 0) - coalesce(e.payment_money_minus, 0)) ";
        }

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        $pagingData = $this->pagination($sql, $sqlParam, $param);

        $summary = $this->getSummary($sql, $sqlParam);

        return [
          "data" => $pagingData,
          "summary" => $summary,
        ];
    }

    public function getSummary($sql, $sqlParam) {
      $sqlSummary = "
      select
        sum(total_lastmonth) total_lastmonth,
        sum(total_with_discount_lastmonth) total_with_discount_lastmonth,
        sum(payment_lastmonth) payment_lastmonth,
        sum(total_thismonth) total_thismonth,
        sum(total_with_discount_thismonth) total_with_discount_thismonth,
        sum(payment_thismonth) payment_thismonth,
        sum(payment_plus_thismonth) payment_plus_thismonth,
        sum(payment_minus_thismonth) payment_minus_thismonth
      from ( $sql ) as temp
      ";

      return DB::select(DB::raw($sqlSummary), $sqlParam)[0];
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $param['down'] = 1;
        $data          = $this->selectList($param);
        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "TheoDoiCongNo_" . date('ymdhis');
        $ext      = "xlsx";
        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('CongNo', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0720-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);
        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));
        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

    /**
     * @param $param
     */
    public function getDeliveryForStore($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.store_delivery_id
            , a.store_order_id
            , a.store_id
            , a.delivery_date
            , a.discount_1
            , a.discount_2
            , a.total
            , a.total_with_discount
            , a.salesman_id
            , b.name salesman_name
          from
            trn_store_delivery a
            left join users b
              on a.salesman_id = b.id
          where
            a.active_flg = 1
            and a.delivery_sts in ('1','4','8','9')
            and a.delivery_time is not null
            and a.order_type = 1
    ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= "
          order by  a.delivery_date asc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function getPaymentForStore($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.payment_id
            , a.salesman_id
            , a.store_id
            , a.payment_date
            , a.payment_money
          from
            trn_payment a
          where
            a.active_flg =1
    ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= "
          order by  a.payment_date asc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
