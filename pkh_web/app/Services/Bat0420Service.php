<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnWorkingHours;

class Bat0420Service extends BaseService
{
    /**
     * @param AbsentService $absentService
     */
    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
    }

    /**
     * @param $fromDate
     * @param $toDate
     */
    public function updateTime(
        $fromDate,
        $toDate
    ) {
        // remove current working hours
        $this->removeWorkingHours($fromDate, $toDate);

        $listWorkingDays = $this->selectWorkingTimeByDay($fromDate, $toDate);

        $listHolidays = $this->absentService->searchHolidayForCalendar([
            'startDate' => $fromDate,
            'endDate'   => $toDate,
        ]);

        $mapHolidays = [];

        foreach ($listHolidays as $holiday) {
            $mapHolidays[$holiday->holiday_date] = $holiday;
        }

        foreach ($listWorkingDays as $workingDays) {
            $entity               = new TrnWorkingHours();
            $entity->user_id      = $workingDays->user_id;
            $entity->working_date = Carbon::create($workingDays->year, $workingDays->month, $workingDays->day, 0, 0, 0);

            $workingDateString = $entity->working_date->format('Y-m-d');

            $startTimeHourRound = floor($workingDays->min / 60);
            $endTimeHourRound   = floor($workingDays->max / 60);

            $startTimeMinRound = round(($workingDays->min % 60) / 15 + 0.5) * 15;
            $endTimeMinRound   = abs(round(($workingDays->max % 60) / 15 - 0.5) * 15);

            if (($endTimeHourRound * 60 + $endTimeMinRound) <= ($startTimeHourRound * 60 + $startTimeMinRound)) {
                $endTimeMinRound = $startTimeMinRound;
            }

            $isWorkingAm = true;
            $isWorkingPm = true;

            if ($workingDays->min > 12 * 60) {
                $isWorkingAm = false;
            }

            if ($workingDays->max < 13 * 60) {
                $isWorkingPm = false;
            }

//$working               = $endTimeHourRound * 60 + $endTimeMinRound - ($startTimeHourRound * 60 + $startTimeMinRound);

// Morning
            if ($isWorkingAm) {

// $workingAm = 12 * 60 + 0 - ($startTimeHourRound * 60 + $startTimeMinRound);
                if ($workingDays->max > 12 * 60) {
                    $workingAm = 12 * 60 + 0 - ($startTimeHourRound * 60 + $startTimeMinRound);
                } else {
                    $workingAm = $endTimeHourRound * 60 + $endTimeMinRound - ($startTimeHourRound * 60 + $startTimeMinRound);
                }

            } else {
                $workingAm = 0;
            }

// Afternoon
            if ($isWorkingPm) {
                $workingPm1 = $endTimeHourRound * 60 + $endTimeMinRound - (13 * 60 + 0);
                $workingPm2 = $endTimeHourRound * 60 + $endTimeMinRound - ($startTimeHourRound * 60 + $startTimeMinRound);
                $working    = max(0, $workingAm) + max(0, min($workingPm1, $workingPm2));
            } else {
                $working = max(0, $workingAm);
            }

            if (isset($mapHolidays[$workingDateString])) {
                $entity->is_holiday    = '1';
                $entity->holiday_hours = $mapHolidays[$workingDateString]->amount * 8;

                if ($mapHolidays[$workingDateString]->amount >= 1) {
                    $entity->working_hours = 0;
                } else {
                    $entity->working_hours = max(0, $working - $entity->holiday_hours);
                }

            } else {
                $entity->start_time = Carbon::createFromTime($startTimeHourRound, $startTimeMinRound);
                $entity->end_time   = Carbon::createFromTime($endTimeHourRound, $endTimeMinRound);

                $entity->first_time = Carbon::createFromTime($startTimeHourRound, $workingDays->min % 60);
                $entity->last_time  = Carbon::createFromTime($endTimeHourRound, $workingDays->max % 60);

                $entity->working_hours = $working;
            }

            $this->updateRecordHeader($entity, 1, true);
            $entity->save();
        }

    }

    /**
     * @param $fromDate
     * @param $toDate
     */
    private function selectWorkingTimeByDay(
        $fromDate,
        $toDate
    ) {
        // Select by login on portal & checkin by mobile
        $sql = "
        select
          user_id
          , year (created_at) as year
          , month (created_at) as month
          , day (created_at) as day
          , min(hour (created_at) * 60 + minute (created_at)) as min
          , max(hour (created_at) * 60 + minute (created_at)) as max
        from
          (
            select
              a.user_id as user_id
              , a.working_time as created_at
            from
              trn_attendance a
            where
              ? < a.working_time
              and a.working_time < ?
          ) c
        group by
          user_id
          , year (created_at)
          , month (created_at)
          , day (created_at)
        order by
          user_id
          , year (created_at)
          , month (created_at)
          , day (created_at)
        ";

        $sqlParams = [
            Carbon::parse($fromDate . ' 00:00:00.000'),
            Carbon::parse($toDate . ' 23:59:59.999'),
        ];

        $result = DB::select(DB::raw($sql), $sqlParams);

        return $result;
    }

    /**
     * @param $fromDate
     * @param $toDate
     */
    private function removeWorkingHours(
        $fromDate,
        $toDate
    ) {
        $sql = "
        delete from trn_working_hours
        where
          working_date between ? and ?
          ";
        $sqlParams = [Carbon::parse($fromDate . ' 00:00:00.000'), Carbon::parse($toDate . ' 23:59:59.999')];

        return DB::delete(DB::raw($sql), $sqlParams);
    }

}
