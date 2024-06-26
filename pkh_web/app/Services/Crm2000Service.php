<?php

namespace App\Services;

/**
 * Crm2000Service class
 */
class Crm2000Service extends BaseService
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
                a.branch_id
                , a.branch_name
                , a.branch_address
                , a.branch_contact
                , a.started_date
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , b.name as updated_by
                , a.version_no
            from
                mst_branch a
                left join users b on
                a.updated_by = b.id
            where
                a.active_flg = '1'
        ";

        $sql .= $this->andWhereString($param, 'branch_name', 'a.branch_name', $sqlParam);
        $sql .= $this->andWhereString($param, 'branch_address', 'a.branch_address', $sqlParam);
        $sql .= $this->andWhereString($param, 'branch_contact', 'a.branch_contact', $sqlParam);
        $sql .= "
            order by a.created_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
