<?php

namespace App\Services;

use DB;

/**
 * Rpt0512Service class
 */
class Rpt0512Service extends BaseService
{
    /**
     * @param $param
     */
    public function loadDataOverview($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                bb1.area_id,
                bb1.name ,
                bb1.sum,
                bb1.Y2016,
                bb1.Y2016_discount,
                bb1.Y2017,
                bb1.Y2017_discount,
                bb1.Y2018,
                bb1.Y2018_discount,
                bb1.Y2019,
                bb1.Y2019_discount,
                bb1.total
        from
        (
        (select
        b.area_id,
        b.name,
        count(distinct a.store_id) as sum
        ,sum(case when year(d.delivery_time) = 2016 then d.total else 0 end) as Y2016
        ,sum(case when year(d.delivery_time) = 2016 then d.total_with_discount else 0 end) as Y2016_discount
        ,sum(case when year(d.delivery_time) = 2017 then d.total else 0 end) as Y2017
        ,sum(case when year(d.delivery_time) = 2017 then d.total_with_discount else 0 end) as Y2017_discount
        ,sum(case when year(d.delivery_time) = 2018 then d.total else 0 end) as Y2018
        ,sum(case when year(d.delivery_time) = 2018 then d.total_with_discount else 0 end) as Y2018_discount
        ,sum(case when year(d.delivery_time) = 2019 then d.total else 0 end) as Y2019
        ,sum(case when year(d.delivery_time) = 2019 then d.total_with_discount else 0 end) as Y2019_discount
        , sum(d.total_with_discount) as total
        from
        mst_store a
        left join mst_area b
        on a.area1 = b.area_id
        left join mst_area_group c on c.area_group_id = b.area_group_id
        left join trn_store_delivery d on a.store_id = d.store_id
        where
        a.first_order is not null  and b.area_id <>1 and d.delivery_sts in ('1','4','8','9') and d.order_type = 1
        group by
        b.area_id,
        b.name
        )
        union
        (
        select
        b.area_id,
        b.name,
        count(distinct a.store_id) as sum
        ,sum(case when year(d.delivery_time) = 2016 then d.total else 0 end) as Y2016
        ,sum(case when year(d.delivery_time) = 2016 then d.total_with_discount else 0 end) as Y2016_discount
        ,sum(case when year(d.delivery_time) = 2017 then d.total else 0 end) as Y2017
        ,sum(case when year(d.delivery_time) = 2017 then d.total_with_discount else 0 end) as Y2017_discount
        ,sum(case when year(d.delivery_time) = 2018 then d.total else 0 end) as Y2018
        ,sum(case when year(d.delivery_time) = 2018 then d.total_with_discount else 0 end) as Y2018_discount
        ,sum(case when year(d.delivery_time) = 2019 then d.total else 0 end) as Y2019
        ,sum(case when year(d.delivery_time) = 2019 then d.total_with_discount else 0 end) as Y2019_discount
        , sum(d.total_with_discount) as total
        from
        mst_store a
        left join mst_area b
        on a.area2 = b.area_id
        left join trn_store_delivery d on a.store_id = d.store_id
        where
        a.first_order is not null  and b.parent_area_id  = 1  and d.delivery_sts in ('1','4','8','9') and d.order_type = 1
        group by
        b.area_id,
        b.name
        )
        ) bb1
        order by bb1.total desc
        ";
        $sql .= $this->andWhereString($param, 'store_name', 'bb1.store_name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area_id', 'bb1.area_id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab1_1(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        (select
            c.area_id as id,
            c.name as Name,
            year(a.delivery_time) as year,
            sum( a.total_with_discount)/1000 as sum,
            sum( a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.delivery_time) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_delivery a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area1
        where
            a.delivery_time  is not NULL and
            a.delivery_sts in ('1','4','8','9') and a.order_type = 1  and c.area_id <>1
             ";

        if ($flag) {
            $sql .= " and year(a.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.delivery_time)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.delivery_time)

        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.delivery_time)
            ";
        }

        $sql .= "
       ) union
        ( select
            c.area_id as id,
            c.name as Name,
            year(a.delivery_time) as year,
            sum( a.total_with_discount)/1000 as sum ,
            sum( a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.delivery_time) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_delivery a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area2

        where
            a.delivery_time  is not NULL and
            a.delivery_sts in ('1','4','8','9') and a.order_type = 1  and c.parent_area_id = 1
             ";

        if ($flag) {
            $sql .= " and year(a.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.delivery_time)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.delivery_time)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.delivery_time)
            ";
        }

        $sql .= "
        ) ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab1_2(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        select
            d.area_group_id as id,
            d.name as Name,
            year(a.delivery_time) as year,
            sum(a.total_with_discount)/1000 as sum ,
            sum(a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.delivery_time) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_delivery a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area1
            left join mst_area_group d on c.area_group_id = d.area_group_id
        where
            a.delivery_time  is not NULL and
            a.delivery_sts in ('1','4','8','9') and a.order_type = 1
             ";

        if ($flag) {
            $sql .= " and year(a.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.delivery_time)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        $sql .= $this->andWhereInt($param, "id", "d.area_group_id", $sqlParam);

        $sql .= "
        group by
            d.area_group_id,
            d.name,
            year(a.delivery_time)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.delivery_time)
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
    public function loadDataTab2_1(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        (select
            c.area_id as id,
            c.name as Name,
            year(a.order_date) as year,
            sum(a.total_with_discount)/1000 as sum,
            sum(a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.order_date) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_order a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area1
        where
            a.order_date  is not NULL
            and a.order_sts in ('0','1','2','4')
            and a.order_type = 1  and c.area_id <>1
             ";

        if ($flag) {
            $sql .= " and year(a.order_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.order_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.order_date)

        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.order_date)
            ";
        }

        $sql .= "
       ) union
        ( select
            c.area_id as id,
            c.name as Name,
            year(a.order_date) as year,
            sum(a.total_with_discount)/1000 as sum ,
            sum(a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.order_date) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_order a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area2

        where
            a.order_date  is not NULL
            and a.order_sts in ('0','1','2','4')
            and a.order_type = 1   and c.parent_area_id = 1
             ";

        if ($flag) {
            $sql .= " and year(a.order_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.order_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.order_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.order_date)
            ";
        }

        $sql .= "
        ) ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab2_2(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        select
            d.area_group_id as id,
            d.name as Name,
            year(a.order_date) as year,
            sum(a.total_with_discount)/1000 as sum ,
            sum(a.total)/1000 as sum_1,
            count(a.total) as count,
            count(distinct a.store_id) as count_1,
            avg(a.discount_1) as avg_discount ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.order_date) as month
                ";
        }

