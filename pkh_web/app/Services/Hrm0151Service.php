<?php

namespace App\Services;

/**
 * Hrm0151Service class
 */
class Hrm0151Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function getPosData($param)
    {
        $sqlParam = array();
        $sql      = "
          select
            a.id
            , a.user_id
            , a.track_time
            , a.gps_lat
            , a.gps_long
            , b.name
          from
            trn_user_pos_his a
            left join users b
              on a.user_id = b.id
          where
            a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);
        $sql .= $this->andWhereDateTimeBetween($param, 'dateFrom', 'dateTo', 'a.track_time', $sqlParam);
        $sql .= " order by a.track_time desc";

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

}
