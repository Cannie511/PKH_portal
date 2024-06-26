<?php

namespace App\Services;

use DB;

/**
 * Rpt0517Service class
 */
class Rpt0517Service extends BaseService
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
                a.download_id
                , a.screen
                , a.descript
                , b.name user_name
                , a.created_at
            from
                download_management a
                left join users b
                    on a.created_by = b.id
            where
               a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'user_id', 'a.created_by', $sqlParam);
        $sql .= $this->andWhereString($param, 'screen', 'a.screen', $sqlParam);

        $sql .= "
            order by a.created_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

    public function selectListUser()
    {

        $sqlParam = array();
        $sql      = "
           select
            a.id
            , a.name
            from
            users a
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }
}
