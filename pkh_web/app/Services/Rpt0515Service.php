<?php

namespace App\Services;

use DB;

/**
 * Rpt0515Service class
 */
class Rpt0515Service extends BaseService
{
    /**
     * @param $param
     * @param $type
     * @return mixed
     */
    public function loadSalesManData(
        $param,
        $type
    ) {
        $sqlParam = array();

        if (1 == $type) {
            $sql = "
                select
                b.name
                ,b.id
                , count(a.store_order_id) as orderCount
                , sum(a.total) as orderSum
                , sum(a.total_with_discount) as orderSumDis ";

        } elseif (2 == $type) {
            $sql = "
                select
                    b.name
                    ,b.id
                    , count(d.store_delivery_id) as deliveryCount
                    , sum(d.total) as deliverySum
                    , sum(d.total_with_discount) as deliverySumDis ";
        }

        $sql .= " from
            users b
            left join role_user c
                on b.id = c.user_id
            left join trn_store_order a
                on a.salesman_id = b.id ";

        if (2 == $type) {
            $sql .= "
            left join trn_store_delivery d
                on a.store_order_id = d.store_order_id  ";
        }

        $sql .= "
        where
            (c.role_id = 5 or c.role_id = 3)
            and b.active_flg = 1
             and a.order_sts !=5
            and a.order_type = 1
             ";

        if (2 == $type) {
            $sql .= "  and d.delivery_sts != 5 ";
        }

        $sql .= $this->andWhereInt($param, "promotion_id", " a.promotion_id ", $sqlParam);

        if (1 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " a.order_date ", $sqlParam);
        } elseif (2 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " d.delivery_date ", $sqlParam);
        }

        $sql .= "
        group by
            b.id
            , b.name
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $type
     * @return mixed
     */
    public function loadAreaData(
        $param,
        $type
    ) {
        $sqlParam = array();

        if (1 == $type) {
            $sql = "
                select
                c.name
                , c.area_id
                , COALESCE(count(a.store_order_id),0) as orderCount
                , COALESCE(sum(a.total),0) as orderSum
                , COALESCE(sum(a.total_with_discount),0) as orderSumDis ";

        } elseif (2 == $type) {
            $sql = "
                select
                    c.name
                    , c.area_id
                    , COALESCE(count(d.store_delivery_id),0) as deliveryCount
                    , COALESCE(sum(d.total),0) as deliverySum
                    , COALESCE(sum(d.total_with_discount),0) as deliverySumDis ";
        }

        $sql .= " from
                    mst_store b
                    left join mst_area c
                        on b.area1 = c.area_id
                    left join trn_store_order a
                        on a.store_id = b.store_id";

        if (2 == $type) {

            $sql .= "
                    left join trn_store_delivery d
                        on a.store_order_id = d.store_order_id";
        }

        $sql .= "
                where
                    c.active_flg = 1
                    and a.order_sts !=5
                    and a.order_type = 0
                     ";

        if (2 == $type) {
            $sql .= "  and d.delivery_sts != 5 ";
        }

        $sql .= $this->andWhereInt($param, "promotion_id", " a.promotion_id ", $sqlParam);

        if (1 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " a.order_date ", $sqlParam);
        } elseif (2 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " d.delivery_date ", $sqlParam);
        }

        $sql .= "
        group by
            c.area_id
            , c.name
            order by
            c.area_group_id
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $type
     * @return mixed
     */
    public function loadProductData(
        $param,
        $type
    ) {
        $sqlParam = array();

        if (1 == $type) {
            $sql = "
                select
                    b.product_id as id
                    , b.product_code as name
                    , sum(a.amount) as orderQty
                from
                    trn_store_order_detail a
                    left join mst_product b
                        on a.product_id = b.product_id
                    left join trn_store_order c
                        on a.store_order_id = c.store_order_id
                    where
                        c.order_sts != 5
                ";

        } elseif (2 == $type) {
            $sql = "
                select
                    b.product_id as id
                    , b.product_code as name
                    , sum(a.amount)  as deliveryQty
                from
                    trn_store_delivery_detail a
                    left join mst_product b
                        on a.product_id = b.product_id
                    left join trn_store_delivery d
                        on a.store_delivery_id = d.store_delivery_id
                    left join trn_store_order c
                        on d.store_order_id = c.store_order_id
                where
                    c.order_sts != 5
                    and d.delivery_sts != 5 ";
        }

        $sql .= $this->andWhereInt($param, "promotion_id", " c.promotion_id ", $sqlParam);

        if (1 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " c.order_date ", $sqlParam);
        } elseif (2 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " d.delivery_date ", $sqlParam);
        }

        $sql .= "
        group by
             b.product_id
            , b.product_code
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @param $type
     * @return mixed
     */
    public function loadStoreData(
        $param,
        $type
    ) {
        $sqlParam = array();

        if (1 == $type) {
            $sql = "
                select
                b.name
                , b.store_id
                , b.address
                , COALESCE(count(a.store_order_id),0) as orderCount
                , COALESCE(sum(a.total),0) as orderSum
                , COALESCE(sum(a.total_with_discount),0) as orderSumDis ";

        } elseif (2 == $type) {
            $sql = "
                select
                    b.name
                    , b.store_id
                    , b.address
                    , COALESCE(count(d.store_delivery_id),0) as deliveryCount
                    , COALESCE(sum(d.total),0) as deliverySum
                    , COALESCE(sum(d.total_with_discount),0) as deliverySumDis ";
        }

        $sql .= " from
                    mst_store b
                    left join trn_store_order a
                        on a.store_id = b.store_id ";

        if (2 == $type) {

            $sql .= "
                    left join trn_store_delivery d
                        on a.store_order_id = d.store_order_id";
        }

        $sql .= "
                where
                    a.active_flg = 1
                    and a.order_sts !=5
                    and a.order_type = 0
                     ";

        if (2 == $type) {
            $sql .= "  and d.delivery_sts != 5 ";
        }

        $sql .= $this->andWhereInt($param, "promotion_id", " a.promotion_id ", $sqlParam);

        if (1 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " a.order_date ", $sqlParam);
        } elseif (2 == $type) {
            $sql .= $this->andWhereDateBetween($param, "start_date", "end_date", " d.delivery_date ", $sqlParam);
        }

        $sql .= "
        group by
             b.name
            , b.store_id
            , b.address
        order by
            a.store_id
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
