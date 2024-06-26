<?php

namespace App\Services;

/**
 * Crm1900Service class
 */
class Crm1900Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectUserWeb($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.id
            , a.name
            , a.email
            , a.phone_number
            , a.active_flg
            , a.created_at
        from
            users_web a
        where
            a.active_flg = 1
        ";
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'phone_number', 'a.phone_number', $sqlParam);
        $sql .= "
            order by  a.created_at  desc
        ";

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

}
