<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;

/**
 * Hrm0141Service class
 */
class Hrm0141Service extends BaseService
{
    /**
     * @param AbsentService $absentService
     * @param DownloadService $downloadService
     */
    public function __construct(
        AbsentService $absentService,
        DownloadService $downloadService
    ) {
        $this->absentService   = $absentService;
        $this->downloadService = $downloadService;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $calendar = $this->getCalendar($param['month']);

        $workingHours = $this->getWorkingHours($param);
        $dayOffs      = $this->getDayOffs($param);

        $listHolidays = $this->getHoliday($param);

        $result = $this->setToCalendar($calendar, $workingHours, $dayOffs, $listHolidays);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getHoliday($param)
    {
        $monthString = $param['month'];
        $startDate   = Carbon::createFromFormat('Y-m-d', $monthString . '-01')->startOfMonth();
        $endDate     = $startDate->copy()->endOfMonth();

        $listHolidays = $this->absentService->searchHolidayForCalendar([
            'startDate' => $startDate->format('Y-m-d'),
            'endDate'   => $endDate->format('Y-m-d'),
        ]);

        return $listHolidays;
    }

    /**
     * Get calendar 1 month
     *
     * @param [String] $monthString YYYY-mm
     * @return void
     */
    private function getCalendar($monthString)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $monthString . '-01')->startOfMonth();
        $endDate   = $startDate->copy()->endOfMonth();

        $result = [];

        $date = $startDate->copy();

