<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\TrnWorkingHours;

class Bat0410Service extends BaseService
{
    public function __construct() {}

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

        foreach ($listWorkingDays as $workingDays) {
            Log::info(print_r($workingDays, true));
            $entity               = new TrnWorkingHours();
            $entity->user_id      = $workingDays->user_id;
            $entity->working_date = Carbon::create($workingDays->year, $workingDays->month, $workingDays->day, 0, 0, 0);

            $entity->start_time = Carbon::createFromTime(round($workingDays->min / 60), $workingDays->min % 60);
            $entity->end_time   = Carbon::createFromTime(round($workingDays->max / 60), $workingDays->max % 60);

            $entity->first_time = Carbon::createFromTime(round($workingDays->min / 60), $workingDays->min % 60);
            $entity->last_time  = Carbon::createFromTime(round($workingDays->max / 60), $workingDays->max % 60);

            $working               = $workingDays->max - $workingDays->min;
            $entity->working_hours = $working;

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
              a.user_id
              , a.created_at
            from
              trn_audit_log a
            where
              ? < a.created_at
              and a.created_at < ?
            union all
            select
              b.salesman_id as user_id
              , b.working_time as created_at
            from
              trn_store_check_in b
            where
              ? < b.working_time
              and b.working_time < ?
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
            Carbon::parse($fromDate . ' 00:00:00.000'), Carbon::parse($toDate . ' 23:59:59.999'),
            Carbon::parse($fromDate . ' 00:00:00.000'), Carbon::parse($toDate . ' 23:59:59.999'),
        ];

        return DB::select(DB::raw($sql), $sqlParams);
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
