<?php

namespace App\Services;

use DB;
use App\Models\MstDepartment;

/**
 * Crm1821Service class
 */
class Crm1821Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectDepartment($param)
    {
        $result = null;

        if (isset($param["department_id"])) {
            $result = MstDepartment::find($param["department_id"]);
        }

        return $result;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveDepartment(
        $user,
        $param
    ) {
        $department = null;

        if (isset($param['department_id']) && ($param['department_id'] > 0)) {
            $department = MstDepartment::find($param['department_id']);
            $this->updateRecordHeader($department, $user, false);
            $msg = "cập nhật " . $department["name"] . " thành Công";
        } else {
            $department = new MstDepartment();
            $this->updateRecordHeader($department, $user, true);
            $msg = "Lưu thành Công";
        }

        if (null != $department) {
            $department->name        = $param['name'];
            $department->description = $param['description'];

            DB::transaction(function () use ($department) {
                $department->save();
            });
        }

        return $msg;
    }

}
