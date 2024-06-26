<?php

namespace App\Services;

/**
 * Crm1300Service class
 */
class Crm1300Service extends BaseService
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
                a.supplier_order_id
                , b.name
                , a.supplier_id
                , a.order_date
                , a.total
                , a.notes
                , a.updated_at
                , c.name as updated_by
                , a.discount
                , a.total_with_discount
            from
                trn_supplier_order a join mst_supplier b
                    on a.supplier_id = b.supplier_id
                 left join users c
                    on a.updated_by = c.id
            where
                a.active_flg = 1
        ";

        $result = array();
        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'a.order_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_name', 'b.name', $sqlParam);

        $sql .= " order by a.created_at desc ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
