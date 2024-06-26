<?php

namespace App\Services;

/**
 * Hrm0150Service class
 */
class Hrm0150Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function getLastPosData($param)
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
          trn_user_last_pos a
          left join users b
            on a.user_id = b.id
        where
          a.track_time > now() - INTERVAL 1 DAY
        ";

        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

}
