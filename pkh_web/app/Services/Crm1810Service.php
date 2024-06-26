<?php

namespace App\Services;

/**
 * Crm1810Service class
 */
class Crm1810Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.cost_cat_id
            , a.parent_id
            , a.name
            , a.description
            , a.active_flg
            , a.created_at
            , a.created_by
            , a.updated_at
            , a.updated_by
            , a.version_no
        from
            mst_cost_cat a
        where
            a.active_flg = 1
        ";

        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);

        $sql .= "
            order by a.cost_cat_id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