        $sql .=
            "
        from
            trn_store_order a
            left join mst_store b on a.store_id = b.store_id
            left join mst_area c on c.area_id = b.area1
            left join mst_area_group d on c.area_group_id = d.area_group_id
        where
            a.order_date  is not NULL
            and a.order_sts in ('0','1','2','4')
            and a.order_type = 1  and a.order_type = 1
             ";

        if ($flag) {
            $sql .= " and year(a.order_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.order_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        $sql .= $this->andWhereInt($param, "id", "d.area_group_id", $sqlParam);

        $sql .= "
        group by
            d.area_group_id,
            d.name,
            year(a.order_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.order_date)
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
    public function loadDataTab3_1(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        (  select
                c.area_id as id,
                c.name as Name
                , year(a.payment_date) as year
                , sum(a.payment_money)/1000 as sum
                , count(a.payment_money) as count ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.payment_date) as month
                ";
        }

        $sql .=
            "
        from
            trn_payment  a left join mst_store b
            on a.store_id = b.store_id
            left join mst_area c
            on b.area1 = c.area_id
        where
            a.payment_date  is not NULL
            and a.payment_type in (0,1) and c.area_id <>1
             ";

        if ($flag) {
            $sql .= " and year(a.payment_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.payment_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.payment_date)

        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.payment_date)
            ";
        }

