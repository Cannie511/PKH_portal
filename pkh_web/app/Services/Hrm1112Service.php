<?php

namespace App\Services;

use DB;
use App\Models\TrnSalary;
use App\Models\TrnSalaryDetail;
use App\Services\SalaryService;

/**
 * Hrm1112Service class
 */
class Hrm1112Service extends BaseService
{
    /**
     * Constructor
     *
     * @param SalaryService $salaryService
     */
    public function __construct(
        SalaryService $salaryService
    ) {
        $this->salaryService = $salaryService;
    }

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
        select
          a.id
          , a.employee_id
          , a.salary_id
          , a.total_days
          , a.total_hours
          , a.overtime_hour
          , a.gross_salary
          , a.basic_salary
          , a.real_salary
          , a.overtime_salary
          , a.bonus
          , a.tax_bhxh
          , a.tax_bhyt
          , a.tax_bhtn
          , a.tax_pit
          , a.tax_pit_edit
          , a.minus_amount
          , a.advance
          , a.net_salary
          , a.com_tax_bhxh
          , a.com_tax_bhyt
          , a.com_tax_bhtn
          , a.notes
          , a.count_dependent_person
          , b.employee_id
          , b.employee_code
          , b.fullname
          , b.title
          , b.devision
          , b.dob
          , b.address_permernance
          , b.address_contact
          , b.card_id
          , b.card_id_issue_on
          , b.card_id_issue_at
          , b.tax_number
          , b.social_number
          , b.home_phone
          , b.tel1
          , b.tel2
          , b.nationality
          , b.marital_sts
          , b.gender
          , b.probation_start_date
          , b.probation_end_date
          , b.start_date
          , b.end_date
          , c.salary_month
          , c.from_date
          , c.to_date
          , c.total_days standard_days
          , c.total_hours standard_hours
          , c.tax_bhxh_percent
          , c.tax_bhyt_percent
          , c.tax_bhtn_percent
          , c.com_tax_bhxh_percent
          , c.com_tax_bhyt_percent
          , c.com_tax_bhtn_percent
          , c.min_salary_area
          , c.salary_sts
        from
          trn_salary_detail a
          left join mst_employee_info b
            on a.employee_id = b.employee_id
          left join trn_salary c
            on a.salary_id = c.id
        where a.id = ?
        ";

        $sqlParam[] = $id;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        // Tinh PIT
        $detail               = $result[0];
        $salaryAfterDependent = $detail->real_salary - 11000000 - $detail->count_dependent_person * 4400000;
        $pits                 = $this->salaryService->calculatePIT($salaryAfterDependent);
        $detail->pits         = $pits;

        return $detail;
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

        $entity = null;
        $entity = TrnSalaryDetail::find($param["id"]);

        if (!isset($entity)) {
            return [
                "rtnCd" => false,
                "msg"   => "Không tồn tại",
            ];
        }

        $salary = TrnSalary::find($entity->salary_id);

        if (!isset($salary)) {
            return [
                "rtnCd" => false,
                "msg"   => "Không tồn tại",
            ];
        }

        $entity->basic_salary           = $param["basic_salary"];
        $entity->gross_salary           = $param["gross_salary"];
        $entity->total_days             = $param["total_days"];
        $entity->total_hours            = $param["total_hours"];
        $entity->count_dependent_person = $param["count_dependent_person"];
        $entity->overtime_salary        = $param["overtime_salary"];
        $entity->bonus                  = $param["bonus"];
        $entity->minus_amount           = $param["minus_amount"];
        $entity->advance                = $param["advance"];
        $entity->tax_pit_edit           = $param["tax_pit_edit"];

        $entity             = $this->salaryService->calculateSalaryDetail($entity, $salary);
        $entity->net_salary =
        $entity->real_salary
         + $entity->overtime_salary
         + $entity->bonus
         - $entity->tax_bhxh
         - $entity->tax_bhyt
         - $entity->tax_bhtn
         - $entity->tax_pit
         - $entity->tax_pit_edit
         - $entity->minus_amount
         - $entity->advance;

        $this->updateRecordHeader($entity, null, false);

        $entity->save();

        $this->salaryService->updateSalaryTotal($entity->salary_id);

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
