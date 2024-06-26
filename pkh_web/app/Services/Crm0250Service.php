<?php

namespace App\Services;

use DB;

/**
 * Crm0250Service class
 */
class Crm0250Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
              e.name as group_area_name
              , e.payment_day
              , coalesce(c.name, '') area1
              , coalesce(d.name, '') area2
              , b.store_id
              , b.name as store_name
              , b.address as store_address
              , b.level
              , b.contact_tel
              , b.contact_mobile1
              , f.order_date
              , f.store_order_code
              , f.store_order_id
              , h.store_delivery_id
              , a.delivery_date
              , DATE_ADD(a.delivery_date, interval coalesce(e.payment_day,3) day) delivery_date_deadline
              , h.total_with_discount
              , h.delivery_sts
              , h.salesman_id
              , h.store_delivery_code
              , g.name salesman_name
              , a.payment_start
              , a.payment_end
              , a.payment_date
              , a.remain_amount
              , a.sts
              , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day as delay
              , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date ) days
            from
              trn_store_payment_status a
              left join mst_store b
                on a.store_id = b.store_id
              left join mst_area c
                on b.area1 = c.area_id
              left join mst_area d
                on b.area2 = d.area_id
              left join mst_area_group e
                on c.area_group_id = e.area_group_id
              left join trn_store_delivery h
                on h.store_delivery_id = a.store_delivery_id
              left join trn_store_order f
                on h.store_order_id = f.store_order_id
              left join users g
                on h.salesman_id = g.id
              where
                h.delivery_sts != '5'
        ";
        $sql .= $this->andWhereInt($param, 'store_id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereString($param, 'sts', 'a.sts', $sqlParam, true);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'h.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'level', 'b.level', $sqlParam);

        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        // $sql .= $this->andWhereIntOperator($param, 'days', 'DATEDIFF(now(), a.in_date)', $sqlParam, ">=");
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);

        if (isset($param["delay"])) {

            if ('1' == $param["delay"]) {
                $sql .= ' and DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day between 1 and 7 ';
            } elseif ('2' == $param["delay"]) {
                $sql .= ' and DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day between 8 and 15 ';
            } elseif ('3' == $param["delay"]) {
                $sql .= ' and DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day between 16 and 23 ';
            } elseif ('4' == $param["delay"]) {
                $sql .= ' and DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day between 24 and 30 ';
            }

            if ('5' == $param["delay"]) {
                $sql .= ' and DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day > 30 ';
            }

        }

// $sql .= "

//     order by

//       e.name

//       , c.name

//       , d.name

//       , b.name

//       , b.store_id

