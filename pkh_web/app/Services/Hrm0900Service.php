<?php

namespace App\Services;

use DB;

/**
 * Hrm0900Service class
 */
class Hrm0900Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListYear()
    {
        $sqlParam = array();
        $sql      = "
        select distinct
          year (holiday_date) as year
        from
          mst_holiday
        where
          active_flg = 1
        order by
          year (holiday_date) desc
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

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
          , a.holiday_date
          , a.reason
          , a.amount
        from
          mst_holiday a
        where
          active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'year', 'year(a.holiday_date)', $sqlParam);

        $sql .= "
            order by
            holiday_date desc
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
