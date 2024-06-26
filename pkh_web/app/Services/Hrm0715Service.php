<?php

namespace App\Services;

use DB;

/**
 * Hrm0715Service class
 */
class Hrm0715Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {

        $sqlParam = array($param["employee_id"]);
        $sql      = "
        select
            a.id
            , a.employee_id
            , a.contract_no
            , a.title
            , a.start_date
            , a.end_date
            , a.salary
            , a.basic_salary
            , a.contract_type
            , a.notes
        from
            trn_employee_contract a
        where a.employee_id = ?
        and a.active_flg = 1
        order by a.start_date desc
        ";

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);

// $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

// $sql .= "

//     order by

//     a.created_at desc
        // ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
