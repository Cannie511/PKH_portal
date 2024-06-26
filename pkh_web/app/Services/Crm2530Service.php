<?php

namespace App\Services;

use DB;

/**
 * Crm2530Service class
 */
class Crm2530Service extends BaseService
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
              a.product_market_his_id
              , a.warehouse_change_type
              , a.product_market_id
              , a.changed_date
              , a.price
              , a.amount
              , a.status
              , a.store_id
              , a.description
              , b.name
              , b.code
              , b.type
              , c.name store_name
              , c.address store_address
            from
              trn_product_market_his a join mst_product_market b
                on b.product_market_id = a.product_market_id
            left join
              mst_store c on c.store_id = a.store_id
            where
              a.active_flg = '1'
        ";

        $sql .= $this->andWhereDateBetween($param, 'fromDate', 'toDate', 'a.changed_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'b.code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'product_type', 'b.type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'warehouse_change_type', 'a.warehouse_change_type', $sqlParam);
        $sql .= $this->andWhereInt($param, 'status', 'a.status', $sqlParam);

        $sql .= "
            order by
                a.changed_date desc,
                a.warehouse_change_type,
                b.type,
                a.product_market_id
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
