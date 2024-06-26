<?php

namespace App\Services;

/**
 * Crm1500Service class
 */
class Crm1500Service extends BaseService
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
                a.packaging_id
                , a.name
                , a.length
                , a.width
                , a.height
            from
                 mst_packaging a
            where
                a.active_flg =1
        ";

        $sql .= $this->andWhereString($param, 'packing_name', 'a.name', $sqlParam);
        //$result =  $this->pagination($sql, $sqlParam, $param);

        return $this->pagination($sql, $sqlParam, $param);
    }

}
