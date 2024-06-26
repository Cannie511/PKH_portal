<?php

namespace App\Services;

use DB;

/**
 * Hrm0700Service class
 */
class Hrm0700Service extends BaseService
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
          a.employee_id
          , a.employee_code
          , a.fullname
          , a.title
          , a.devision
          , a.dob
          , a.address_permernance
          , a.address_contact
          , a.card_id
          , a.card_id_issue_on
          , a.card_id_issue_at
          , a.tax_number
          , a.social_number
          , a.home_phone
          , a.tel1
          , a.tel2
          , a.nationality
          , a.marital_sts
          , a.gender
          , a.probation_start_date
          , a.probation_end_date
          , a.start_date
          , a.end_date
          , a.notes
          , b.id
          , b.email
          , b.avatar
          , b.last_login_at
          , c.max_end_date
        from
          mst_employee_info a
          left join users b
            on a.employee_id = b.id
          left join (
            select
              a.employee_id
              , max(a.end_date) as max_end_date
            from
              trn_employee_contract a
            group by
              a.employee_id
          ) c
            on c.employee_id = a.employee_id
        where
          a.active_flg = 1
        ";

        $sql .= $this->andWhereString($param, 'email', 'b.email', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'a.fullname', $sqlParam);

        if (isset($param['is_work'])) {
          if ($param['is_work']  == "1") {
            $sql .= " and a.end_date is null";
          } else if ($param['is_work']  == "2")  {
            $sql .= " and a.end_date is not null";
          }
        } 

        $result = [];

        $sql .= "
        order by
          a.employee_code
        ";

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