        $sql .= "
       ) union
        ( select
            c.area_id as id,
            c.name as Name
            , year(a.payment_date) as year
            , sum(a.payment_money)/1000 as sum
            , count(a.payment_money) as count ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.payment_date) as month
                ";
        }

        $sql .=
            "
        from
            trn_payment  a left join mst_store b
            on a.store_id = b.store_id
            left join mst_area c
            on b.area2 = c.area_id
        where
            a.payment_date  is not NULL
            and a.payment_type in (0,1) and c.parent_area_id = 1
             ";

        if ($flag) {
            $sql .= " and year(a.payment_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "c.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.payment_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "c.area_group_id", $sqlParam);

        $sql .= "
        group by
            c.area_id,
            c.name,
            year(a.payment_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.payment_date)
            ";
        }

        $sql .= "
        ) ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab3_2(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        select
            e.area_group_id as id,
            e.name as Name
            , year(a.payment_date) as year
            , sum(a.payment_money)/1000 as sum
            , count(a.payment_money) as count ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(a.payment_date) as month
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

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.payment_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        $sql .= $this->andWhereInt($param, "id", "d.area_group_id", $sqlParam);

        $sql .= "
        group by
            e.area_group_id,
            e.name,
            year(a.payment_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(a.payment_date)
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
    public function loadDataTab5(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        (select
            b.area_id as id,
            b.name as Name,
            year(a.first_order) as year,
            count(*) as sum ";

        if (0 == $time_mode) {
            $sql .= "
                , month(a.first_order) as month
                ";
        }

        $sql .= "
        from
            mst_store a
            left join mst_area b
            on a.area1 = b.area_id
            left join mst_area_group c on c.area_group_id = b.area_group_id
        where
            a.first_order is not null  and b.area_id <>1
             ";

        if ($flag) {
            $sql .= " and year(a.first_order) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "b.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.first_order)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "b.area_group_id", $sqlParam);

        $sql .= "
        group by
            b.area_id,
            b.name,
            year(a.first_order)
        ";

        if (0 == $time_mode) {
            $sql .= "
            , month(a.first_order)
            ";
        }

        $sql .= "
        ) union
        ( select
            b.area_id as id,
            b.name as Name,
            year(a.first_order) as year,
            count(*) as sum  ";

        if (0 == $time_mode) {
            $sql .= "
                , month(a.first_order) as month
                ";
        }

        $sql .=
            "
        from
            mst_store a
            left join mst_area b
            on a.area2 = b.area_id
        where
            a.first_order is not null  and b.parent_area_id  = 1
             ";

        if ($flag) {
            $sql .= " and year(a.first_order) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "b.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(a.first_order)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "b.area_group_id", $sqlParam);

        $sql .= "
        group by
            b.area_id,
            b.name,
            year(a.first_order)
        ";

        if (0 == $time_mode) {
            $sql .= "
            , month(a.first_order)
            ";
        }

        $sql .= " ) ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab6_1(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();

        $sql = "
        (  select
                e.area_id as id,
                e.name as Name
                , sum(b.amount*a.selling_price)/1000 as sum
                , year(c.import_date) as year  ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(c.import_date) as month
                ";
        }

        $sql .=
            "
        from
            mst_product a
            left join trn_import_wh_store_detail b on a.product_id = b.product_id
            left join trn_import_wh_store  c on (b.import_wh_store_id = c.import_wh_store_id  )
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id
        where
            a.selling_price > 0 and e.area_id <>1
             ";

        if ($flag) {
            $sql .= " and year(c.import_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "e.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);

        $sql .= "
        group by
            e.area_id,
            e.name,
            year(c.import_date)

        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(c.import_date)
            ";
        }

        $sql .= "
       ) union
        (  select
                e.area_id as id,
                e.name as Name
                , sum(b.amount*a.selling_price)/1000 as sum
                , year(c.import_date) as year  ";

        if (0 == $time_mode) {
            $sql .= "
                ,month(c.import_date) as month
                ";
        }

        $sql .=
            "
        from
            mst_product a
            left join trn_import_wh_store_detail b on a.product_id = b.product_id
            left join trn_import_wh_store  c on (b.import_wh_store_id = c.import_wh_store_id  )
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area2 = e.area_id
        where
            a.selling_price > 0 and e.parent_area_id = 1
             ";

        if ($flag) {
            $sql .= " and year(c.import_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "e.area_id", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);

        $sql .= "
        group by
            e.area_id,
            e.name,
            year(c.import_date)
        ";

        if (0 == $time_mode) {
            $sql .= "
            ,month(c.import_date)
            ";
        }

        $sql .= "
        ) ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadDataTab6_2(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();

        $sql = "
            select
                e.area_group_id as id,
                e.name as Name
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
            left join mst_area_group f on e.area_group_id = f.area_group_id
        where
            a.selling_price > 0";

        if ($flag) {
            $sql .= " and year(c.import_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
            group by
                f.area_group_id
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
     * @return mixed
     */
    public function getData(
        $param,
        $flag
    ) {
        $time_mode = $param['time_mode'];

        if (1 == $param["index"]) {

            if (1 == $param["view_mode"]) {
                $data = $this->loadDataTab1_1($param, $flag, $time_mode);
            } else {
                $data = $this->loadDataTab1_2($param, $flag, $time_mode);
            }

        } elseif (2 == $param["index"]) {

            if (1 == $param["view_mode"]) {
                $data = $this->loadDataTab2_1($param, $flag, $time_mode);
            } else {
                $data = $this->loadDataTab2_2($param, $flag, $time_mode);
            }

        } elseif (3 == $param["index"]) {

            if (1 == $param["view_mode"]) {
                $data = $this->loadDataTab3_1($param, $flag, $time_mode);
            } else {
                $data = $this->loadDataTab3_2($param, $flag, $time_mode);
            }

        } elseif (5 == $param["index"]) {
            $data = $this->loadDataTab5($param, $flag, $time_mode);
        } elseif (6 == $param["index"]) {

            if (1 == $param["view_mode"]) {
                $data = $this->loadDataTab6_1($param, $flag, $time_mode);
            } else {
                $data = $this->loadDataTab6_2($param, $flag, $time_mode);
            }

        }

        $data_type = "sum";

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
     * @param $year
     * @param $x
     * @param $type
     * @return mixed
     */
    public function loadData(
        $param
    ) {

        $first_header = ["Name"];
        $last_header  = ["Total", "count", "AVG"];

        $res = $this->getData($param, false);

        $result = $this->dataProcess($param, $res['data'], $first_header, $last_header, $res['data_type']);

        return $result;

    }

}
