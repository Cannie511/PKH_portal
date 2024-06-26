<?php

namespace App\Services;

use DB;
use File;
use Mail;
use Cache;
use Excel;
use Log;
use Carbon\Carbon;
use App\Models\TrnTaskUser;

class Hrm0300Service extends BaseService
{
// /**

//  * Select list

//  *

//  * @param [type] $params

//  * @return void

//  */

// public function selectUsers($param)

// {

//     $sqlParam = array();

//     $sql      = "

//         select

//             a.id,

//             a.name

//         from users a

//         where a.email_verified = 1

//     ";

//     return DB::select(DB::raw($sql), $sqlParam);

// }

    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.task_id
                , b.task_group_name
                , c.name as user_name
                , c.email
                , a.task_name
                , a.task_score
                , a.task_sts
                , a.start_date
                , a.deadline
                , a.end_date
                , a.submit_notes
                , a.task_content
                , a.task_group_id
                , a.user_id
                , d.name as    task_creator
                , d.email as task_creator_mail
                , a.created_by
                , a.created_at
                , a.response_notes
                , datediff(now(), a.deadline) as delay
                , datediff(a.end_date, a.deadline) as delay_1
            from
                trn_task_user a left join mst_task_group b on
                a.task_group_id = b.task_group_id
                left join users c on
                a.user_id = c.id
                left join users d on
                    a.created_by = d.id
            where
            a.active_flg ='1' and c.email_verified = 1
      ";

// Show cho role ngoai admin, manager va it thay task duoc giao va task ho tu tao
        if (isset($param["acc_user_id"])) {
            $sql .= " and (a.user_id = ? or a.created_by = ? )";
            $sqlParam[] = $param["acc_user_id"];
            $sqlParam[] = $param["acc_user_id"];
        }

        // $sql .= $this->andWhereInt($param, 'acc_user_id', 'a.user_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'user_id', 'a.user_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'created_by', 'a.created_by', $sqlParam);
        $sql .= $this->andWhereInt($param, 'task_sts', 'a.task_sts', $sqlParam);
        $sql .= $this->andWhereString($param, 'task_name', 'a.task_name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'group_task_id', 'a.group_task_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'assign_id', 'a.user_id', $sqlParam);

        // $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);

        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.deadline', $sqlParam);

        $sql .= "

            order by a.deadline desc

        ";

