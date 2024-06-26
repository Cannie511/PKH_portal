<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\TrnSalary;
use App\Models\MstEmployeeInfo;
use App\Models\TrnSalaryDetail;

// use App\Services\AttendanceService;

// use App\Services\AbsentService;

// use App\Services\SalaryService;

/**
 * SalaryService class
 */
class SalaryService extends BaseService
{
    /**
     * Constructor
     *
     * @param AttendanceService $attendanceService
     * @param AbsentService $absentService
     */
    public function __construct(
        AttendanceService $attendanceService,
        AbsentService $absentService
    ) {
        $this->attendanceService = $attendanceService;
        $this->absentService     = $absentService;
    }

    /**
     * @param $salary_id
     * @param $employee_id
     */
    public function addEmployee(
        $salary_id,
        $employee_id
    ) {

        $salary   = TrnSalary::find($salary_id);
        $employee = MstEmployeeInfo::find($employee_id);

        $workingInfo  = $this->selectWorkingHour($salary->from_date, $salary->to_date, $employee_id);
        $contract     = $this->selectCurrentContract($salary->to_date, $employee_id);
        $detailEntity = new TrnSalaryDetail();

        $detailEntity->salary_id              = $salary_id;
        $detailEntity->employee_id            = $employee->employee_id;
        $detailEntity->total_days             = $workingInfo["total_days"];
        $detailEntity->total_hours            = $workingInfo["total_hours"];
        $detailEntity->count_dependent_person = $employee->count_dependent_person;
        $detailEntity->overtime_hour          = 0;
        if (isset($contract)) {
            $detailEntity->gross_salary = $contract->salary;
            $detailEntity->basic_salary = $contract->basic_salary;
        }

        $detailEntity             = $this->calculateSalaryDetail($detailEntity, $salary);
        $detailEntity->net_salary =
        $detailEntity->real_salary
         + $detailEntity->overtime_salary
         + $detailEntity->bonus
         - $detailEntity->tax_bhxh
         - $detailEntity->tax_bhyt
         - $detailEntity->tax_bhtn
         - $detailEntity->tax_pit
         - $detailEntity->minus_amount
         - $detailEntity->advance;

        $this->updateRecordHeader($detailEntity, null, true);
        $detailEntity->save();
    }

    /**
     * @param $from_date
     * @param $to_date
     * @param $employee_id
     * @return mixed
     */
    public function selectWorkingHour(
        $from_date,
        $to_date,
        $employee_id
    ) {

        $sqlParam = [$employee_id, $from_date, $to_date];
        $sql      = "
        select
          a.id
          , a.user_id
          , a.working_date
          , a.start_time
          , a.end_time
          , a.first_time
          , a.last_time
          , a.working_hours
          , a.absent_type
          , a.is_holiday
          , a.holiday_hours
        from
          trn_working_hours a
        where
          user_id = ?
          and working_date between ? and ?
        ";

        $listWorking = DB::select(DB::raw($sql), $sqlParam);
        $mapWorking  = [];
        foreach ($listWorking as $day) {
            $mapWorking[$day->working_date] = [
                "working_hours" => $day->working_hours,
                "absent_type"   => $day->absent_type,
                "is_holiday"    => $day->is_holiday,
                "holiday_hours" => $day->holiday_hours,
            ];
        }

        Log::info('mapWorking: ' . print_r($mapWorking, true));

        $listHolidays = $this->absentService->searchHolidayForCalendar([
            'startDate' => $from_date,
            'endDate'   => $to_date,
        ]);

        $fromDate   = Carbon::createFromFormat('Y-m-d', $from_date);
        $toDate     = Carbon::createFromFormat('Y-m-d', $to_date);
        $date       = $fromDate->copy();
        $totalDays  = 0;
        $totalHours = 0;
        while ($date->lt($toDate)) {

            $dayOfWeek  = $date->dayOfWeek;
            $countDays  = 0;
            $countHours = 0;
            switch ($dayOfWeek) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                    $countDays = 1;
                    break;
                case 6:
                    $countDays = 0.5;
                    break;
                case 0:
                default:
                    break;
            }

            $dayString = $date->format('Y-m-d');
            if (isset($mapWorking[$dayString])) {
                $currentWorking = $mapWorking[$dayString];
                $countHours     = $currentWorking["working_hours"] / 60;

                if (1 == $currentWorking["is_holiday"]) {
                    $countDays -= $currentWorking["holiday_hours"] / 8;
                } elseif (3 == $currentWorking["absent_type"]) {
                    $countDays -= 1;
                } elseif (1 == $currentWorking["absent_type"] || 2 == $currentWorking["absent_type"]) {
                    $countDays -= 0.5;
                }

                $countDays = max($countDays, 0);
            }

            $totalDays += $countDays;
            if ($countDays > 0) {
                $totalHours += $countHours;
            }

            // Log::info( ' - ' . $date->format('Y-m-d') . ' ' . $countDays . ' - ' . $totalHours);
            $date->addDays(1);
        }

        $result = [
            "total_days"  => $totalDays,
            "total_hours" => $totalHours,
        ];

// Log::info("selectWorkingHour $from_date, $to_date, $employee_id");
        // Log::info(print_r($result,true));

