<?php

namespace App\Services;

use DB;

/**
 * Rpt0514Service class
 */
class Rpt0514Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectMonth($param)
    {
        $sqlParam = array();
        $sql      = "
        select
        month(a.delivery_time) as month 
        from 
        trn_store_delivery a
        where 
        a.delivery_time is not null
        group by 
        month(a.delivery_time)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

     /**
     * @param $param
     * @return mixed
     */
    public function selectYear($param)
    {
        $sqlParam = array();
        $sql      = "
        select
        year(a.delivery_time) as year 
        from 
        trn_store_delivery a
        where 
        a.delivery_time is not null
        group by 
        year(a.delivery_time)


        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

     /**
     * @param $param
     * @return mixed
     */
    public function selectStoreTurnover($param)
    {
        $sqlParam = array();
        $sql      = "
        select 
            a.store_id
            ,month(a.delivery_time) as month 
            , year(a.delivery_time) as year
            , sum(a.total_with_discount)/1000 as amount
        from 
            trn_store_delivery a left join users b
            on a.salesman_id = b.id 
        where 
            a.delivery_sts in ('9','4','1','8') and a.order_type = 1  ";
            // and a.store_id = 1124
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql.= " group by 
            a.store_id
            ,month(a.delivery_time)
            , year(a.delivery_time)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

      /**
     * @param $param
     * @return mixed
     */
    public function selectStoreCheckin($param)
    {
        $sqlParam = array();
        $sql      = "
        select 
            a.store_id
            ,month(a.created_at) as month 
            , year(a.created_at) as year
            , count(*) as amount
        from 
        trn_store_check_in a
        where 
        a.active_flg = '1' 
        ";
            // and a.store_id = 1124
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql.= " group by 
        a.store_id
        ,month(a.created_at)
        , year(a.created_at)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }


      /**
     * @param $param
     * @return mixed
     */
    public function selectStoreCS($param)
    {
        $sqlParam = array();
        $sql      = "
        select 
            a.store_id
            ,month(a.created_at) as month 
            , year(a.created_at) as year
            , count(*) as amount
        from 
        trn_cs_notes a
        where 
        a.active_flg = '1' 
        ";
            // and a.store_id = 1124
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql.= " group by 
        a.store_id
        ,month(a.created_at)
        , year(a.created_at)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

        /**
     * @param $param
     * @return mixed
     */
    public function selectStorePaymentStatus($param)
    {
        $sqlParam = array();
        $sql      = "
        select 
        a.store_id
        , month(a.delivery_date) as month 
        , year(a.delivery_date) as year
        , avg(datediff(a.payment_date,a.delivery_date)) as amount
        from 
        trn_store_payment_status a
        where 
        a.active_flg = '1'
        ";
            // and a.store_id = 1124
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql.= " group by 
        a.store_id
        , month(a.delivery_date)
        , year(a.delivery_date)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

       /**
     * @param $param
     * @return mixed
     */
    public function selectStorePaymentCK($param)
    {
        $sqlParam = array();
        $sql      = "
        select 
        a.store_id 
        , month(a.payment_date) as month
        , year(a.payment_date)  as year
        , sum(
           case when a.payment_type =1 then a.payment_money else 0 
           end
          )/sum(a.payment_money) *100  as amount
        from
        trn_payment  a
        where 
        a.payment_type in ('0','1')
        ";
            // and a.store_id = 1124
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql.= " group by 
        a.store_id 
        , month(a.payment_date)
        , year(a.payment_date)

        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }


    /**
     * @param $param
     * @return mixed
     */
    public function loadStoreDelivery($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            aa.yearmonth
            ,  coalesce(bb.total,0) as total
        from
            (
            select
                case
                    when a.id<10 then
                        concat(year(now()),'-0', a.id)
                    else
                        concat(year(now()),'-', a.id)
                end as yearmonth
            from
                users a
            where
                a.id between 1 and 12
            ) aa left join
            (
                select
                    DATE_FORMAT(a.delivery_time, '%Y-%m') as yearmonth
                    , sum(a.total_with_discount) as total
                from
                    trn_store_delivery a
                where
                    a.order_type = 1
                    and a.delivery_sts in ('9', '1', '4', '8') ";
        $sql .= $this->andWhereInt($param, "year", "year(a.delivery_time)", $sqlParam);
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);
        $sql .= " group by
                    DATE_FORMAT(a.delivery_time, '%Y-%m')
                order by
                    a.delivery_time
            ) bb on aa.yearmonth = bb.yearmonth ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $name
     * @param $data
     * @return mixed
     */
    private function process(
        $name,
        $data
    ) {
        $res = [];

        foreach (range(1, 13) as $month) {
            array_push($res, 0);
        }

        $res['Name'] = $name;

        foreach ($data as $obj) {
            $res[$obj->month] = $obj->amount;
        }

        return $res;
    }

    /**
     * @param $param
     */
    public function loadOverview($param)
    {
        $list_res = [];
        $col0     = ['Del', 'Pay'];
        $header   = ['Name'];

        foreach (range(1, 12) as $month) {
            array_push($header, $month);
        }

        $del  = $this->loadDeliveryForStore($param);
        $data = $this->process("DEL", $del);
        array_push($list_res, $data);

        return [
            'header' => $header,
            'data'   => $data,
        ];
    }

}
