<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\TrnPayment;

/**
 * Crm0710Service class
 */
class Crm0710Service extends BaseService
{
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
                a.cpayment_id
              
                , a.store_id
                , a.cpayment_date
               
                , a.cpayment_money
               ,  a.total
                , b.name as store_name
                , b.address as store_address
                , c.name as saleman_name
            from
                trn_customer_payment a
                left join mst_store b
                    on a.store_id = b.store_id
                left join users c
                    on c.id = a.salesman_id
            where
                a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'payment_id', 'a.payment_id', $sqlParam);

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
      
                $payment              = new TrnPayment();
              
                $payment->customer_id   = $param['store_id'];
                $this->updateRecordHeader($payment, $user, true);
                $payment->cpayment_money   = $param['payment_money'];
               
                $payment->cpayment_date    = Carbon::now();
                $payment->total = $param['total_with_discount'];
            
                DB::transaction(function () use ($payment) {
                    $payment->save();
                });
            return $payment->store_id;
    }

    /**
     * @param $param
     */
    public function findPayment($cpayment_id)
    {
        $sqlParam = array();
        $sql      = "
            select
               
                a.customer_id
                , a.cpayment_date
             
                , a.cpayment_money
                , a.total
               
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from trn_customer_payment a
            where a.cpayment_id = ?
        ";
        $sqlParam[] = $cpayment_id;
        $result = DB::select(DB::raw($sql), $sqlParam);
        // Log::debug($result);
        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

    }

}
