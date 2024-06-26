<?php

namespace App\Services;

use DB;

/**
 * Hrm1020Service class
 */
class Hrm1020Service extends BaseService
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
          , case
            when b.news_id is not null
              then 1
            else 0
            end viewed
        from
          trn_internal_news a
          left join (
            select
              a.user_id
              , a.news_id
            from
              trn_internal_news_viewed a
            where
              a.user_id = ?
          ) b
            on a.id = b.news_id
        where
          a.active_flg = '1'
          and news_sts = '1'
        ";

        $user       = $this->logonUser();
        $sqlParam[] = $user->id;

        $sql .= $this->andWhereString($param, 'title', 'a.title', $sqlParam);

// $sql .= $this->andWhereString($param, 'news_sts', 'a.news_sts', $sqlParam );

        if (isset($param["view_sts"])) {
            if ('0' == $param["view_sts"]) {
                $sql .= " and b.news_id is null ";
            } elseif ('1' == $param["view_sts"]) {
                $sql .= " and b.news_id is not null ";
            }

        }

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
