<?php

namespace App\Services;

use DB;

/**
 * Hrm1000Service class
 */
class Hrm1000Service extends BaseService
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
            a.id
            , a.title
            , a.news_sts
            , a.created_at
            , a.updated_at
        from
            trn_internal_news a
        where
            a.active_flg = '1'
        ";

        $sql .= $this->andWhereString($param, 'title', 'a.title', $sqlParam);
        $sql .= $this->andWhereString($param, 'news_sts', 'a.news_sts', $sqlParam);

        $sql .= "
            order by
            a.updated_at desc
        ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
