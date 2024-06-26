<?php

namespace App\Services;

use DB;

/**
 * Rpt0518Service class
 */
class Rpt0518Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectOverview($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            bb1.store_id,
            bb1.store_name ,
            bb1.province,
            bb1.salesman_name,
            bb1.first_order ,
            bb1.now,
            bb1.month_working,
            bb1.Y2016,
            bb1.Y2016_discount,
            bb1.Y2017,
            bb1.Y2017_discount,
            bb1.Y2018,
            bb1.Y2018_discount,
            bb1.Y2019,
            bb1.Y2019_discount,
            bb1.total,
            bb2.month_purchase
        from
                (select
                   a.store_id
                   , c.area_id
                   , b.name as store_name
                   , c.name as province
                   , d.name as salesman_name
                   , b.first_order
                   , Date(now()) as now
                   ,  TIMESTAMPDIFF(month, date(b.first_order ), Date(now())  ) as month_working
                   ,sum(case when year(a.delivery_time) = 2016 then a.total else 0 end) as Y2016
                    ,sum(case when year(a.delivery_time) = 2016 then a.total_with_discount else 0 end) as Y2016_discount
                    ,sum(case when year(a.delivery_time) = 2017 then a.total else 0 end) as Y2017
                     ,sum(case when year(a.delivery_time) = 2017 then a.total_with_discount else 0 end) as Y2017_discount
                     ,sum(case when year(a.delivery_time) = 2018 then a.total else 0 end) as Y2018
                     ,sum(case when year(a.delivery_time) = 2018 then a.total_with_discount else 0 end) as Y2018_discount
                    ,sum(case when year(a.delivery_time) = 2019 then a.total else 0 end) as Y2019
                    ,sum(case when year(a.delivery_time) = 2019 then a.total_with_discount else 0 end) as Y2019_discount
                    , sum(a.total_with_discount) as total
                   from
                        trn_store_delivery a left join mst_store b
                            on a.store_id = b.store_id
                            left join mst_area c
                            on b.area1 = c.area_id
                            left join users d on b.salesman_id = d.id
                   where
                        a.delivery_time is not NULL and a.delivery_sts in ('1','4','8','9')
                   group by
                        a.store_id,
                        b.name,
                        c.name,
                        d.name
                        , b.first_order
                   order by
                        sum(a.total) desc
                   ) bb1
                left join
                   (select
                        aa.store_id,
                        count(*) as month_purchase
                        from
                        (
                            select
                            a.store_id,
                            month(a.delivery_time) as month,
                            year(a.delivery_time) as year
                            from
                            trn_store_delivery a
                            where
                            a.delivery_time is not null and a.delivery_sts in ('1','4','8','9')
                            group by
                            a.store_id,
                            month(a.delivery_time),
                            year(a.delivery_time)
                        ) aa
                        group by
                            aa.store_id
                        order  by
                            count(*) desc
                    ) bb2 on bb1.store_id = bb2.store_id
                where
                bb1.store_id <> 0
        ";
        $sql .= $this->andWhereString($param, 'store_name', 'bb1.store_name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area_id', 'bb1.area_id', $sqlParam);

        if (1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function loadDataTab2(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id as id
            , year(a.delivery_time) as year
            , b.name as Name
            , c.name as Province
            , d.name as salesman_name
            , sum(a.total_with_discount)/1000 as sum
            , sum( a.total)/1000 as sum_1
            , count(distinct a.store_delivery_id) as count
            , avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                , month(a.delivery_time)  as month
                ";
        }

// , count(distinct f.product_id) as count_1

// left join trn_store_delivery_detail f
        // on a.store_delivery_id = f.store_delivery_id
        $sql .=
            "
        from
            trn_store_delivery a left join mst_store b
            on a.store_id = b.store_id
            left join mst_area c
            on b.area1 = c.area_id
            left join users d on b.salesman_id = d.id
            left join mst_area_group e
            on c.area_group_id  = e.area_group_id
        where
            a.delivery_time  is not NULL
            and a.delivery_sts in ('1','4','8','9')
            and a.order_type = 1 ";

        if ($flag) {
            $sql .= " and year(a.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, 'year', 'year(a.delivery_time)', $sqlParam);
        }

        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= "  group by
                        a.store_id,
                        b.name,
                        c.name,
                        d.name,
                         year(a.delivery_time)
        ";

        if (0 == $time_mode) {
            $sql .= "
            , month(a.delivery_time)
            ";
        }

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function loadDataTab3(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id as id
            , year(a.order_date) as year
            , b.name as Name
            , c.name as Province
            , d.name as salesman_name
            , sum( a.total_with_discount)/1000 as sum
            , sum( a.total)/1000 as sum_1
            , count(a.total) as count
            , avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                , month(a.order_date)  as month
                ";
        }

        $sql .= "
        from
            trn_store_order a left join mst_store b
            on a.store_id = b.store_id
            left join mst_area c
            on b.area1 = c.area_id
            left join users d on b.salesman_id = d.id
            left join mst_area_group e
            on c.area_group_id  = e.area_group_id
        where
            a.order_date  is not NULL
            and a.order_sts in ('0','1','2','4')
            and a.order_type = 1 ";

        if ($flag) {
            $sql .= " and year(a.order_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, 'year', 'year(a.order_date)', $sqlParam);
        }

        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= "  group by
                    a.store_id,
                    b.name,
                    c.name,
                    d.name
                    ,  year(a.order_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,  month(a.order_date)
            ";
        }

        return DB::select(DB::raw($sql), $sqlParam, $time_mode);
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function loadDataTab4(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id as id
            , year(a.payment_date) as year
            , b.name as Name
            , c.name as Province
            , d.name as salesman_name
            , sum(a.payment_money)/1000 as sum
            , count(a.payment_money) as count ";

        if (0 == $time_mode) {
            $sql .= "
            , month(a.payment_date)  as month
                ";
        }

        $sql .= "
        from
            trn_payment  a left join mst_store b
            on a.store_id = b.store_id
            left join mst_area c
            on b.area1 = c.area_id
            left join users d on b.salesman_id = d.id
            left join mst_area_group e
            on c.area_group_id  = e.area_group_id
        where
            a.payment_date  is not NULL
            and a.payment_type in (0,1) ";

        if ($flag) {
            $sql .= " and year(a.payment_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, 'year', 'year(a.payment_date)', $sqlParam);
        }

        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= " group by
                    a.store_id,
                    b.name,
                    c.name,
                    d.name
                    ,  year(a.payment_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,    month(a.payment_date)
            ";
        }

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab5(

        $param,
        $flag,
        $time_mode

    ) {

        $sqlParam = array();
        $sql      = "
            select
                aa.store_id as id,
                aa.store_name as Name,
                year(aa.order_date) as year,
                sum(aa.order_amount*aa.unit_price)/1000 - sum(aa.delivery_amount*aa.unit_price)/1000 as sum  ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(aa.order_date) as month
                ";
        }

        $sql .= "
            from
                (
                select
                  a.store_order_id
                  , a.product_id
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
                    left join mst_store g
                    on g.store_id = b.store_id
                    left join mst_area h
                    on g.area1 = h.area_id
                  where 1 = 1

             ";
        $sql .= $this->andWhereInt($param, 'supplier_id', 'b.supplier_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'c.salesman_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "e.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.order_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'areaGroup', 'h.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'g.area1', $sqlParam);
        // $sql .= $this->andWhereInt($param, "id", "a.product_id", $sqlParam);
        $sql .= "
        ) aa
        group by
            aa.store_id,
            aa.store_name,
            year(aa.order_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,     month(aa.order_date)
            ";
        }

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab6(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            d.store_id as id
            , d.name as Name
            , sum(b.amount*a.selling_price)/1000 as sum
            , year(c.import_date) as year ";

        if (0 == $time_mode) {
            $sql .= "   , month(c.import_date) as month ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_import_wh_store_detail b on a.product_id = b.product_id
            left join trn_import_wh_store  c on (b.import_wh_store_id = c.import_wh_store_id  )
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id
             left join mst_product_cat f on a.product_cat_id = f.product_cat_id
        where
            a.selling_price > 0
             ";

        if ($flag) {
            $sql .= " and year(c.import_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "areaGroup", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            d.store_id
            , year(c.import_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            , month(c.import_date)
            ";
        }

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab7(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            b.store_id as id
            , d.name as Name
            , sum((a.unit_price - c.purchase_price*23500 - a.unit_price *(b.discount_1 + b.discount_2)/100 )*a.amount)/1000 as sum
            , year(b.delivery_time) as year ";

        if (0 == $time_mode) {
            $sql .= "   , month(b.delivery_time) as month ";
        }

        $sql .= "
        from
            trn_store_delivery_detail a  left join
            trn_store_delivery b on a.store_delivery_id = b.store_delivery_id
            left join mst_product c on a.product_id = c.product_id
            left join mst_store d on b.store_id = d.store_id
        where
            b.delivery_sts in ('1','4','8','9')
            and b.order_type = 1
             ";

        if ($flag) {
            $sql .= " and year(b.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }
        $sql .= $this->andWhereInt($param, 'supplier_id', 'b.supplier_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "d.store_id", $sqlParam);

// $sql .= $this->andWhereInt($param, "areaGroup", "e.area_group_id", $sqlParam);

// $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);

// $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);

// $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.delivery_time) ", $sqlParam);
        }

        // $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            b.store_id
            , d.name
            , year(b.delivery_time)
        ";

        if (0 == $time_mode) {
            $sql .= "
            , month(b.delivery_time)
            ";
        }

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadPaymentData($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                a.store_id as id
                , b.name as Name
                , month(a.delivery_date) as month
                , year(a.delivery_date) as year
                , AVG(DATEDIFF( coalesce(a.payment_date, CURDATE()), a.delivery_date ) ) as sum
        from
            trn_store_payment_status a
            left join mst_store b
                        on a.store_id = b.store_id
        where
            a.sts = 1
             ";

        $sql .= $this->andWhereInt($param, 'year', 'year(a.delivery_date)', $sqlParam);

// $sqlParam[] = date("Y")-3;

// $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);

// $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        // $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);

        $sql .= "
        group by
              a.store_id
            , b.name
            , month(a.delivery_date)
            , year(a.delivery_date)
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     */
    public function loadDataTab8(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.store_id as id
            , year(a.working_time) as year
            , b.name as Name
            , c.name as Province
            , d.name as salesman_name
            , count(*) as sum
           ";

        if (0 == $time_mode) {
            $sql .= "
            , month(a.working_time) as month
                ";
        }

// , count(distinct f.product_id) as count_1

// left join trn_store_delivery_detail f
        // on a.store_delivery_id = f.store_delivery_id
        $sql .=
            "
        from
            trn_store_check_in a
            left join mst_store b
                on a.store_id = b.store_id
                left join mst_area c
                on b.area1 = c.area_id
                left join users d on b.salesman_id = d.id
                left join mst_area_group e
                on c.area_group_id  = e.area_group_id
        where
              a.active_flg = '1' ";

        if ($flag) {
            $sql .= " and year(a.working_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, 'year', 'year(a.working_time)', $sqlParam);
        }

        $sql .= $this->andWhereString($param, 'store_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'id', 'b.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= "  group by
                        a.store_id,
                        b.name,
                        c.name,
                        d.name,
                        year(a.working_time)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,      month(a.working_time)
            ";
        }

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @param $flag
     * @return mixed
     */
    public function getData(
        $param,
        $flag
    ) {

        $time_mode = $param['time_mode'];

        if (2 == $param["index"]) {
            $data = $this->loadDataTab2($param, $flag, $time_mode);
        } elseif (3 == $param["index"]) {
            $data = $this->loadDataTab3($param, $flag, $time_mode);
        } elseif (4 == $param["index"]) {
            $data = $this->loadDataTab4($param, $flag, $time_mode);
        } elseif (5 == $param["index"]) {
            $data = $this->loadDataTab5($param, $flag, $time_mode);
        } elseif (6 == $param["index"]) {
            $data = $this->loadDataTab6($param, $flag, $time_mode);
        } elseif (7 == $param["index"]) {
            $data = $this->loadDataTab7($param, $flag, $time_mode);
        } elseif (8 == $param["index"]) {
            $data = $this->loadDataTab8($param, $flag, $time_mode);
        }

        if (1 == $param["data_type"]) {
            $data_type = "sum";
        } elseif (2 == $param["data_type"]) {
            $data_type = "sum_1";
        } elseif (3 == $param["data_type"]) {
            $data_type = "count";
        } elseif (4 == $param["data_type"]) {
            $data_type = "avg_discount";
        } elseif (5 == $param["data_type"]) {
            $data_type = "count_1";
        }

        $res = [
            'data'      => $data,
            'data_type' => $data_type,
        ];

        return $res;
    }

    /**
     * @param $param
     * @param $flag
     * @return mixed
     */
    public function loadData(

        $param,
        $flag

    ) {

        $first_header = ["Name"];
        $last_header  = ["Total", "count", "AVG"];
        $res          = $this->getData($param, $flag);
        $result       = $this->dataProcess($param, $res['data'], $first_header, $last_header, $res['data_type']);

        return $result;
    }

}
