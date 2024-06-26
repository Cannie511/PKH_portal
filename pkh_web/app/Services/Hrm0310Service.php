<?php

namespace App\Services;

use DB;
use Mail;
use App\Models\TrnTaskUser;

/**
 * Hrm0310Service class
 */
class Hrm0310Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectUsers($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.id,
                a.name
                , a.email
            from users a
            where a.active_flg = 1 and  a.email_verified = 1
        ";
        $sql .= $this->andWhereInt($param, 'user_id', 'a.id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectTask($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.task_id
            ,a.task_group_id
            , a.user_id
            , a.task_name
            , a.task_score
            , a.task_sts
            , a.start_date
            , a.deadline
            , a.end_date
            , a.submit_notes
            , a.task_content
        from
            trn_task_user a
        where
            a.active_flg ='1'
        ";

        $sql .= $this->andWhereInt($param, 'task_id', 'a.task_id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveTask(
        $user,
        $param
    ) {
        $task = null;

        if (isset($param['task_id']) && ($param['task_id'] > 0)) {
            $task = TrnTaskUser::find($param['task_id']);
            $this->updateRecordHeader($task, $user, false);
        } else {
            $task                = new TrnTaskUser();
            $task->task_sts      = '1';
            $task->task_group_id = $param['task_group_id'];
            $task->user_id       = $param['user_id'];
            $task->deadline      = $param['deadline'];
            $this->updateRecordHeader($task, $user, true);
        }

        if (null != $task) {
            // $task->start_date             = Carbon::now();
            $task->task_name    = $param['task_name'];
            $task->task_content = $param['task_content'];
            // chưa gán giá trị cho bank account
            DB::transaction(function () use ($task) {
                $task->save();
            });
            // Send email
            $param1            = $task;
            $param1["content"] = " New task for you was just created";

            $filter            = [];
            $filter["user_id"] = $task->user_id;
            $data              = $this->selectUsers($filter);

            Mail::send('admin.emails.notify_task', ['param' => $param1], function ($m) use ($data) {
                $m->from('no-reply@phankhangco.com', 'PKH Automation');
                $m->to([$data[0]->email], '[PKH-PORTAL]')->subject('[PHK-Portal] TASK Notifications - New task');
            });
        }

        return $task->task_id;
    }

}
