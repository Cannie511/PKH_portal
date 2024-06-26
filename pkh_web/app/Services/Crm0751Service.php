<?php

namespace App\Services;

use DB;
use Log;
use Auth;
use Mail;
use Carbon\Carbon;
use App\Models\TrnPaymentAdvance;
use App\Services\ImageService;

/**
 * Crm0751Service class
 */
class Crm0751Service extends BaseService
{
     /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
     
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectBankAccount($param)
    {
        $sqlParam = array();
        $sql      = "
            select
           a.bank_account_id
            , a.store_id
            , a.bank_name
            , a.bank_branch
            , a.bank_account_no
            , a.bank_account_name
            , a.notes
            from mst_bank_account a
            where a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectPayment($param)
    {
        $sqlParam = array();
        $sql      = "
           Select
                a.payment_id
                , a.salesman_id
                , a.store_id as store_order_id
                , b.store_id
                , a.payment_date
                , a.payment_type
                , a.payment_money
                , a.payment_sts
                , a.bank_account_id
                , a.notes
                , b.name as store_name
                , b.address as store_address
                , c.name as salesman_name
                , d.total 
                , d.total_with_discount 
                , d.discount_1
                , d.order_sts
                , d.order_date
                , d.store_order_code
                , f.delivery_time as delivery_date
            from
                trn_payment_advance a
                left join trn_store_order d
                    on a.store_id = d.store_order_id 
                left join trn_store_delivery f
                    on d.store_order_id = f.store_order_id
                left join mst_store b
                    on d.store_id = b.store_id
                left join users c
                    on c.id = d.salesman_id
            where
                a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'payment_id', 'a.payment_id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

     /**
     * @param $param
     */
    public function selectOrderById($param)
    {
        $sqlParam = array();
        $sql      = "
           Select
                  b.name    as name
                , b.address as address
                , c.name    as salesman_name
                , d.total 
                , d.total_with_discount 
                , d.discount_1
                , d.order_sts
                , d.order_date
                , d.store_order_code
                , d.store_order_id
                , d.salesman_id
            from
                trn_store_order d
                left join mst_store b
                    on d.store_id = b.store_id
                left join users c
                    on c.id = d.salesman_id
            where
                d.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'store_order_id', 'd.store_order_id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $created_date
     */
    private function checkValidToChange($created_date)
    {
        $check_date  = $created_date;
        $date        = date('Y-m-d', strtotime($check_date));
        $next7Date   = date('Y-m-d', strtotime('+5 day', strtotime($check_date)));
        $mytime      = Carbon::now();
        $currentDate = date('Y-m-d', strtotime($mytime));

/*Log::debug('check crm 0700-------------');
Log::debug($date);
Log::debug($next7Date);
Log::debug($currentDate);*/
        if ($currentDate <= $next7Date) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function savePayment(
        $user,
        $param
    ) {
        $payment = null;
        if (isset($param['payment_id']) && ($param['payment_id'] > 0)) {
            $payment = TrnPaymentAdvance::find($param['payment_id']);

// //Allowing user to change content of payment within 7 day starting from this created date
//             if (!$this->checkValidToChange($payment->created_at)) {
//                 return $payment->store_id;
//             }

            $this->updateRecordHeader($payment, $user, false);
        } else {
            $payment              = new TrnPaymentAdvance();
            $payment->salesman_id = $param['salesman_id'];
            $payment->store_id    = $param['store_order_id'];
            $this->updateRecordHeader($payment, $user, true);
        }

        if (null != $payment) {
            $payment->payment_money   = $param['payment_money'];
            $payment->payment_type    = '0';
            $payment->payment_date    = $param['payment_date'];
            $payment->bank_account_id = '0';
            $payment->notes           = "Thưởng thanh toán trước ".$param['store_order_code'];
            // chưa gán giá trị cho bank account
            DB::transaction(function () use ($payment) {
                $payment->save();
            });
        }

        return $payment->store_id;
    }

    /**
     * @param $param
     */
    public function findPayment($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.salesman_id
                , a.store_id
                , a.payment_date
                , a.payment_type
                , a.payment_money
                , a.bank_account_id
                , a.notes
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from trn_payment a
            where a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereDateEqual($param, 'payment_date', 'a.payment_date', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

     /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "crm0751";
        $fileName     = $this->imageService->uploadImage($newsId, $base64Img, $locationName);

        return [
            "rtnCd"    => true,
            "fileName" => $fileName,
        ];
    }

      /**
     * @param $param
     */
    public function loadImages($param)
    {
        $locationName = "crm0751";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
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
        TrnPaymentAdvance::where('payment_id', $param['payment_id'])
                ->update(['payment_sts' => '1'
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);

        $payment = TrnPaymentAdvance::find($param['payment_id']);                
        $param1            = $payment;
        $param1["content"] = "Yêu cầu duyệt thưởng thanh toán trước";
        Log::debug('-----check payment param ----------');
        Log::debug($param1);
        Mail::queue('admin.emails.payment_request', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(["it1@phankhangco.com","ia1@phankhangco.com"], '[PKH-PORTAL]')->subject('[PHK-chi phí] yêu cầu duyệt thưởng thanh toán trước');
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
        TrnPaymentAdvance::where('payment_id', $param['payment_id'])
                ->update(['payment_sts' => '5'
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
        TrnPaymentAdvance::where('payment_id', $param['payment_id'])
                ->update(['payment_sts' => '2'
                    , 'confirm_notes' => $param['confirm_notes']
                    , 'confirm_time' => $today1
                    , 'confirm_by' => $user->id
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
        $payment = TrnPaymentAdvance::find($param['payment_id']);                
        $param1            = $payment;
        $param1["content"] = "Yêu cầu duyệt chi phí đã được duyệt";
        Log::debug('-----check payment param ----------');
        Log::debug($param1);
        Mail::queue('admin.emails.payment_request', ['param' => $param1], function ($m) use ($param) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(["acct1@phankhangco.com","it1@phankhangco.com","ia1@phankhangco.com"], '[PKH-PORTAL]')->subject('[PHK-chi phí] Chi phí đã được duyệt');
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
        TrnPaymentAdvance::where('payment_id', $param['payment_id'])
                ->update(['payment_sts' => '3'
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
        TrnPaymentAdvance::where('payment_id', $param['payment_id'])
                ->update(['payment_sts' => '4'
                    , 'updated_at' => $today1
                    , 'updated_by' => $user->id]);
    
        return "Lưu thành Công";
    }




}
