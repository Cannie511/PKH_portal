<?php

namespace App\Services;

use DB;

/**
 * Hrm1100Service class
 */
class Hrm1100Service extends BaseService
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
          year (salary_month) as year
        from
          trn_salary
        where
          active_flg = 1
        order by
          year (salary_month) desc
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
          , a.salary_month
          , a.from_date
          , a.to_date
          , a.total_days
          , a.total_hours
          , a.total_amount
          , a.total_com_amount
          , a.total_bhxh
          , a.total_bhyt
          , a.total_bhtn
          , a.total_com_bhxh
          , a.total_com_bhyt
          , a.total_com_bhtn
          , a.tax_bhxh_percent
          , a.tax_bhyt_percent
          , a.tax_bhtn_percent
          , a.com_tax_bhxh_percent
          , a.com_tax_bhyt_percent
          , a.com_tax_bhtn_percent
          , a.min_salary_area
          , a.salary_sts
          , count(b.id) count_employee
        from
          trn_salary a
          left join trn_salary_detail b
            on a.id = b.salary_id
        where
          a.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'year', 'year(a.salary_month)', $sqlParam);

        $sql .= "
            group by
              a.id
            order by
              a.salary_month desc
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
