<?php

namespace App\Services;

use DB;
use App\Models\TrnSalaryDetail;

/**
 * Hrm1130Service class
 */
class Hrm1130Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectById($id)
    {
        $sqlParam = array();
        $sql      = "
        select *
        from trn_salary_detail
        where id = ?
        limit 1
        ";

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);
        // $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

        $sqlParam[] = $id;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

        $entity = null;

        if (0 == $param["id"]) {
            $entity = new TrnSalaryDetail();
        } else {
            $entity = TrnSalaryDetail::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Không tồn tại",
                ];
            }

        }

        $user = $this->logonUser();

// $entity->employee_id = $param["employee_id"];

// $entity->num_days = $param["num_days"];

// $entity->reason = $param["reason"];

// $entity->expired_date = $param["expired_date"];
        // $entity->notes = isset($param["notes"]) ? $param["notes"]: null;

        $this->updateRecordHeader($entity, $user, 0 == $param["id"]);

        $entity->save();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $id
     */
    public function deleteEntity($id)
    {
        TrnSalaryDetail::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

}