        while ($date->lt($endDate)) {
            $item = array(
                'date' => $date->format('Y-m-d'),
            );
            $dayOfWeek = $date->dayOfWeek;

            if (0 == $dayOfWeek) {
                $item["workday"] = 0;
            } else if (6 == $dayOfWeek) {
                $item["workday"] = 0.5;
            } else {
                $item["workday"] = 1;
            }

            $item["is_holiday"] = 0;

            $result[] = $item;
            $date->addDays(1);
        }

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    private function getWorkingHours($param)
    {
        $monthString = $param['month'];
        $startDate   = Carbon::createFromFormat('Y-m-d', $monthString . '-01')->startOfMonth();
        $endDate     = $startDate->copy()->endOfMonth();

        $sqlParam = array(
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d'),
        );
        $sql = "
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
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                trn_working_hours a
            where
                ? <= working_date
                and working_date <= ?
        ";

        $sql .= $this->andWhereInt($param, "user_id", "a.user_id", $sqlParam);
        $sql .= "
            order by a.user_id, a.working_date
        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $calendar
     * @param $workingHours
     * @return mixed
     */
    private function setToCalendar(
        $calendar,
        $workingHours,
        $dayOffs,
        $listHolidays
    ) {

        foreach ($workingHours as $day) {
            $dayIndex                                = Carbon::createFromFormat('Y-m-d', $day->working_date)->day - 1;
            $calendar[$dayIndex]['first_time']       = $day->first_time;
            $calendar[$dayIndex]['last_time']        = $day->last_time;
            $calendar[$dayIndex]['start_time']       = $day->start_time;
            $calendar[$dayIndex]['end_time']         = $day->end_time;
            $calendar[$dayIndex]['working_hours']    = $day->working_hours;
            $calendar[$dayIndex]['working_hour_min'] =
            str_pad((string) (floor($day->working_hours / 60)), 2, "0", STR_PAD_LEFT) . ":" .
            str_pad((string) ($day->working_hours % 60), 2, "0", STR_PAD_LEFT);
        }

        foreach ($dayOffs as $day) {
            $dayIndex                             = Carbon::createFromFormat('Y-m-d', $day->absent_date)->day - 1;
            $calendar[$dayIndex]['absent_type']   = $day->absent_type;
            $calendar[$dayIndex]['absent_reason'] = $day->reason;
            $calendar[$dayIndex]['absent_amount'] = $day->amount;
            $calendar[$dayIndex]['leave_type']    = $day->leave_type;
        }

        foreach ($listHolidays as $holiday) {
            $dayIndex                              = Carbon::createFromFormat('Y-m-d', $holiday->holiday_date)->day - 1;
            $calendar[$dayIndex]['is_holiday']     = 1;
            $calendar[$dayIndex]['holiday_reason'] = $holiday->reason;

            $calendar[$dayIndex]['first_time']       = "";
            $calendar[$dayIndex]['last_time']        = "";
            $calendar[$dayIndex]['start_time']       = "";
            $calendar[$dayIndex]['end_time']         = "";
            $calendar[$dayIndex]['working_hours']    = 0;
            $calendar[$dayIndex]['working_hour_min'] = 0;
        }

        return $calendar;
    }

    /**
     * @param $param
     * @return mixed
     */
    private function getDayOffs($param)
    {
        $monthString = $param['month'];
        $startDate   = Carbon::createFromFormat('Y-m-d', $monthString . '-01')->startOfMonth();
        $endDate     = $startDate->copy()->endOfMonth();

        $sqlParam = array(
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d'),
        );
        $sql = "
        select
            id
            , user_id
            , absent_date
            , amount
            , absent_type
            , reason
            , status
            , approve_user_id
            , cmt
            , leave_type
        from
            trn_absent
        where
            ? <= absent_date
            and absent_date <= ?
            and status = 1
        ";
        // and user_id = ?

        $sql .= $this->andWhereInt($param, "user_id", "user_id", $sqlParam);
        $sql .= "
            order by user_id, absent_date
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @return mixed
     */
    public function selectListEmployee()
    {
        $sqlParam = [];
        $sql      = "
        select
          a.employee_id
          , a.employee_code
          , a.fullname
          , b.email
        from
          mst_employee_info a
          left join users b
            on a.employee_id = b.id
        where a.active_flg = 1
        order by a.employee_code
        ";

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListAll($param)
    {
        $calendar     = $this->getCalendar($param['month']);
        $listHolidays = $this->getHoliday($param);
        $listEmployee = $this->selectListEmployee();
        $dayOffs      = $this->getDayOffs($param);
        $workingHours = $this->getWorkingHours($param);

// Set holiday
        foreach ($listHolidays as $holiday) {
            for ($i = 0; $i < count($calendar); $i++) {
                if ($holiday->holiday_date == $calendar[$i]["date"]) {
                    $calendar[$i]["is_holiday"] = 1;
                }

            }

        }

        $listEmployeeCal = $this->setToCalendarAll($calendar, $workingHours, $dayOffs, $listHolidays, $listEmployee);

        // return $result;

        return [
            "calendar"        => $calendar,
            "listEmployee"    => $listEmployee,
            // "listHolidays" => $listHolidays,
            "dayOffs"         => $dayOffs,
            // "workingHours" => $workingHours,
            "listEmployeeCal" => $listEmployeeCal,
        ];
    }

    /**
     * Set calendar for all
     *
     * @param [type] $calendar
     * @param [type] $workingHours
     * @param [type] $dayOffs
     * @param [type] $listHolidays
     * @param [type] $listEmployee
     * @return void
     */
    private function setToCalendarAll(
        $calendar,
        $workingHours,
        $dayOffs,
        $listHolidays,
        $listEmployee
    ) {

        // $calendar = [];

        $listCalendar = [];

        // Create calendar for each employee
        Log::info("********* listEmployee");
        Log::info(print_r($listEmployee, true));

        foreach ($listEmployee as $employee) {
            $calForEmployee                             = $calendar; // Clone calendar
            $listCalendar[$employee->employee_id . "-"] = [
                "id"       => $employee->employee_id,
                "code"     => $employee->employee_code,
                "fullname" => $employee->fullname,
                "days"     => $calForEmployee,
                "summary"  => [],
            ];
        }

        foreach ($workingHours as $day) {

// if ($day->user_id == 3) {

//     Log::info("************************");

//     Log::info(print_r($day, true));

//     Log::info(print_r( $listCalendar[$day->user_id . "-" ], true));

// }

            if (!isset($listCalendar[$day->user_id . "-"])) {
                continue;
            }

            $dayIndex = Carbon::createFromFormat('Y-m-d', $day->working_date)->day - 1;
            // $listCalendar[$day->user_id]["days"][$dayIndex] = $day->working_hours;

            $dayInfo = [];

            if (isset($listCalendar[$day->user_id . "-"]["days"][$dayIndex])) {
                $dayInfo = $listCalendar[$day->user_id . "-"]["days"][$dayIndex];
            }

            $dayInfo['working_hours']    = $day->working_hours;
            $dayInfo['working_hour_min'] =
            str_pad((string) (floor($day->working_hours / 60)), 2, "0", STR_PAD_LEFT) . ":" .
            str_pad((string) ($day->working_hours % 60), 2, "0", STR_PAD_LEFT);
            $listCalendar[$day->user_id . "-"]["days"][$dayIndex] = $dayInfo;
        }

        foreach ($dayOffs as $day) {
            $dayIndex = Carbon::createFromFormat('Y-m-d', $day->absent_date)->day - 1;

            $dayInfo = [];

            if (isset($listCalendar[$day->user_id . "-"]["days"][$dayIndex])) {
                $dayInfo = $listCalendar[$day->user_id . "-"]["days"][$dayIndex];
            }

            $dayInfo['absent_type']                               = $day->absent_type;
            $dayInfo['absent_reason']                             = $day->reason;
            $dayInfo['absent_amount']                             = $day->amount;
            $dayInfo['leave_type']                                = $day->leave_type;
            $listCalendar[$day->user_id . "-"]["days"][$dayIndex] = $dayInfo;
        }

        return $listCalendar;
    }

    /**
     * Download excel file
     *
     * @param [type] $param
     * @return void
     */
    public function download($param)
    {
        $sheets = [];

        // Print all
        $listAll  = $this->selectListAll($param);
        $sheets[] = [
            "name" => "ALL",
            "data" => [
                'listAll' => $listAll,
                'month'   => $param['month'],
            ],
            "view" => "hrm0141-list",
        ];

        // Print child
        $listEmployee = $listAll["listEmployee"];

        foreach ($listEmployee as $employee) {
            $childData = $this->selectList([
                "month"   => $param["month"],
                "user_id" => $employee->employee_id,
            ]);
            Log::info("child -------");
            Log::info(print_r($childData, true));
            $sheets[] = [
                "name" => $employee->employee_code,
                "data" => [
                    'calendar' => $childData,
                    'employee' => $employee,
                    'month'    => $param['month'],
                ],
                "view" => "hrm0141-detail",
            ];
        }

        $paramDownload = [
            "file_name" => "TimeTable",
            "view"      => "hrm0141",
            "sheets"    => $sheets,
        ];

        $result = $this->downloadService->downloadExcelFileMultiSheets($paramDownload);

        return $result;
    }

}
