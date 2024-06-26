<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnEtest;
use App\Models\TrnEtestAssign;
use App\Models\TrnEtestResult;
use App\Models\TrnEtestSentence;

class ETestService extends BaseService
{
    /**
     * Search list etest
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function searchList($param)
    {
        $sqlParam = [];
        $sql      = "
			select
			  a.id
			  , a.title
			  , a.test_min
			  , count(distinct b.user_id) count_assign
			  , count(distinct c.user_id) count_result
			from
			  trn_etest a
			  left join trn_etest_assign b
			    on a.id = b.etest_id
			   left join trn_etest_assign c
			    on a.id = c.etest_id
			    	and c.start_time is not null
			where
			  a.active_flg = '1'
			group by
			  a.id
			  , a.title
			  , a.test_min
			 ";

// $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam );

// $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam );
        // $sql .= $this->andWhereString($param, 'dealer_name', 'd.name', $sqlParam );

        $sql .= "
			order by
			  a.id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * Start test
     * @param  [type] $id      [description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    /**
     * Start etest
     * @param  [type] $param [description]
     *                       id: etest id
     * @return [type]        [description]
     */
    public function start($param)
    {

        $logonUser = $this->logonUser();
        $id        = $param["id"];

        $eTestAssign = TrnEtestAssign::where('etest_id', $id)
            ->where('user_id', $logonUser->id)
            ->whereNull('start_time')
            ->where('active_flg', '1')->first();

        if (!isset($eTestAssign)) {
            return $this->fail();
        }

        TrnEtestAssign::where('etest_id', $id)
            ->where('user_id', $logonUser->id)
            ->update([
                'start_time' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'updated_by' => $logonUser->id,
            ]);

        return $this->ok();
    }

    /**
     * Save etest
     * @param  [type] $param [description]
     *                       id: etest id
     *                       user_id:
     *                       name:
     *                       sentenes: [
     *                           {
     *                               no: 1
     *                               text: ""
     *                           }
     *                       ]
     * @return [type]        [description]
     */
    public function save($param)
    {

        $logonUser = $this->logonUser();
        $id        = $param["id"];

        // Get Assign
        $eTestAssign = TrnEtestAssign::where('etest_id', $id)
            ->where('user_id', $logonUser->id)
            ->whereNotNull('start_time')
            ->where('active_flg', '1')->first();

        if (!isset($eTestAssign)) {
            return $this->fail();
        }

        $eTestAssign->end_time = Carbon::now();

        $groups = $param['items'];
        $seq_no = 1;

        foreach ($param['items'] as $group) {

            foreach ($group['items'] as $sentence) {
                $entity           = new TrnEtestResult();
                $entity->etest_id = $id;
                $entity->user_id  = $logonUser->id;
                $entity->seq_no   = $sentence["seq_no"];

                if (isset($sentence["answer"]) && !empty($sentence["answer"])) {
                    $entity->answer = $sentence["answer"];
                }

                $this->updateRecordHeader($entity, $logonUser, true);
                $entity->save();
            }

        }

// Mail::queue('admin.emails.etest', ['param' => $param, 'user' => $logonUser], function ($m) use ($param, $logonUser){

//           $m->from('no-reply@phankhangco.com', 'PKH Automation');

//           $m->to('chien.phan@phankhangco.com', '')

//               ->bcc('cuong.nguyen@phankhangco.com', '')

//               ->subject('[E-LEARNING] ' . $logonUser->name . ' - ' . date('Y-m-d H:i:s') . ' ' . $param["name"]);
        //       });

        $eTestAssign->save();
        TrnEtestAssign::where('etest_id', $id)
            ->where('user_id', $logonUser->id)
            ->update([
                'end_time'   => $eTestAssign->end_time,
                'updated_at' => Carbon::now(),
                'updated_by' => $logonUser->id,
            ]);

        return $this->ok();
    }

    /**
     * @param $param
     * @return mixed
     */
    public function load($param)
    {

        $logonUser = $this->logonUser();

        $result = [];
        $id     = $param["id"];

        $eTest = TrnEtest::where('id', $id)->where('active_flg', '1')->first();

        if (!isset($eTest)) {
            return $this->fail();
        }

        $result['name'] = $eTest->title;
        $result['time'] = $eTest->test_min;

        // Check Assign
        $today  = Carbon::today();
        $assign = TrnEtestAssign::where('etest_id', $id)
            ->where('user_id', $logonUser->id)
            ->where('from_date', '<=', $today)
            ->where('to_date', '>=', $today)
            ->first();

        if (!isset($assign)) {
            return $this->fail();
        }

        // Get Sentence
        $sentences = TrnEtestSentence::where('etest_id', $id)
            ->orderBy('seq_no', 'ASC')
            ->get();

        if (!isset($sentences) || empty($sentences)) {
            return $this->fail();
        }

        $result['items'] = [];
        $groupName       = null;
        $curGroup        = [];
        $curGroupItems   = [];
        $seq_no          = 1;

        foreach ($sentences as $sentence) {

            if (0 == $sentence->seq_type) {

// Group type

// if( $groupName == null || $groupName != $sentence->question ) {

// Log::debug(print_r($curGroupItems, true));
                if (null != $groupName) {
                    $curGroup["items"] = $curGroupItems;
                    $result['items'][] = $curGroup;
                } else {
                    $groupName = $sentence->question;
                }

                $curGroup      = [];
                $curGroupItems = [];

                $curGroup["name"]  = $sentence->question;
                $curGroup["items"] = $curGroupItems;

                $seq_no = 1;
                // }
            } else {
                // Log::debug(print_r($sentence, true));
                $curGroupItems[] = [
                    'no'     => $seq_no++,
                    'text'   => $sentence->question,
                    'answer' => '',
                    'seq_no' => $sentence->seq_no,
                ];
            }

        }

        $curGroup["items"] = $curGroupItems;
        $result['items'][] = $curGroup;

        return $result;
    }

    /**
     * Get todo etest of user
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function getETestTodo()
    {
        $sqlParam = [];
        $sql      = "
				select
				  a.id
				  , a.title
				  , a.test_min
				from
				  trn_etest a
				where
				  a.id in (
				    select
				      distinct etest_id
				    from
				      trn_etest_assign
				    where
				      user_id = ?
				      and start_time is null
				  )
			 ";

        $logonUser  = $this->logonUser();
        $sqlParam[] = $logonUser->id;

        $sql .= "
			order by
  				a.id desc
        ";

        // return $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
