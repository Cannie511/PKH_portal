<?php

namespace App\Services;

use DB;

/**
 * Hrm0154Service class
 */
class Hrm0154Service extends BaseService
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
          , a.working_time
          , a.user_id
          , a.ip
          , a.agent
          , a.event_name
          , a.notes
          , a.ip_city
          , b.employee_code
          , b.fullname
        from
          trn_attendance a
        left join mst_employee_info b
          on a.user_id = b.employee_id
        where
          1 = 1
        ";

        $sql .= $this->andWhereDateTimeBetween($param, 'start_date', 'end_date', 'a.working_time', $sqlParam);
        $sql .= $this->andWhereInt($param, 'employee_id', 'a.user_id', $sqlParam);

        $sql .= "
            order by working_time desc
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
