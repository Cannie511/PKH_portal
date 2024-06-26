<?php

namespace App\Services;

use DB;
use App\Models\MstWarehouse;

/**
 * Crm2900Service class
 */
class Crm2900Service extends BaseService
{
    public function selectList($param){
        $sqlParam = array();
        $sql      = "
        select 
            a.warehouse_id
            , a.name
            , a.address 
            , a.active_flg
            , a.created_at 
            , a.created_by
            , a.updated_at
            
            , b.name  as updated_by
        from 
            mst_warehouse a 
            left join users b on a.updated_by = b.id
        where 
        1=1
        ";
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        // $sql .= $this->andWhereString($param, 'display_name', 'a.display_name', $sqlParam);
        // $sql .= $this->andWhereString($param, 'notes', 'a.notes', $sqlParam);

        $sql .= "
            order by 
            a.created_at desc
        ";
        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }
}
