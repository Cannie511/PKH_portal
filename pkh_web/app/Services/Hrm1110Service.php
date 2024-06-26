<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnSalary;
use App\Services\AbsentService;
use App\Services\SalaryService;
use App\Services\AttendanceService;

/**
 * Hrm1110Service class
 */
class Hrm1110Service extends BaseService
{
    /**
     * Constructor
     *
     * @param AttendanceService $attendanceService
     * @param AbsentService $absentService
     * @param SalaryService $salaryService
     */
    public function __construct(
        AttendanceService $attendanceService,
        AbsentService $absentService,
        SalaryService $salaryService
    ) {
        $this->attendanceService = $attendanceService;
        $this->absentService     = $absentService;
        $this->salaryService     = $salaryService;
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

// try {
        //     DB::beginTransaction();
        $entity = new TrnSalary();

        $entity->salary_month         = $param["salary_month"];
        $entity->from_date            = $param["salary_month"];
        $entity->to_date              = Carbon::createFromFormat('Y-m-d', $param["salary_month"])->endOfMonth()->format('Y-m-d');
        $entity->tax_bhxh_percent     = 8.0;
        $entity->tax_bhyt_percent     = 1.5;
        $entity->tax_bhtn_percent     = 1.0;
        $entity->com_tax_bhxh_percent = 17.5;
        $entity->com_tax_bhyt_percent = 3.0;
        $entity->com_tax_bhtn_percent = 1.0;
        $entity->min_salary_area      = 1490000;

        $workingDays         = $this->attendanceService->getWorkingDay($entity->from_date, $entity->to_date);
        $entity->total_days  = $workingDays["days"];
        $entity->total_hours = $workingDays["hours"];

        $this->updateRecordHeader($entity, null, true);

        $entity->save();

        // Add employee
        $listEmployee = $this->selectEmployees($entity->from_date);

        if (count($listEmployee) > 0) {

            foreach ($listEmployee as $employee) {
                $this->salaryService->addEmployee($entity->id, $employee->employee_id);
            }

        }

        // Update salary
        $this->salaryService->updateSalaryTotal($entity->id);

        // DB::commit();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];

// } catch (\Exception $e) {

//     // DB::rollBack();

//     Log::error($e);

//     return [

//         "rtnCd" => false,

//         "msg"   => "Đã tồn tại dữ liệu này. (" . $e->getMessage() .  ")",

//     ];
        // }
    }

    /**
     * @param $date
     * @return mixed
     */
    public function selectEmployees($date)
    {
        $sqlParam = [$date];
        $sql      = "
        select
          a.employee_id
        from
          mst_employee_info a
        where
          a.active_flg = '1'
          and (a.end_date is null or ? < a.end_date)
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