        if (1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     */
    public function selectReportForm1($param)
    {
        $sqlParam = array();
        $sql      = "
        select
        a.id
        , a.name
        , coalesce(b.count,0) as count
        , coalesce(b.min,0) as min
        , coalesce(b.max,0) as max
        , coalesce(b.avg,0) as avg
        , coalesce(b.min_1,0) as min_1
        , coalesce(b.max_1,0) as max_1
        , coalesce(b.avg_1,0) as avg_1
            from
            users a left join
        ( select
                c.id
                , count(*) as count
                , min(datediff(now(), a.deadline)) as min
                , max(datediff(now(), a.deadline)) as max
                , avg(datediff(now(), a.deadline)) as avg
                , min(datediff(a.end_date, a.deadline)) as min_1
                , max(datediff(a.end_date, a.deadline)) as max_1
                , avg(datediff(a.end_date, a.deadline)) as avg_1
            from
                trn_task_user a left join mst_task_group b on
                a.task_group_id = b.task_group_id
                right join users c on
                a.user_id = c.id
            where
                a.active_flg ='1' and c.email_verified = '1'

        ";
        $sql .= $this->andWhereInt($param, 'task_sts', 'a.task_sts', $sqlParam);
        $sql .= $this->andWhereInt($param, 'year', 'year(a.deadline)', $sqlParam);

        $sql .= "
                group by
                c.id
            ) b on a.id = b.id
        where  a.email_verified = '1' ";
        $sql .= $this->andWhereInt($param, 'assign_id', 'a.id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'acc_user_id', 'a.id', $sqlParam);

        $sql .= "
        order by
        coalesce(b.count,0) desc
        ";

        return DB::select(DB::raw($sql), $sqlParam);

    }

    /**
     * @param $param
     */
    public function selectReportForm2($param)
    {
        $sqlParam = array();
        $sql_s    = "";

        for ($x = 1; $x <= 12; $x++) {
            $sql_s .= "
            , sum(case
                    when month(a.deadline)= " . strval($x) . " then a.task_score
                    else 0
                        end
                ) as T" . strval($x) . "s
            ";
        }

        for ($x = 1; $x <= 12; $x++) {
            $sql_s .= "
            , sum(case
                    when month(a.deadline)= " . strval($x) . " then 1
                    else 0
                        end
                ) as T" . strval($x) . "c
            ";
        }

        $sql = "
            SELECT
                a.user_id
                , b.name
        ";
        $sql .= $sql_s;

        $sql .= "
            FROM
                trn_task_user a
                left join users b on a.user_id = b.id
            where
                a.active_flg ='1' and b.email_verified = '1'
            ";

        $sql .= $this->andWhereInt($param, 'year', 'year(a.deadline)', $sqlParam);
        $sql .= $this->andWhereInt($param, 'assign_id', 'b.id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'acc_user_id', 'b.id', $sqlParam);

        $sql .= "
                group by
                    a.user_id
                    ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectReportForm21($param)
    {
        $sqlParam = array();
        $sql_s    = "";

        for ($x = 1; $x <= 12; $x++) {
            $sql_s .= "
            , sum(case
                    when month(a.deadline)= " . strval($x) . " then a.task_score
                    else 0
                        end
                ) as T" . strval($x) . "s
            ";
        }

        for ($x = 1; $x <= 12; $x++) {
            $sql_s .= "
            , sum(case
                    when month(a.deadline)= " . strval($x) . " then 1
                    else 0
                        end
                ) as T" . strval($x) . "c
            ";
        }

        $sql = "
            SELECT
                a.created_by
                , b.name
        ";
        $sql .= $sql_s;

        $sql .= "
            FROM
                trn_task_user a
                left join users b on a.created_by = b.id
            where
                a.active_flg ='1' and b.email_verified = '1'
            ";

        $sql .= $this->andWhereInt($param, 'year', 'year(a.deadline)', $sqlParam);
        $sql .= $this->andWhereInt($param, 'assign_id', 'b.id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'acc_user_id', 'b.id', $sqlParam);

        $sql .= "
                group by
                    a.created_by
                    ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function download($param)
    {
        $data = $this->selectList($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "CongNo_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('CongNo', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0700-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function updateSts(
        $user,
        $param
    ) {

// $sql      = 'update trn_task_user set task_sts = "' . $param["task_sts"] . '" where task_id = ?';
        // $affected = DB::update($sql, [$param['task_id']]);
        $task = TrnTaskUser::find($param['task_id']);
        $this->updateRecordHeader($task, $user, false);
        $task->task_sts   = $param["task_sts"];
        $task->start_date = Carbon::now();
        DB::transaction(function () use ($task) {
            $task->save();
        });

        return 1;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function updateStsFinish(
        $user,
        $param
    ) {
        $task = TrnTaskUser::find($param['task_id']);
        $this->updateRecordHeader($task, $user, false);
        $task->task_sts = $param["task_sts"];

        if (isset($param["submit_notes"])) {
            $task->submit_notes = $param["submit_notes"];
        }

        $task->end_date = Carbon::now();
        DB::transaction(function () use ($task) {
            $task->save();
        });

        $param1            = $task;
        $param1["content"] = "Task you assigned have been finished - Please check and give your score";
        // $pasram1["task_creator_mail"] = $param["task_creator_mail"];
  
// Mail::send('admin.emails.notify_task', ['param' => $param1], function ($message) {

//     $message->from('khangduy.working@gmail.com',  'PKH Automation');

//     $message->to('duy.le@phankhangco.com')->subject('[PHK-Portal] TASK Notifications - Task finished');

        // });
        Log::info('postUpdate Mail');
        Log::info($param);
        Mail::queue('admin.emails.notify_task', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to([$param["task_creator_mail"]], '[PKH-PORTAL]')->subject('[PHK-Portal] TASK Notifications - Task finished');
        });

        return 1;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function updateStsScore(
        $user,
        $param
    ) {
        $task = TrnTaskUser::find($param['task_id']);
        $this->updateRecordHeader($task, $user, false);
        $task->task_sts = $param["task_sts"];

        if (isset($param["task_score"])) {
            $task->task_score = $param["task_score"];
        }

        if (isset($param["response_notes"])) {
            $task->response_notes = $param["response_notes"];
        }

        $task->end_date = Carbon::now();
        DB::transaction(function () use ($task) {
            $task->save();
        });

        $param1            = $task;
        $param1["content"] = "Your task have been scored by your manager. Please check to see the detail";

// Mail::send('admin.emails.notify_task', ['param' => $param1], function ($message) {

//     $message->from('khangduy.working@gmail.com',  'PKH Automation');

//     $message->to('duy.le@phankhangco.com')->subject('[PHK-Portal] TASK Notifications - Task result');

        // });
        

        Mail::queue('admin.emails.notify_task', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to([$param["email"]], '[PKH-PORTAL]')->subject('[PHK-Portal] TASK Notifications - Task result');
        });

        return 1;
    }

}
