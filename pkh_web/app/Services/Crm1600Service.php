<?php

namespace App\Services;

/**
 * Crm1600Service class
 */
class Crm1600Service extends BaseService
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
                , b.name
                , a.supplier_order_id
                , a.supplier_id
                , a.delivery_date
                , a.total
                , a.volume
                , a.amount
                , a.unit_price
                 , a.updated_at
                , c.name as updated_by
            from
                trn_supplier_delivery a join mst_supplier b
                    on a.supplier_id = b.supplier_id
                  left join users c on
                    c.id = a.updated_by
            where
                a.active_flg = 1
        ";

        $result = array();
        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'a.delivery_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'pi_no', 'a.pi_no', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        $sql .= " order by   a.created_at desc ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
