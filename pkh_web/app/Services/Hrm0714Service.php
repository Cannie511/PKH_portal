<?php

namespace App\Services;

use App\Models\MstEmployeeInfo;

/**
 * Hrm0714Service class
 */
class Hrm0714Service extends BaseService
{
    /**
     * @param $param
     */
    public function save($param)
    {
        $employee = MstEmployeeInfo::find($param["id"]);

        if (isset($employee)) {
            $user = $this->logonUser();

            $employee->employee_code          = $param["employee_code"];
            $employee->gender                 = $param["gender"];
            $employee->fullname               = $param["fullname"];
            $employee->dob                    = $param["dob"];
            $employee->marital_sts            = $param["marital_sts"];
            $employee->devision               = $param["devision"];
            $employee->title                  = $param["title"];
            $employee->nationality            = $param["nationality"];
            $employee->card_id                = $param["card_id"];
            $employee->card_id_issue_on       = $param["card_id_issue_on"];
            $employee->card_id_issue_at       = $param["card_id_issue_at"];
            $employee->home_phone             = $param["home_phone"];
            $employee->tel1                   = $param["tel1"];
            $employee->tel2                   = $param["tel2"];
            $employee->tax_number             = isset($param["tax_number"]) ? $param["tax_number"] : null;
            $employee->social_number          = isset($param["social_number"]) ? $param["social_number"] : null;
            $employee->probation_start_date   = $param["probation_start_date"];
            $employee->probation_end_date     = $param["probation_end_date"];
            $employee->start_date             = $param["start_date"];
            $employee->end_date               = $param["end_date"];
            $employee->address_permernance    = $param["address_permernance"];
            $employee->address_contact        = $param["address_contact"];
            $employee->count_dependent_person = $param["count_dependent_person"];
            $employee->notes                  = $param["notes"];

            $this->updateRecordHeader($employee, $user, false);

            $employee->save();

            return [
                "rtnCd" => true,
                "msg"   => "Cập nhật thành công",
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Nhân viên không tồn tại",
        ];
    }

}
