<?php

namespace App\Services;

use DB;

/**
 * Crm0915Service class
 */
class Crm0915Service extends BaseService
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
          , a.product_id
          , a.amount
          , a.remain
          , b.pi_no
          , b.delivery_date
          , b.comming_pkh_date
          , c.product_code
          , c.name
          , d.price*b.rate as price
          , (b.landed_cost+ b.frieght_cost*b.rate + b.insurance_cost)/e.total_amount as cost_per_1pro
          , MAX(a.SOLD_DAYS) max_days
        from
          (
            select
              a.supplier_delivery_id
              , a.product_id
              , a.in_date
              , a.soldout_date
              , a.amount
              , a.remain
              , CASE
                  WHEN a.remain = 0 THEN DATEDIFF(a.soldout_date, a.in_date)
                  ELSE DATEDIFF(CURDATE(), a.in_date)
                END as SOLD_DAYS
            from
              trn_wh_product_time a
          ) a join trn_supplier_delivery b
            on a.supplier_delivery_id = b.supplier_delivery_id
          left join mst_product c
            on a.product_id = c.product_id
          left join trn_supplier_delivery_detail d
            on ( a.supplier_delivery_id = d.supplier_delivery_id and a.product_id = d.product_id)
          left join 
            (
              select 
                a.supplier_delivery_id
                , sum(a.amount) as total_amount
              from 
                trn_supplier_delivery_detail  a
              group by 
                a.supplier_delivery_id
            ) e 
            on a.supplier_delivery_id = e.supplier_delivery_id
        group by
          a.supplier_delivery_id
          , a.product_id
          , a.amount
          , a.remain
        having 1 = 1
        ";

        $sql .= $this->andWhereString($param, 'pi_no', 'b.pi_no', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'c.product_code', $sqlParam);

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);
        // $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

        $sql .= "
        order by
        b.comming_pkh_date desc
        , c.product_code asc
        ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
