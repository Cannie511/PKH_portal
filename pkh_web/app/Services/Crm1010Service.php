<?php

namespace App\Services;

use DB;
use App\Models\TrnDelivery;
use App\Services\GenCodeService;

/**
 * Crm1010Service class
 */
class Crm1010Service extends BaseService
{
    /**
     * @param GenCodeService $genCodeService
     */
    public function __construct(
        GenCodeService $genCodeService
    ) {

        $this->genCodeService = $genCodeService;

    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectVendor($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.id
                , a.delivery_vendor_name
            from
                mst_delivery_vendor a
            where
                a.active_flg = 1
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     */
    public function selectDelivery($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.id
                , a.delivery_date
                , a.delivery_vendor_id
                , a.price
                , a.payment_flg
                , a.notes
                , a.active_flg
            from
                trn_delivery a
            where
                a.active_flg =1
        ";

        $sql .= $this->andWhereInt($param, 'delivery_id', ' a.id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveDelivery(
        $user,
        $param
    ) {

        if (null == $param['delivery_id']) {
            $delivery = new TrnDelivery();
        } else {
            $delivery = TrnDelivery::find($param['delivery_id']);
        }

        $delivery->delivery_date      = $param['delivery_date'];
        $delivery->delivery_vendor_id = $param['delivery_vendor_id'];
        $delivery->price              = $param['price'];
        $delivery->payment_flg        = 1;
        $delivery->notes              = $param['notes'];
        // chưa gán giá trị cho bank account
        $this->updateRecordHeader($delivery, $user, true);

// Log::debug('save payment ---------------------------------');
        // Log::debug($delivery);
        DB::transaction(function () use ($delivery) {
            $delivery->save();
        });

        return $delivery->delivery_vendor_id;
    }

}
