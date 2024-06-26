<?php

namespace App\Services;

use DB;
use Log;
use App\Models\MstDeliveryVendor;

/**
 * Crm1110Service class
 */
class Crm1110Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "";

        $result = array();
        //$result =  $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @param $param
     */
    public function selectVendor($param)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.id
                , a.delivery_vendor_name
                , a.contact_name
                , a.contact_email
                , a.contact_tel
                , a.contact_fax
                , a.contact_mobile1
                , a.contact_mobile2
                , a.notes
            from
                mst_delivery_vendor a
            where
                a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'delivery_vendor_id', ' a.id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveDeliveryVendor(
        $user,
        $param
    ) {

        if (null == $param['delivery_vendor_id']) {
            $vendor = new MstDeliveryVendor();
        } else {
            $vendor = MstDeliveryVendor::find($param['delivery_vendor_id']);
        }

        $vendor->delivery_vendor_name = $param['delivery_vendor_name'];
        $vendor->contact_name         = $param['contact_name'];
        $vendor->contact_email        = $param['contact_email'];
        $vendor->contact_tel          = $param['contact_tel'];
        $vendor->contact_mobile1      = $param['contact_mobile1'];
        $vendor->contact_mobile2      = $param['contact_mobile2'];
        $vendor->notes                = $param['notes'];
        // chưa gán giá trị cho bank account
        $this->updateRecordHeader($vendor, $user, true);
        Log::debug('save payment ---------------------------------');
        //Log::debug($payment);
        DB::transaction(function () use ($vendor) {
            $vendor->save();
        });

        return $vendor->contact_name;
    }

}