//       , a.delivery_date
        // ";

        $sql .= "
            order by
              a.delivery_date desc
        ";

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $type
     */
    public function selectStatistic($type)
    {
        $sqlParam = array();
        $sql      = "
        select
        aa.category,
        count(distinct aa.store_id) as num_store,
        count(*) as num_order,
        sum(aa.total_with_discount) as amount
        from
        (			select
                    e.name as group_area_name
                      , e.payment_day
                      , coalesce(c.name, '') area1
                      , coalesce(d.name, '') area2
                      , b.store_id
                      , b.name as store_name
                      , b.address as store_address
                      , f.order_date
                      , f.store_order_code
                      , f.store_order_id
                      , h.store_delivery_id
                      , a.delivery_date
                      , DATE_ADD(a.delivery_date, interval coalesce(e.payment_day,3) day) delivery_date_deadline
                      , h.total_with_discount
                      , h.delivery_sts
                      , h.salesman_id
                      , h.store_delivery_code
                      , g.name salesman_name
                      , a.payment_start
                      , a.payment_end
                      , a.payment_date
                      , a.remain_amount
                      , a.sts
                      , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day as delay
                      , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date ) days
                    , case
                  when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <=7 then 1
                  when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >8  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 15 then 2
                          when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >16  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 23 then 3
                          when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >24  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 30 then 4
                          else 5
              end as category
                    from
                      trn_store_payment_status a
                      left join mst_store b
                        on a.store_id = b.store_id
                      left join mst_area c
                        on b.area1 = c.area_id
                      left join mst_area d
                        on b.area2 = d.area_id
                      left join mst_area_group e
                        on c.area_group_id = e.area_group_id
                      left join trn_store_delivery h
                        on h.store_delivery_id = a.store_delivery_id
                      left join trn_store_order f
                        on h.store_order_id = f.store_order_id
                      left join users g
                        on b.salesman_id = g.id
                      where
                        h.delivery_sts != '5' and
                        DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day > 0
                        and a.sts =  ?
                        ) as aa
          group by
            aa.category
        ";

        $sqlParam[] = $type;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectStatistic2()
    {
        $sqlParam = array();
        $sql      = "
        select
        aa.salesman_name,
    count(distinct aa.store_id) as num_store,
    count(*) as num_order,
    sum(aa.total_with_discount) as amount
    from
    (			select
                e.name as group_area_name
                  , e.payment_day
                  , coalesce(c.name, '') area1
                  , coalesce(d.name, '') area2
                  , b.store_id
                  , b.name as store_name
                  , b.address as store_address
                  , f.order_date
                  , f.store_order_code
                  , f.store_order_id
                  , h.store_delivery_id
                  , a.delivery_date
                  , DATE_ADD(a.delivery_date, interval coalesce(e.payment_day,3) day) delivery_date_deadline
                  , h.total_with_discount
                  , h.delivery_sts
                  , h.salesman_id
                  , h.store_delivery_code
                  , g.name salesman_name
                  , a.payment_start
                  , a.payment_end
                  , a.payment_date
                  , a.remain_amount
                  , a.sts
                  , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day as delay
                  , DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date ) days
                , case
              when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <=7 then 1
              when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >8  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 15 then 2
                      when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >16  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 23 then 3
                      when DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day >24  and DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day <= 30 then 4
                      else 5
          end as category
                from
                  trn_store_payment_status a
                  left join mst_store b
                    on a.store_id = b.store_id
                  left join mst_area c
                    on b.area1 = c.area_id
                  left join mst_area d
                    on b.area2 = d.area_id
                  left join mst_area_group e
                    on c.area_group_id = e.area_group_id
                  left join trn_store_delivery h
                    on h.store_delivery_id = a.store_delivery_id
                  left join trn_store_order f
                    on h.store_order_id = f.store_order_id
                  left join users g
                    on b.salesman_id = g.id
                  where
                    h.delivery_sts != '5' and
                    DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day > 0
                    and a.sts =  '0'
                    ) as aa
      group by
        aa.salesman_name
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListStore($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                b.store_id
              , b.name as store_name
              , b.address as store_address
              , b.level
              , g.name as salesman_name
              , AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) as avg_delay
              , sum(remain_amount)  as remain_amount
              , count(*) as number_order
            from
              trn_store_payment_status a
              left join mst_store b
                on a.store_id = b.store_id
              left join mst_area c
                on b.area1 = c.area_id
              left join mst_area d
                on b.area2 = d.area_id
              left join mst_area_group e
                on c.area_group_id = e.area_group_id
              left join trn_store_delivery h
                on h.store_delivery_id = a.store_delivery_id
              left join trn_store_order f
                on h.store_order_id = f.store_order_id
              left join users g
                on b.salesman_id = g.id
              where
                h.delivery_sts != '5' and
                DATEDIFF(coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day > 0
                and a.sts = '0'
        ";
        $sql .= $this->andWhereInt($param, 'level', 'b.level', $sqlParam);
        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= "
        group by
          b.store_id
          , b.name
          ,b.address
          , g.name";

        if (isset($param["delay"])) {

            if ('1' == $param["delay"]) {
                $sql .= ' Having  AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) between 1 and 7 ';
            } elseif ('2' == $param["delay"]) {
                $sql .= '  Having AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) between 8 and 15 ';
            } elseif ('3' == $param["delay"]) {
                $sql .= '  Having AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) between 16 and 23 ';
            } elseif ('4' == $param["delay"]) {
                $sql .= '  Having AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) between 24 and 30 ';
            }

            if ('5' == $param["delay"]) {
                $sql .= '  Having AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) > 30 ';
            }

        }

        $sql .= "
        order by
          AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date )  -  e.payment_day) desc
        ";
        // $sqlParam[] = $payment_id;
        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
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

        $fileName = "SoNgayCongNo_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('SoNgayTonkho', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0912-list')
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

}
