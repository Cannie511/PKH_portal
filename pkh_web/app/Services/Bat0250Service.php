<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\TrnStorePaymentStatus;

class Bat0250Service extends BaseService
{
    /**
     * @param $store_id
     */
    public function selectStoreDelivery($store_id)
    {
        $sqlParam = array();

// $sql      = "

//     select

//         a.store_delivery_id

//         , a.store_order_id

//         , a.store_id

//         , a.delivery_time

//         , a.discount_1

//         , a.discount_2

//         , a.total

//         , a.total_with_discount

//         , a.seq_no

//         , a.delivery_seq_no

//         , a.delivery_sts

//         , a.notes

//         , a.notes_cancel

//         , a.cancel_time

//         , a.salesman_id

//         , a.promotion_id

//         , a.branch_id

//         , a.shipping_id

//         , a.order_type

//         , a.packing_time

//         , a.confirm_time

//         , a.shipping_time

//         , a.receive_time

//         , a.finish_time

//         , a.store_delivery_code

//     from

//         trn_store_delivery a

//     where

//         a.delivery_sts in ('1', '8', '9', '4')

//         and a.order_type = 1

//     order by

//         a.store_id asc

//         , a.delivery_time asc
        //     ";

        $sql = "
            select
                store_id,
                store_delivery_id,
                date(delivery_time) as delivery_time,
                total_with_discount	as amount
            from
                trn_store_delivery
            where
                delivery_time is not null and delivery_sts in ('1','4','8','9') and order_type = '1' and store_id  = ?
            order by
                delivery_time asc
        ";
        $sqlParam[] = $store_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $store_id
     */
    public function selectStorePayment($store_id)
    {
        $sqlParam = array();

// $sql      = "

//     select

//         b.store_id

//         , sum(a.payment_money) as payment

//     from

//         mst_store b left join trn_payment a

//         on b.store_id = a.store_id

//     group by

//         b.store_id

//     order by

//         b.store_id asc
        //     ";
        $sql = "
            select
                store_id,
                payment_date,
                payment_money as amount,
                payment_type
            from
                trn_payment
            where
                store_id = ?
            order by
                payment_date asc
        ";
        $sqlParam[] = $store_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectStore()
    {
        $sqlParam = array();
        $sql      = "
		    select
                b.store_id
            from
                mst_store b
            where
                b.first_order is not null
            order by
                b.store_id asc
			";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $delivery
     * @param $remain
     */

// public function addToStoreDebt(

//     $delivery,

//     $remain

// ) {

//     $entity                    = new TrnStorePaymentStatus();

//     $entity->store_id          = $delivery->store_id;

//     $entity->store_delivery_id = $delivery->store_delivery_id;

//     $entity->delivery_date     = $delivery->delivery_time;

//     $entity->delivery_amount   = $delivery->total_with_discount;

//     $entity->remain_amount     = $remain;

//     DB::transaction(function () use ($entity) {

//         $entity->save();

//     });
    // }

    public function addToStoreDebt(
        $delivery,
        $payment_date,
        $remain,
        $sts
    ) {
        $entity                    = new TrnStorePaymentStatus();
        $entity->store_id          = $delivery->store_id;
        $entity->store_delivery_id = $delivery->store_delivery_id;
        $entity->delivery_date     = $delivery->delivery_time;
        $entity->delivery_amount   = $delivery->amount;
        $entity->payment_date      = $payment_date;
        $entity->remain_amount     = $remain;
        $entity->sts               = $sts;
        DB::transaction(function () use ($entity) {
            $entity->save();
        });
    }

    public function updateStoreDebt()
    {
        // ini_set('max_execution_time', 180);
        DB::table('trn_store_payment_status')->truncate();
        $stores      = $this->selectStore();
        $index_store = 0;
        $len_store   = count($stores);

// $len_store = 10;
        while ($index_store < $len_store) {
            $store_id = $stores[$index_store]->store_id;
            $delivery = $this->selectStoreDelivery($store_id);
            $payment  = $this->selectStorePayment($store_id);

            $this->recordPaymentTimeForAStore($store_id, $delivery, $payment);
            $index_store++;
        }

    }

    /**
     * @param $store_id
     * @param $delivery
     * @param $payment
     */
    private function recordPaymentTimeForAStore(
        $store_id,
        $delivery,
        $payment
    ) {
        $len_del   = count($delivery);
        $len_pay   = count($payment);
        $index_del = -1;
        $index_pay = -1;
        $total_del = 0;
        $total_pay = 0;
        Log::debug('-------- OKE -----------');
        Log::debug($store_id);
        while ($index_del + 1 < $len_del) {
            $index_del++;
            $total_del += $delivery[$index_del]->amount;

            while ($index_pay + 1 < $len_pay && $total_del > $total_pay) {
                $index_pay++;
                $total_pay += $payment[$index_pay]->amount;
            }

// Truong hop phieu xuat hang co gia tri bang 0
            if (0 == $delivery[$index_del]->amount) {
                if (-1 == $index_pay) {
                    $index = 0;
                } else {
                    $index = $index_pay;
                }

                $this->addToStoreDebt($delivery[$index_del], $payment[$index]->payment_date, 0, '1');
                continue;
            }

            if ($total_del <= $total_pay && 0 != $total_pay) {
                $total_pay -= $total_del;
                $total_del = 0;
                $this->addToStoreDebt($delivery[$index_del], $payment[$index_pay]->payment_date, 0, '1');
            } else {
                if ($total_pay > 0) {
                    $total_del -= $total_pay;
                    $total_pay = 0;
                    $this->addToStoreDebt($delivery[$index_del], Carbon::now(), $total_del, '0');
                } else {
                    $this->addToStoreDebt($delivery[$index_del], Carbon::now(), $delivery[$index_del]->amount, '0');
                }

            }

        }

        if (1511 == $store_id) {
            Log::Debug($store_id . '-------- ' . $total_pay . ' --------' . $total_del . '--------' . $index_pay . '------' . $index_del);
        }

    }

// public function updateStoreDebt()

// {

//     $delivery = $this->selectStoreDelivery();

//     $payment  = $this->selectStorePayment();

//     $stores   = $this->selectStore();

//     DB::table('trn_store_payment_status')->truncate();

//     Log::debug('-------check delivery payment------------');

//     Log::debug($delivery[1]->store_id);

//     $index_del     = 0;

//     $index_pay     = 0;

//     $length_del    = count($delivery);

//     $lenght_pay    = count($payment);

//     $total_del     = 0;

//     $total_pay     = 0;

//     $balance       = $payment[0]->payment;

//     $current_store = 0;

//     // while ($index_del < $length_del) {

//     //     if ($delivery[$index_del]->store_id == $payment[$index_pay]->store_id) {

//     //         $balance = $balance - $delivery[$index_del]->total_with_discount;

//     //         if ($balance < 0) {

//     //             $this->addToStoreDebt($delivery, -$balance);

//     //             $balance = 0;

//     //         }

//     //         $index_del++;

//     //     } else {

//     //         $index_pay++;

//     //         $index_del++;

//     //         $balance = $payment[$index_pay]->payment;

//     //     }

//     // }

//     while ($index_del < $length_del && $index_pay<$length_pay){

//     }

    // }

}
