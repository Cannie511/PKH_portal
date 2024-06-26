<?php

namespace App\Services;

use DB;
use Mail;
use Log;
use App\Models\TrnCost;
use Carbon\Carbon;
/**
 * Crm1831Service class
 */
class Crm1831Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectCost($param)
    {
        $result = null;
        $sqlParam = array();
        $sql = "
        SELECT 
        a.cost_id
        , a.cost_cat_id
        , a.department_id
        , a.cost_date
        , a.amount
        , a.contra_account
        , a.voucher
        , a.description
        , a.confirm_time
        , a.cancel_time
        , a.request_notes
        , a.confirm_notes
        , a.cancel_notes
        , b.name as confirm_by
        , a.cost_sts
        , a.created_at
        , c.name as created_by
         FROM trn_cost a 
         left join users b on a.confirm_by = b.id
         left join users c on a.created_by = c.id
         where a.active_flg = '1' 
        ";
        $sql .= $this->andWhereInt($param, 'cost_id', 'a.cost_id', $sqlParam);

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (count($list) == 0) {
            return array();
        }

        return $list[0];
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveCost(
        $user,
        $param
    ) {
        $cost = null;

        if (isset($param['cost_id']) && ($param['cost_id'] > 0)) {
            $cost = TrnCost::find($param['cost_id']);
            $this->updateRecordHeader($cost, $user, false);
            $msg = "cập nhật " . $cost["description"] . " thành Công";
        } else {
            $cost = new TrnCost();
            $this->updateRecordHeader($cost, $user, true);
            $cost->cost_sts = '0';
            $msg = "Lưu thành Công";
        }

        if (null != $cost) {
            $cost->voucher        = $param['voucher'];
            $cost->cost_date      = $param['cost_date'];
            $cost->contra_account = $param['contra_account'];
            $cost->cost_cat_id    = $param['cost_cat_id'];
            $cost->department_id  = $param['department_id'];
            $cost->amount         = $param['amount'];
            $cost->description    = $param['description'];
            $cost->request_notes  = $param['request_notes'];

            DB::transaction(function () use ($cost) {
                $cost->save();
            });
        }

        return $cost->cost_id;
    }

     /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function sendRequest(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        // $today  = date('Y-m-d', strtotime($today1));
        TrnCost::where('cost_id', $param['cost_id'])
                ->update(['cost_sts' => '1'
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);

        $cost = TrnCost::find($param['cost_id']);                
        $param1            = $cost;
        $param1["content"] = "Yêu cầu duyệt chi phí";
        Log::debug('-----check cost param ----------');
        Log::debug($param1);
        Mail::queue('admin.emails.cost_request', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(["it1@phankhangco.com", "md@phankhangco.com"], '[PKH-PORTAL]')->subject('[PHK-chi phí] yêu cầu duyệt chi phí');
        });
        return "Lưu thành Công";
    }

     /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function Cancel(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        // $today  = date('Y-m-d', strtotime($today1));
        TrnCost::where('cost_id', $param['cost_id'])
                ->update(['cost_sts' => '4'
                    , 'cancel_notes' => $param['cancel_notes']
                    , 'cancel_time' => $today1
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        return "Lưu thành Công";
    }


     /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function Accept(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        // $today  = date('Y-m-d', strtotime($today1));
        TrnCost::where('cost_id', $param['cost_id'])
                ->update(['cost_sts' => '2'
                    , 'confirm_notes' => $param['confirm_notes']
                    , 'confirm_time' => $today1
                    , 'confirm_by' => $user->id
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        $cost = TrnCost::find($param['cost_id']);                
        $param1            = $cost;
        $param1["content"] = "Yêu cầu duyệt chi phí đã được duyệt";
        Log::debug('-----check cost param ----------');
        Log::debug($param1);
        Mail::queue('admin.emails.cost_request', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(["acct1@phankhangco.com"], '[PKH-PORTAL]')->subject('[PHK-chi phí] Chi phí đã được duyệt');
        });
        
        return "Lưu thành Công";
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function Deny(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        // $today  = date('Y-m-d', strtotime($today1));
        TrnCost::where('cost_id', $param['cost_id'])
                ->update(['cost_sts' => '3'
                    , 'confirm_notes' => $param['confirm_notes']
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        return "Lưu thành Công";
    }

     /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function accConfirm(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        // $today  = date('Y-m-d', strtotime($today1));
        TrnCost::where('cost_id', $param['cost_id'])
                ->update(['cost_sts' => '5'
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        return "Lưu thành Công";
    }


}