        return $result;
    }

    /**
     * @param $date
     * @param $employee_id
     * @return mixed
     */
    public function selectCurrentContract(
        $date,
        $employee_id
    ) {
        $sqlParam = [$employee_id, $date];
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
          a.employee_id = ? and
          ? <= a.end_date
        order by
          a.start_date asc
        limit
          1
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) > 0) {
            return $result[0];
        }

        return null;
    }

    /**
     * Calculate salary
     *
     * @param TrnSalaryDetail $detail
     * @return void
     */
    public function calculateSalaryDetail(
        TrnSalaryDetail $detail,
        TrnSalary $salary
    ) {

        $detail->real_salary = round($detail->gross_salary * floatval($detail->total_days) / floatval($salary->total_days), 0);

        $totalIncome = $detail->real_salary + $detail->overtime_salary + $detail->bonus;

        $detail->tax_bhxh = round($detail->basic_salary * $salary->tax_bhxh_percent / 100);
        $detail->tax_bhyt = round($detail->basic_salary * $salary->tax_bhyt_percent / 100);
        $detail->tax_bhtn = round($detail->basic_salary * $salary->tax_bhtn_percent / 100);

        $detail->com_tax_bhxh = round($detail->basic_salary * $salary->com_tax_bhxh_percent / 100);
        $detail->com_tax_bhyt = round($detail->basic_salary * $salary->com_tax_bhyt_percent / 100);
        $detail->com_tax_bhtn = round($detail->basic_salary * $salary->com_tax_bhtn_percent / 100);

        // Tinh PIT
        $basicPIT = 9000000;
        Log::debug($salary->from_date);
        if ($salary->from_date >= '2021-01-01' ) {
            $basicPIT = 11000000;
        }
        $salaryAfterDependent = $detail->real_salary - $basicPIT - $detail->count_dependent_person * 4400000;
        $pit                  = $this->calculatePIT($salaryAfterDependent);
        $detail->tax_pit      = $pit["amount"];

        return $detail;
    }

    /**
     * Calcualte PIT
     *
     * @param [type] $salary after minus dependent perons
     * @return void
     */
    public function calculatePIT($salary)
    {
        $result = [];

        if ($salary <= 0) {
            $result = [
                "details" => [],
                "amount"  => 0,
            ];

            return $result;
        }

        $listRange = [
            [
                "amount"  => 5000000,
                "percent" => 0.05,
            ],
            [
                "amount"  => 10000000,
                "percent" => 0.1,
            ],
            [
                "amount"  => 18000000,
                "percent" => 0.15,
            ],
            [
                "amount"  => 32000000,
                "percent" => 0.2,
            ],
            [
                "amount"  => 52000000,
                "percent" => 0.25,
            ],
            [
                "amount"  => 80000000,
                "percent" => 0.3,
            ],
            [
                "amount"  => 9000000000,
                "percent" => 0.35,
            ],
        ];

        $pit           = 0;
        $details       = [];
        $previousRange = 0;

        foreach ($listRange as $range) {
            $temp   = min($salary, $range["amount"] - $previousRange);
            $curPIT = $temp * $range["percent"];
            $pit += $curPIT;

            $details[] = [
                "pit"     => $curPIT,
                "amount"  => $range["amount"],
                "percent" => $range["percent"],
            ];

            $salary = $salary - $temp;

            if ($salary <= 0) {
                break;
            }

            $previousRange = $range["amount"];
        }

        $result = [
            "details" => $details,
            "amount"  => $pit,
        ];

        return $result;
    }

    /**
     * @param $salary_id
     */
    public function updateSalaryTotal($salary_id)
    {
        $salary  = TrnSalary::find($salary_id);
        $details = TrnSalaryDetail::where('salary_id', $salary_id)->get();

        Log::info('updateSalaryTotal');
        Log::info(print_r($salary, true));
        Log::info(print_r($details, true));

        $total_bhxh       = 0;
        $total_bhyt       = 0;
        $total_bhtn       = 0;
        $total_com_bhxh   = 0;
        $total_com_bhyt   = 0;
        $total_com_bhtn   = 0;
        $total_amount     = 0;
        $total_com_amount = 0;

        foreach ($details as $detail) {
            Log::info($detail);
            $total_bhxh += $detail->tax_bhxh;
            $total_bhyt += $detail->tax_bhyt;
            $total_bhtn += $detail->tax_bhtn;
            $total_com_bhxh += $detail->com_tax_bhxh;
            $total_com_bhyt += $detail->com_tax_bhyt;
            $total_com_bhtn += $detail->com_tax_bhtn;

            $payForEmployee = $detail->real_salary + $detail->overtime_salary + $detail->bonus - $detail->minus_amount - $detail->advance;
            $total_amount += $payForEmployee;
            $total_com_amount += $payForEmployee + ($detail->com_tax_bhxh + $detail->com_tax_bhyt + $detail->com_tax_bhtn);
        }

        $salary->total_amount     = $total_amount;
        $salary->total_com_amount = $total_com_amount;
        $salary->total_bhxh       = $total_bhxh;
        $salary->total_bhyt       = $total_bhyt;
        $salary->total_bhtn       = $total_bhtn;
        $salary->total_com_bhxh   = $total_com_bhxh;
        $salary->total_com_bhyt   = $total_com_bhyt;
        $salary->total_com_bhtn   = $total_com_bhtn;
        Log::info("after update");
        Log::info(print_r($salary, true));

        $this->updateRecordHeader($salary, null, false);
        $salary->save();
    }

}
