<?php

namespace App\Services;

use DB;

/**
 * Hrm0800Service class
 */
class Hrm0800Service extends BaseService
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
          , a.employee_id
          , a.num_days
          , a.reason
          , a.expired_date
          , a.notes
          , b.employee_code
          , b.fullname
          , coalesce(c.used,0) used
        from
          trn_leave_allocation a join mst_employee_info b
            on a.employee_id = b.employee_id
          left join (
            select
              leave_allocation_id
              , coalesce(sum(amount), 0) used
            from
              trn_absent
            where
              leave_type = 1
              and status = 1
            group by
              leave_allocation_id
            having
              leave_allocation_id is not null
          ) c
            on a.id = c.leave_allocation_id
        where
          1 = 1
        ";

        $sql .= $this->andWhereInt($param, 'employee_id', 'a.employee_id', $sqlParam);

        $sql .= "
            order by
            a.expired_date desc, b.employee_code
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
