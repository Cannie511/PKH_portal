<?php

namespace App\Services;

use DB;
use App\Models\TrnLeaveAllocation;

/**
 * Hrm0810Service class
 */
class Hrm0810Service extends BaseService
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
        from trn_leave_allocation
        where id = ?
        limit 1
        ";

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
            $entity = new TrnLeaveAllocation();
        } else {
            $entity = TrnLeaveAllocation::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Không tồn tại",
                ];
            }

        }

        $user = $this->logonUser();

        $entity->employee_id  = $param["employee_id"];
        $entity->num_days     = $param["num_days"];
        $entity->reason       = $param["reason"];
        $entity->expired_date = $param["expired_date"];
        $entity->notes        = isset($param["notes"]) ? $param["notes"] : null;

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
    public function deleteContract($id)
    {
        TrnLeaveAllocation::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

}
