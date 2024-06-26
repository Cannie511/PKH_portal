<?php

namespace App\Services;

use DB;
use App\Models\TrnEmployeeContract;

/**
 * Hrm0716Service class
 */
class Hrm0716Service extends BaseService
{
    /**
     * Select contract
     *
     * @param [type] $params
     * @return void
     */
    public function selectContract($param)
    {
        $sqlParam = array($param["id"]);
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
         where
            a.id = ?
        limit
            1
        ";

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (count($list) == 0) {
            return null;
        }

        return $list[0];
    }

    /**
     * @param $param
     */
    public function saveContract($param)
    {

        $entity = null;

        if (0 == $param["id"]) {
            $entity = new TrnEmployeeContract();
        } else {
            $entity = TrnEmployeeContract::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Hợp đồng không tồn tại",
                ];
            }

        }

        $user = $this->logonUser();

        $entity->employee_id   = $param["employee_id"];
        $entity->contract_no   = $param["contract_no"];
        $entity->title         = $param["title"];
        $entity->start_date    = $param["start_date"];
        $entity->end_date      = $param["end_date"];
        $entity->salary        = $param["salary"];
        $entity->basic_salary  = $param["basic_salary"];
        $entity->contract_type = $param["contract_type"];

        if (isset($param["notes"])) {
            $entity->notes = $param["notes"];
        }

        $this->updateRecordHeader($entity, $user, 0 == $param["id"]);

        $entity->save();

        return [
            "rtnCd" => true,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $id
     */
    public function deleteContract($id)
    {
        TrnEmployeeContract::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

}
