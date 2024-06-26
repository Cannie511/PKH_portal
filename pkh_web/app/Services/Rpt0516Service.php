<?php

namespace App\Services;

use DB;

/**
 * Rpt0516Service class
 */
class Rpt0516Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectCategories($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.cost_cat_id
                , b.name
                , month (a.cost_date) month
                , sum(a.amount) total
            from
                trn_cost a
                left join mst_cost_cat b
                    on a.cost_cat_id = b.cost_cat_id
            where
                a.active_flg = 1
                and  year (a.cost_date) = ?
            group by
                a.cost_cat_id
                , month (a.cost_date)
            ";

        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectDepartments($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.department_id
                , b.name
                , month (a.cost_date) month
                , sum(a.amount) total
            from
                trn_cost a
                left join mst_department b
                    on a.department_id = b.department_id
            where
                a.active_flg = 1
                and year (a.cost_date) = ?
            group by
                a.department_id
                , month (a.cost_date)
            ";

        $sqlParam[] = $param['year'];

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
