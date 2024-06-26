<?php

namespace App\Services;

use DB;
use Log;

/**
 * Rpt0513Service class
 */
class Rpt0513Service extends BaseService
{
    /**
     * @param $param
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadAmountWarrantyProductCat(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            f.product_cat_id as id
            , f.name as Name
            , sum(b.amount) as sum
            , sum(b.amount*a.selling_price)/1000 as sum_1
            , count(distinct d.store_id) as count_1
            , count(distinct e.area_id) as count_2
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

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            f.product_cat_id
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
    public function loadAmountWarrantyProduct(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id as id
            , a.product_code as Name
            , sum(b.amount) as sum
            , sum(b.amount*a.selling_price)/1000 as sum_1
            , count(distinct d.store_id) as count_1
            , count(distinct e.area_id) as count_2
            ";

        if (0 == $time_mode) {
            $sql .= " , month(c.import_date) as month ";
        }

        $sql .= "
             , year(c.import_date) as year
        from
            mst_product a
            left join trn_import_wh_store_detail b on a.product_id = b.product_id
            left join trn_import_wh_store  c on (b.import_wh_store_id = c.import_wh_store_id  )
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id
        where
            a.selling_price > 0
             ";

        if ($flag) {
            $sql .= " and year(c.import_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'handle_id', 'a.handle_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'import_type', 'c.import_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.import_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_id", $sqlParam);

        $sql .= "
        group by
            a.product_id
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
    public function loadDeliveryProductHandle(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            g.product_handle_id as id
            ,g.name as Name
            , sum(b.amount)as sum
            , sum(b.amount *  f.unit_price)/1000 as sum_1
            , count(distinct d.store_id) as count_1
            , count(distinct e.area_id) as count_2
            , year(b.changed_date) as year ";

        if (0 == $time_mode) {
            $sql .= ", month(b.changed_date) as month ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_warehouse_change b on a.product_id = b.product_id
            left join trn_store_delivery  c on b.store_delivery_id = c.store_delivery_id
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id
            left join trn_store_delivery_detail  f on ( b.store_delivery_id = f.store_delivery_id and b.product_id = f.product_id)
            left join mst_product_handle g on a.handle_id = g.product_handle_id
        where
            a.selling_price > 0
            and b.warehouse_change_type = 2
            and a.handle_id is not null
             ";

        if ($flag) {
            $sql .= " and year(b.changed_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'store_id', 'd.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "warehouse_change_type", "b.warehouse_change_type", $sqlParam);
        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.changed_date)", $sqlParam);
        }

        // $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            g.product_handle_id
            , year(b.changed_date)
        ";

        if (0 == $time_mode) {
            $sql .= "   , month(b.changed_date)";
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
    public function loadDeliveryProductCat(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            g.product_cat_id as id
            ,g.name as Name
            , sum(b.amount)as sum
            , sum(b.amount *  f.unit_price)/1000 as sum_1
            , count(distinct d.store_id) as count_1
            , count(distinct e.area_id) as count_2
            , year(b.changed_date) as year ";

        if (0 == $time_mode) {
            $sql .= ", month(b.changed_date) as month ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_warehouse_change b on a.product_id = b.product_id
            left join trn_store_delivery  c on b.store_delivery_id = c.store_delivery_id
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id
            left join trn_store_delivery_detail  f on ( b.store_delivery_id = f.store_delivery_id and b.product_id = f.product_id)
            left join mst_product_cat g on a.product_cat_id = g.product_cat_id
        where
            a.selling_price > 0
            and b.warehouse_change_type = 2
             ";

        if ($flag) {
            $sql .= " and year(b.changed_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'store_id', 'd.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "warehouse_change_type", "b.warehouse_change_type", $sqlParam);
        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.changed_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            g.product_cat_id
            , year(b.changed_date)
        ";

        if (0 == $time_mode) {
            $sql .= "   , month(b.changed_date)";
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
    public function loadImportProductCat(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            g.product_cat_id as id
            ,g.name as Name
            , sum(d.amount ) as sum
            , sum(d.amount * d.price) as sum_1
            , year(b.changed_date) as year ";

        if (0 == $time_mode) {
            $sql .= ", month(b.changed_date) as month  ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_warehouse_change b on a.product_id = b.product_id
            left join    trn_import_wh_factory c on c.import_wh_factory_id = b.import_wh_factory_id
            left join    trn_supplier_delivery_detail d on (c.supplier_id = d.supplier_delivery_id and b.product_id = d.product_id)
            left join mst_product_cat g on a.product_cat_id = g.product_cat_id
        where
            a.selling_price > 0
            and b.warehouse_change_type = 1
             ";

        if ($flag) {
            $sql .= " and year(b.changed_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, "warehouse_change_type", "b.warehouse_change_type", $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.changed_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "a.product_cat_id", $sqlParam);

        $sql .= "
        group by
            g.product_cat_id
            , year(b.changed_date)
        ";

        if (0 == $time_mode) {
            $sql .= "   , month(b.changed_date)";
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
    public function loadDeliveryProduct(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        select
            a.product_id as id
            , a.product_code as Name
            , a.stock_code
            , sum(b.amount) as sum
            , sum(b.amount *  b.unit_price)/1000 as sum_1
            , count(distinct d.store_id) as count_1
            , count(distinct e.area_id) as count_2
            , year(c.delivery_time) as year ";

        if (0 == $time_mode) {
            $sql .= ", month(c.delivery_time) as month  ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_store_delivery_detail b on a.product_id = b.product_id
            left join trn_store_delivery  c on b.store_delivery_id = c.store_delivery_id
            left join mst_store d on c.store_id = d.store_id
            left join mst_area e on  d.area1 = e.area_id

        where
            a.selling_price > 0
            and  c.delivery_time is not NULL and c.delivery_sts in ('1','4','8','9') and c.order_type =1
             ";

//
        if ($flag) {
            $sql .= " and year(c.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'store_id', 'd.store_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'd.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'handle_id', 'a.handle_id', $sqlParam);

        $sql .= $this->andWhereInt($param, "area_group_id", "e.area_group_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "area1", "e.area_id", $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(c.delivery_time)", $sqlParam);
        }
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereInt($param, "product_cat_id", "a.product_cat_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "a.product_id", $sqlParam);

        $sql .= "
        group by
            a.product_id
            , year(c.delivery_time)
        ";
        if (0 == $time_mode) {
            $sql .= "   , month(c.delivery_time)";
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
    public function loadImportProduct(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
        select
            a.product_id as id
            , a.product_code as Name
            , a.stock_code
            , sum(d.amount) as sum
            , sum(d.amount * d.price) as sum_1
            , year(b.changed_date) as year ";
        if (0 == $time_mode) {
            $sql .= ", month(b.changed_date) as month  ";
        }

        $sql .= "
        from
            mst_product a
            left join trn_warehouse_change b on a.product_id = b.product_id
            left join    trn_import_wh_factory c on c.import_wh_factory_id = b.import_wh_factory_id
            left join    trn_supplier_delivery_detail d on (c.supplier_id = d.supplier_delivery_id and b.product_id = d.product_id)
        where
            a.selling_price > 0 and b.warehouse_change_type =1
             ";
        if ($flag) {
            $sql .= " and year(b.changed_date) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'handle_id', 'a.handle_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.changed_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "product_cat_id", "a.product_cat_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "id", "a.product_id", $sqlParam);

        $sql .= "
        group by
            a.product_id
            , year(b.changed_date)
        ";
        if (0 == $time_mode) {
            $sql .= "   , month(b.changed_date)";
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
    public function loadAmountCheckingProduct(
        $param,
        $flag,
        $time_mode
    ) {

        $sqlParam = array();
        $sql      = "
            select
                aa.product_id as id,
                aa.product_code as Name,
                year(aa.order_date) as year,
                sum(aa.order_amount) - sum(aa.delivery_amount) as sum,
                sum(aa.order_amount*aa.unit_price)/1000 - sum(aa.delivery_amount*aa.unit_price)/1000 as sum_1 ";
        if (0 == $time_mode) {
            $sql .= "
                , month(aa.order_date) as month
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
                  where 1 = 1

             ";
        $sql .= $this->andWhereInt($param, 'salesman_id', 'c.salesman_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "e.product_code", $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.order_date)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "product_cat_id", "e.product_cat_id", $sqlParam);
        // $sql .= $this->andWhereInt($param, "id", "a.product_id", $sqlParam);
        $sql .= "
        ) aa
            group by
                aa.product_code
                ,year(aa.order_date)
        ";

        if (0 == $time_mode) {
            $sql .= "   , month(aa.order_date)";
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
    public function loadAmountProfitProduct(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id as id
            , c.product_code as Name
            , sum((a.unit_price - c.purchase_price*23500 - a.unit_price *(b.discount_1 + b.discount_2)/100 )*a.amount)/1000 as sum
         ";

        if (0 == $time_mode) {
            $sql .= " , month(b.delivery_time) as month ";
        }

        $sql .= "
            , year(b.delivery_time) as year
        from
            trn_store_delivery_detail a  left join
            trn_store_delivery b on a.store_delivery_id = b.store_delivery_id
            left join mst_product c on a.product_id = c.product_id
        where
            b.delivery_sts in ('1','4','8','9')
            and b.order_type = 1
             ";

        if ($flag) {
            $sql .= " and year(b.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

        $sql .= $this->andWhereInt($param, 'handle_id', 'c.handle_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'product_cat_id', 'c.product_cat_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'c.supplier_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "c.product_code", $sqlParam);

        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.delivery_time)", $sqlParam);
        }

        $sql .= $this->andWhereInt($param, "id", "c.product_id", $sqlParam);

        $sql .= "
        group by
            a.product_id
            , c.product_code
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
     * @param $flag
     * @param $time_mode
     * @return mixed
     */
    public function loadAmountProfitProductCat(
        $param,
        $flag,
        $time_mode
    ) {
        $sqlParam = array();
        $sql      = "
        select
            c.product_cat_id as id
            , d.name as Name
            , sum((a.unit_price - c.purchase_price*23500 - a.unit_price *(b.discount_1 + b.discount_2)/100 )*a.amount)/1000 as sum
         ";

        if (0 == $time_mode) {
            $sql .= " , month(b.delivery_time) as month ";
        }

        $sql .= "
            , year(b.delivery_time) as year
        from
            trn_store_delivery_detail a  left join
            trn_store_delivery b on a.store_delivery_id = b.store_delivery_id
            left join mst_product c on a.product_id = c.product_id
            left join mst_product_cat d on c.product_cat_id = d.product_cat_id
        where
            b.delivery_sts in ('1','4','8','9')
            and b.order_type = 1
             ";

        if ($flag) {
            $sql .= " and year(b.delivery_time) >= ? ";
            $sqlParam[] = date("Y") - 3;
        }

// $sql .= $this->andWhereInt($param, 'handle_id', 'c.handle_id', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'product_cat_id', 'c.product_cat_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'c.supplier_id', $sqlParam);

        $sql .= $this->andWhereInt($param, 'salesman_id', 'b.salesman_id', $sqlParam);

// $sql .= $this->andWhereString($param, "product_code", "c.product_code", $sqlParam);
        if (0 == $time_mode) {
            $sql .= $this->andWhereInt($param, "year", "year(b.delivery_time)", $sqlParam);
        }

        // $sql .= $this->andWhereInt($param, "id", "c.product_id", $sqlParam);

        $sql .= "
        group by
            c.product_cat_id
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
     * @param $flag
     * @return mixed
     */
    public function getData(
        $param,
        $flag
    ) {
        $data_type = "sum";

        if (1 == $param["data_type"]) {
            $data_type = "sum";
        } elseif (2 == $param["data_type"]) {
            $data_type = "sum_1";
        } elseif (5 == $param["data_type"]) {
            $data_type = "count_1";
        } elseif (6 == $param["data_type"]) {
            $data_type = "count_2";
        }

        $time_mode = $param["time_mode"];
        Log::debug('------check param rpt0513--------');
        Log::debug($param);

        if (2 == $param['tab']) {

            if (1 == $param['view_mode']) {
                $data = $this->loadImportProduct($param, $flag, $time_mode);
            } else {
                $data = $this->loadImportProductCat($param, $flag, $time_mode);
            }

        } elseif (3 == $param['tab']) {

            if (1 == $param['view_mode']) {
                $data = $this->loadDeliveryProduct($param, $flag, $time_mode);
            } elseif (2 == $param['view_mode']) {
                $data = $this->loadDeliveryProductCat($param, $flag, $time_mode);
            } else {
                $data = $this->loadDeliveryProductHandle($param, $flag, $time_mode);
            }

        } elseif (4 == $param['tab']) {

            if (1 == $param['view_mode']) {
                $data = $this->loadAmountWarrantyProduct($param, $flag, $time_mode);
            } else {

                $data = $this->loadAmountWarrantyProductCat($param, $flag, $time_mode);
            }

        } elseif (5 == $param['tab']) {

            $data = $this->loadAmountCheckingProduct($param, $flag, $time_mode);
        } elseif (6 == $param['tab']) {

            if (1 == $param['view_mode']) {
                $data = $this->loadAmountProfitProduct($param, $flag, $time_mode);
            } elseif (2 == $param['view_mode']) {
                $data = $this->loadAmountProfitProductCat($param, $flag, $time_mode);
            }

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

// Log::debug('check param-----------');
        // Log::debug($param);
        $res = $this->getData($param, false);

        $result = $this->dataProcess($param, $res['data'], $first_header, $last_header, $res['data_type']);

        return $result;

    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadOverviewData($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.product_id
                , a.product_code as Name
                , a.stock_code
                , sum(b.amount) as sum
                , b.warehouse_change_type
                , year(b.changed_date) as year
            from
                mst_product a
                left join trn_warehouse_change b on a.product_id = b.product_id
            where
                a.selling_price > 0
                and b.warehouse_change_type in (1,2)
             ";
        $sql .= $this->andWhereInt($param, "type", "b.warehouse_change_type", $sqlParam);
        $sql .= $this->andWhereInt($param, "product_cat_id", "a.product_cat_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= "
        group by
            a.product_id
            ,b.warehouse_change_type
            , year(b.changed_date)
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadPriceList($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                a.product_id
                , a.product_code
                , a.stock_code
                , a.name
                , a.selling_price
                , a.purchase_price
                , b.name product_cat_name
        from
                mst_product a
                left join mst_product_cat b
                on a.product_cat_id = b.product_cat_id
                left join mst_packaging c
                on c.packaging_id = a.packaging_id
            where
                a.active_flg = '1'
                and a.selling_price > 0

             ";

// $sql .= $this->andWhereInt($param, "type", "b.warehouse_change_type", $sqlParam);
        // $sql .= $this->andWhereInt($param, "product_cat_id", "a.product_cat_id", $sqlParam);
        $sql .= $this->andWhereInt($param, 'handle_id', 'a.handle_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'product_cat_id', 'a.product_cat_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= $this->andWhereString($param, "product_code", "a.product_code", $sqlParam);
        $sql .= "
        order by
            a.selling_price  desc
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function loadOverview($param)
    {
        $header  = ["Name"];
        $listBig = [];
        $list    = null;
        $labels  = ["Import", "Deliver"];

        $count        = 12;
        $current_year = date("Y");

        if (!isset($param["type"])) {
            $param["type"] = '';
        }

        foreach (range(2016, $current_year) as $year) {

            if (1 == $param["type"]) {
                $time = $labels[0] . "-" . str_pad($year, 4, '0', STR_PAD_LEFT);
                array_push($header, $time);
                Log::debug(1);

            } elseif (2 == $param["type"]) {
                $time = $labels[1] . "-" . str_pad($year, 4, '0', STR_PAD_LEFT);
                array_push($header, $time);
                Log::debug(2);
            } else {
                Log::debug(3);
                $time = $labels[0] . "-" . str_pad($year, 4, '0', STR_PAD_LEFT);
                array_push($header, $time);
                $time = $labels[1] . "-" . str_pad($year, 4, '0', STR_PAD_LEFT);
                array_push($header, $time);
            }

        }

        $data = $this->loadOverviewData($param);

        foreach ($data as $item) {
            $list[$item->product_id]["Name"] = $item->Name;
            //$list[$item2->product_id]["Stock code"]= $item2->stock_code;
            $time                           = $labels[$item->warehouse_change_type - 1] . "-" . str_pad($item->year, 4, '0', STR_PAD_LEFT);
            $list[$item->product_id][$time] = $item->sum;

            if (1 == $item->warehouse_change_type) {

                if (!isset($list[$item->product_id]["Total Import"])) {
                    $list[$item->product_id]["Total Import"] = ($item->sum);
                } else {
                    $list[$item->product_id]["Total Import"] = $list[$item->product_id]["Total Import"] + ($item->sum);
                }

            } elseif (2 == $item->warehouse_change_type) {

                if (!isset($list[$item->product_id]["Total Deliver"])) {
                    $list[$item->product_id]["Total Deliver"] = ($item->sum);
                } else {
                    $list[$item->product_id]["Total Deliver"] = $list[$item->product_id]["Total Deliver"] + ($item->sum);
                }

            }

        }

        $col = "Total Deliver";

        if (1 == $param["type"]) {
            array_push($header, "Total Import");
            $col = "Total Import";
        } elseif (2 == $param["type"]) {
            array_push($header, "Total Deliver");
        } else {
            array_push($header, "Total Import");
            array_push($header, "Total Deliver");
        }

        if (null == $list) {
            $listBig = null;
        } else {

            foreach ($list as $item) {
                array_push($listBig, $item);
            }

            $listBig = $this->sort($listBig, $col);
        }

        $result = [
            'header' => $header,
            'data'   => $listBig,
        ];

        return $result;

    }

}
