<?php

namespace App\Services;

/**
 * Crm2300Service class
 */
class Crm2300Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectEximList($param)
    {

        $sqlParam = array();
        $sql      = "
        select
            a.warehouse_exim_id,
            a.from_warehouse_id,
            b.name as from_warehouse_name ,
            a.to_warehouse_id ,
            c.name as to_warehouse_name,
            a.warehouse_exim_code,
            a.total,
            a.seq_no,
            a.exim_sts,
            a.notes,
            a.notes_cancel,
            a.cancel_time,
            a.active_flg,
            a.created_at,
            a.created_by,
            a.updated_at,
            d.name as updated_by,
            a.volume,
            a.carton
        from
            trn_warehouse_exim a
            left join mst_warehouse b
                on a.from_warehouse_id = b.warehouse_id
            left join mst_warehouse c
                on c.warehouse_id = a.to_warehouse_id
            left join users d
                on a.updated_by = d.id
        where
            a.active_flg = '1'
            ";
        $sql .= $this->andWhereDateBetween($param, 'fromDate', 'toDate', 'a.created_at', $sqlParam);
        $sql .= $this->andWhereInt($param, 'from_warehouse_id', 'a.from_warehouse_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'to_warehouse_id', 'a.to_warehouse_id', $sqlParam);

        $sql .= "
  			order by  a.created_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
