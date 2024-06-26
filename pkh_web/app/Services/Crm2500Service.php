<?php

namespace App\Services;

/**
 * Crm2500Service class
 */
class Crm2500Service extends BaseService
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
              a.product_market_id
              , a.type
              , a.name
              , a.code
              , a.img_path
              , a.description
            from
              mst_product_market a
            where a.active_flg = 1
        ";

        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'type', 'a.type', $sqlParam);
        $sql .= "
            order by a.type , a.name
        ";

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

}
