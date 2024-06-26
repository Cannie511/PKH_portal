<?php

namespace App\Services;

use Carbon\Carbon;

class AttendanceService extends BaseService
{
    /**
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(AbsentService $absentService)
    {
        $this->absentService = $absentService;
    }

    /**
     * Get working days and hours
     *
     * @param Date $fromDate
     * @param Date $toDate
     * @return array days, hours
     */
    public function getWorkingDay(
        $fromDate,
        $toDate
    ) {
        $listHolidays = $this->absentService->searchHolidayForCalendar([
            'startDate' => $fromDate,
            'endDate'   => $toDate,
        ]);

        $mapHoliday = [];

        foreach ($listHolidays as $day) {
            $mapHoliday[$day->holiday_date] = $day->amount;
            // Log::info('Holiday: ' . $day->holiday_date . ' ' . $day->amount);
        }

        $fromDate   = Carbon::createFromFormat('Y-m-d', $fromDate);
        $toDate     = Carbon::createFromFormat('Y-m-d', $toDate);
        $date       = $fromDate->copy();
        $totalDays  = 0;
        $totalHours = 0;

        while ($date->lt($toDate) || $date->eq($toDate)) {

            $dayOfWeek = $date->dayOfWeek;
            $countDays = 0;

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

            if (isset($mapHoliday[$dayString])) {
                $countDays = max($countDays - $mapHoliday[$dayString], 0);
            }

            $totalDays += $countDays;
            $totalHours += $countDays * 8;

            // Log::info( ' - ' . $date->format('Y-m-d') . ' ' . $countDays . ' - ' . $totalHours);
            $date->addDays(1);
        }

        $result = [
            "days"  => $totalDays,
            "hours" => $totalHours,
        ];

        return $result;
    }

// public function searchHolidayForCalendar($param)

// {

//     $sqlParam = array();

//     $sql      = "

//         select

//           a.id

//           , a.holiday_date

//           , a.reason

//           , a.amount

//         from

//           mst_holiday a

//           where

//             a.active_flg = '1'

//       ";

//     $sql .= $this->andWhereDateBetween($param, 'startDate', 'endDate', 'a.holiday_date', $sqlParam);

//     Log::info($sqlParam);

//     $sql .= "

//     order by a.holiday_date

//     ";

//     return DB::select(DB::raw($sql), $sqlParam);

// }

// /**

//  * Register absent

//  * @param  [type] $param

//  *         user_id

//  *         absent_date

//  *         absent_type

//  *         reason

//  * @return [type]        [description]

//  */

// public function regisAbsent($param)

// {

//     $logonUser = $this->logonUser();

//     $entity              = new TrnAbsent();

//     $entity->user_id     = $param["user_id"];

//     $entity->absent_date = $param["absent_date"];

//     $entity->reason      = $param["reason"];

//     $entity->absent_type = $param["absent_type"];

//     $entity->leave_type  = $param["leave_type"];

//     if (config('constants.ABSENT_TYPE_AM') == $param["absent_type"] || config('constants.ABSENT_TYPE_PM') == $param["absent_type"]) {

//         $entity->amount = 0.5;

//     } else {

//         $entity->amount = 1;

//     }

//     if($param["leave_type"] == '1') {

//         $entity->leave_allocation_id  = $param["leave_allocation_id"];

//         $used = $this->selectAllocationUsed($param["leave_allocation_id"]);

//         $allocation = TrnLeaveAllocation::find($entity->leave_allocation_id);

//         if ( $entity->amount + $used > $allocation->num_days) {

//             return $this->fail("Không còn đủ ngày phép");

//         }

//         if(Carbon::createFromFormat('Y-m-d', $entity->absent_date) > ($allocation->expired_date)) {

//             return $this->fail("Ngày đăng ký đã quá hạn");

//         }

//     } else {

//         $entity->leave_allocation_id  = null;

//     }

//     $entity->status = config('constants.ABSENT_STS_NEW');

//     $this->updateRecordHeader($entity, $logonUser, true);

//     if ($entity->save()) {

//         $typeName = '(Cả ngày)';

//         if (config('constants.ABSENT_TYPE_AM') == $param["absent_type"]) {

//             $typeName = '(Nghỉ buổi sáng)';

//         } elseif (config('constants.ABSENT_TYPE_PM') == $param["absent_type"]) {

//             $typeName = '(Nghỉ buổi chiều)';

//         }

//         // Send notify mail

//         $mailParam = [

//             'name'   => $logonUser->name,

//             'mail'   => $logonUser->email,

//             'type'   => $typeName,

//             'reason' => $entity->reason,

//             'date'   => $param["absent_date"],

//         ];

//         Mail::queue('admin.emails.absent_notify', ['param' => $mailParam], function ($m) use ($mailParam) {

//             $emails = ['chien.phan@phankhangco.com', 'cuong.nguyen@phankhangco.com', 'anh.phan@phankhangco.com'];

//             $m->from('no-reply@phankhangco.com', 'PKH Automation');

//             $m->to($emails, '[PKH-INFO]')->subject('[ABSENT] ' . date('Y-m-d H:i:s') . ' ' . $mailParam['name'] . ' ' . $mailParam['date'] . ' ' . $mailParam['type']);

//         });

//         return $this->ok();

//     }

//     return $this->fail();

// }

// /**

//  * Search absent

//  * @param  [type] $param [description]

//  *                       user_id

//  * @return [type]        [description]

//  */

// public function search(

//     $param,

//     $paging = false

// ) {

//     $sqlParam = array();

//     $sql      = "

//     select

//       a.id

//       , a.user_id

//       , a.absent_date

//       , a.amount

//       , a.absent_type

//       , a.leave_type

//       , a.reason

//       , a.status

//       , a.created_at

//       , a.version_no

//       , a.approve_user_id

//       , b.name approve_name

//       , a.cmt

//       , c.name user_name

//       , a.approve_ts

//       , d.reason allocation_reason

//     from

//       trn_absent a

//       left join users b

//         on b.id = a.approve_user_id

//       left join users c

//         on c.id = a.user_id

//       left join trn_leave_allocation d

//         on a.leave_allocation_id = d.id

//     where

//       a.active_flg = '1'

//     ";

//     $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);

//     $sql .= $this->andWhereInt($param, 'type', 'a.absent_type', $sqlParam);

//     $sql .= $this->andWhereInt($param, 'status', 'a.status', $sqlParam);

//     $sql .= $this->andWhereString($param, 'keyword', 'a.reason', $sqlParam);

//     $sql .= $this->andWhereDateBetween($param, 'startDate', 'endDate', 'a.absent_date', $sqlParam);

//     $sql .= "

//         order by a.created_at desc, a.absent_date desc

//     ";

//     if ($paging) {

//         return $this->pagination($sql, $sqlParam, $param);

//     }

//     return DB::select(DB::raw($sql), $sqlParam);

// }

// /**

//  * Search absent

//  * @param  [type] $param [description]

//  *                       user_id

//  * @return [type]        [description]

//  */

// public function searchForCalendar($param)

// {

//     $sqlParam = array();

//     $sql      = "

//         select

//           a.id

//           , a.user_id

//           , a.absent_date

//           , a.amount

//           , a.absent_type

//           , a.reason

//           , a.status

//           , a.created_at

//           , a.version_no

//           , a.approve_user_id

//           , b.name approve_name

//           , a.cmt

//           , c.name user_name

//           , a.approve_ts

//         from

//           trn_absent a

//           left join users b

//               on b.id  = a.approve_user_id

//           left join users c

//               on c.id  = a.user_id

//         where

//           a.active_flg = '1'

//           and a.status IN ('0','1')

//     ";

//     if (isset($param['startDate']) && !empty($param['startDate'])

//         && isset($param['endDate']) && !empty($param['endDate'])) {

//         $sql .= "

//             and a.absent_date between ? and ?

//         ";

//         $sqlParam[] = $param["startDate"];

//         $sqlParam[] = $param["endDate"];

//     }

//     $sql .= "

//         order by a.created_at desc, a.absent_date desc

//     ";

//     return DB::select(DB::raw($sql), $sqlParam);

// }

// /**

//  * Search absent

//  * @param  [type] $param [description]

//  *                       user_id

//  * @return [type]        [description]

//  */

// public function getListOfUser(

//     $param = false,

//     $paging = false

// ) {

//     $sqlParam = array();

//     $sql      = "

//         select

//           a.id

//           , a.user_id

//           , a.absent_date

//           , a.amount

//           , a.absent_type

//           , a.leave_type

//           , a.reason

//           , a.status

//           , a.created_at

//           , a.version_no

//           , a.approve_user_id

//           , b.name approve_name

//           , a.cmt

//           , c.name user_name

//           , d.reason allocation_reason

//         from

//           trn_absent a

//           left join users b

//               on b.id  = a.approve_user_id

//           left join users c

//               on c.id  = a.user_id

//           left join trn_leave_allocation d

//               on a.leave_allocation_id = d.id

//         where

//           a.active_flg = '1'

//     ";

//     // $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);

//     $sql .= "

//         order by a.created_at desc, a.absent_date desc

//     ";

//     if ($paging) {

//         return $this->pagination($sql, $sqlParam, $param);

//     }

//     return DB::select(DB::raw($sql), $sqlParam);

// }

// /**

//  * Accept absent

//  * @param  [type] $param [description]

//  *                       id

//  *                       notes

//  * @return [type]        [description]

//  */

// public function accept($param)

// {

//     $logonUser = $this->logonUser();

//     $entity    = TrnAbsent::find($param['id']);

//     if (isset($entity) && config('constants.ABSENT_STS_NEW') == $entity->status) {

//         if($entity->leave_type == '1') {

//             $used = $this->selectAllocationUsed($entity->leave_allocation_id);

//             $allocation = TrnLeaveAllocation::find($entity->leave_allocation_id);

//             if ( $entity->amount + $used > $allocation->num_days) {

//                 return $this->fail("Không còn đủ ngày phép");

//             }

//         }

//         $entity->status          = config('constants.ABSENT_STS_ACCEPT');

//         $entity->cmt             = $param['notes'];

//         $entity->approve_ts      = Carbon::now();

//         $entity->approve_user_id = $logonUser->id;

//         $this->updateRecordHeader($entity, $logonUser);

//         $entity->save();

//         return $this->ok();

//     }

//     return $this->fail();

// }

// /**

//  * Deny absent

//  * @param  [type] $param [description]

//  *                       id

//  *                       notes

//  * @return [type]        [description]

//  */

// public function deny($param)

// {

//     $logonUser = $this->logonUser();

//     $entity    = TrnAbsent::find($param['id']);

//     if (isset($entity) && config('constants.ABSENT_STS_NEW') == $entity->status) {

//         $entity->status          = config('constants.ABSENT_STS_DENY');

//         $entity->cmt             = $param['notes'];

//         $entity->approve_ts      = Carbon::now();

//         $entity->approve_user_id = $logonUser->id;

//         $this->updateRecordHeader($entity, $logonUser);

//         $entity->save();

//         return $this->ok();

//     }

//     return $this->fail();

// }

// /**

//  * Select current allocation of employee

//  *

//  * @param [type] $id

//  * @return void

//  */

// public function selectAllocationByEmployee($id) {

//     $sqlParam = array();

//     $sql      = "

//     select

//       a.id

//       , a.employee_id

//       , a.num_days

//       , a.reason

//       , a.expired_date

//       , a.notes

//     from

//       trn_leave_allocation a

//     where

//       a.employee_id = ?

//       and a.expired_date >= current_date ()

//     order by

//       a.expired_date

//     ";

//     $sqlParam[] = $id;

//     $result = DB::select(DB::raw($sql), $sqlParam);

//     return $result;

// }

// public function selectAllocationUsed($id) {

//     $sqlParam = array();

//     $sql      = "

//     select

//       coalesce(sum(amount),0) amount

//     from

//       trn_absent

//     where

//       leave_type = 1

//       and status = 1

//       and leave_allocation_id = ?

//     ";

//     $sqlParam[] = $id;

//     $result = DB::select(DB::raw($sql), $sqlParam);

//     return $result[0]->amount;

// }

// public function searchHolidayForCalendar($param)

// {

//     $sqlParam = array();

//     $sql      = "

//         select

//           a.id

//           , a.holiday_date

//           , a.reason

//           , a.amount

//         from

//           mst_holiday a

//           where

//             a.active_flg = '1'

//       ";

//     $sql .= $this->andWhereDateBetween($param, 'startDate', 'endDate', 'a.holiday_date', $sqlParam);

//     Log::info($sqlParam);

//     $sql .= "

//     order by a.holiday_date

//     ";

//     return DB::select(DB::raw($sql), $sqlParam);
    // }
}
