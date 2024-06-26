<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;

// use App\Models\TrnStoreDeliveryDetail;

/**
 * Undocumented class
 */
class Crm0220Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {

        if ("1" == $param["search_type"]) {
            return $this->selectListByProduct($param);
        }

        return $this->selectListByBill($param);
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListByProduct($param)
    {
        $sqlParam = array();
        $sql      = "select
              a.store_order_id
              , b.store_order_code
              , e.product_code
              , e.name product_name
              , c.store_id
              , c.name store_name
              , a.order_amount
              , a.delivery_amount
              , f.unit_price
              , b.salesman_id
              , d.name salesman_name
              , b.order_date
            from
              (
                select
                  a.store_order_id
                  , a.product_id
                  , a.amount as order_amount
                  , sum(coalesce(b.amount, 0)) as delivery_amount
                from
                  (
                    select
                      a.store_order_id
                      , a.product_id
                      , a.amount
                    from
                      trn_store_order_detail a join trn_store_order b
                        on a.store_order_id = b.store_order_id
                        and b.order_sts in ('0', '1', '2', '4')
                  ) a
                  left join (
                    select
                      b.store_order_id
                      , a.product_id
                      , sum(a.amount) amount
                    from
                      trn_store_delivery_detail a join trn_store_delivery b
                        on a.store_delivery_id = b.store_delivery_id
                        and b.delivery_sts IN ( '1', '4','8','9')
                    group by
                      b.store_order_id
                      , a.product_id
                  ) b
                    on a.store_order_id = b.store_order_id
                    and a.product_id = b.product_id
                group by
                  a.store_order_id
                  , a.product_id
                having
                  a.amount != sum(coalesce(b.amount, 0))
              ) a join trn_store_order b
                on a.store_order_id = b.store_order_id join mst_store c
                on c.store_id = b.store_id
              left join users d
                on b.salesman_id = d.id
              left join mst_product e
                on e.product_id = a.product_id
              left join trn_store_order_detail f
                on f.store_order_id = a.store_order_id
                and f.product_id = a.product_id
              where 1 = 1
            ";

        $sql .= $this->andWhereDateInMonthOfString($param, 'month', 'b.order_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_order_code', 'b.store_order_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'e.product_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'c.salesman_id', $sqlParam);

        $sql .= " order by
              b.order_date desc
              , b.store_order_code";

        $result = null;
        if (isset($param["download"]) && 1 == $param["download"]) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListByBill($param)
    {
        $sqlParam = array();
        $sql      = "
      select
        store_order_id
        , store_order_code
        , store_id
        , store_name
        , salesman_id
        , salesman_name
        , order_date
      from
        (
          select
            a.store_order_id
            , b.store_order_code
            , e.product_code
            , e.name product_name
            , c.store_id
            , c.name store_name
            , a.order_amount
            , a.delivery_amount
            , f.unit_price
            , b.salesman_id
            , d.name salesman_name
            , b.order_date
          from
            (
              select
                a.store_order_id
                , a.product_id
                , a.amount as order_amount
                , sum(coalesce(b.amount, 0)) as delivery_amount
              from
                (
                  select
                    a.store_order_id
                    , a.product_id
                    , a.amount
                  from
                    trn_store_order_detail a join trn_store_order b
                      on a.store_order_id = b.store_order_id
                      and b.order_sts in ('0', '1', '2', '4')
                ) a
                left join (
                  select
                    b.store_order_id
                    , a.product_id
                    , sum(a.amount) amount
                  from
                    trn_store_delivery_detail a join trn_store_delivery b
                      on a.store_delivery_id = b.store_delivery_id
                      and b.delivery_sts IN ('1', '4','8','9')
                  group by
                    b.store_order_id
                    , a.product_id
                ) b
                  on a.store_order_id = b.store_order_id
                  and a.product_id = b.product_id
              group by
                a.store_order_id
                , a.product_id
              having
                a.amount != sum(coalesce(b.amount, 0))
            ) a join trn_store_order b
              on a.store_order_id = b.store_order_id join mst_store c
              on c.store_id = b.store_id
            left join users d
              on b.salesman_id = d.id
            left join mst_product e
              on e.product_id = a.product_id
            left join trn_store_order_detail f
              on f.store_order_id = a.store_order_id
              and f.product_id = a.product_id
          where
            1 = 1";

        $sql .= $this->andWhereDateInMonthOfString($param, 'month', 'b.order_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_order_code', 'b.store_order_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'e.product_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'c.salesman_id', $sqlParam);

        $sql .= "
        ) temp
      group by
        store_order_id
        , store_order_code
        , store_id
        , store_name
        , salesman_id
        , salesman_name
        , order_date
    ";

        $sql .= " order by
          order_date desc
          , store_order_code";

        $result = null;
        if (isset($param["download"]) && 1 == $param["download"]) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

    /**
     * Download excel
     *
     * @return void
     */
    public function download($param)
    {
        $param["download"] = 1;
        $data              = $this->selectList($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "KiemDonHang_" . date('ymdhis');
        $ext      = "xlsx";

        $viewName = 'admin.excels.crm0220-list-bill';

        if ("1" == $param['search_type']) {
            $viewName = 'admin.excels.crm0220-list';
        }

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('KiemDonHang', function ($sheet) use ($data) {
                $sheet->loadView($viewName)
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
        ];

        return $result;
    }

}
