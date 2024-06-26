<?php

namespace App\Services;

use DB;

/**
 * Crm0914Service class
 */
class Crm0914Service extends BaseService
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
          a.supplier_delivery_id
          , b.pi_no
          , b.delivery_date
          , b.comming_pkh_date
          , c.total_product
          , c.count_sold_out
          , c.count_remain
          , MIN(a.SOLD_DAYS) min_days
          , MAX(a.SOLD_DAYS) max_days
        from
          (
            select
              a.supplier_delivery_id
              , a.product_id
              , a.in_date
              , a.soldout_date
              , DATEDIFF(a.soldout_date, a.in_date) as SOLD_DAYS
            from
              trn_wh_product_time a
            where
              a.remain = 0
          ) a join trn_supplier_delivery b
            on a.supplier_delivery_id = b.supplier_delivery_id
          left join (
            select
              a.supplier_delivery_id
              , count(a.product_id) as total_product
              , count(if (a.remain = 0, 1, null)) as count_sold_out
              , count(if (a.remain > 0, 1, null)) as count_remain
            from
              trn_wh_product_time a
            group by
              a.supplier_delivery_id
          ) c
            on c.supplier_delivery_id = a.supplier_delivery_id
        group by
          a.supplier_delivery_id
          , b.pi_no
          , b.delivery_date
          , b.comming_pkh_date
          , c.total_product
          , c.count_sold_out
          , c.count_remain
        order by b.comming_pkh_date desc, b.pi_no desc
        ";

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);

// $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

// $sql .= "

//     order by

//     a.created_at desc
        // ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
