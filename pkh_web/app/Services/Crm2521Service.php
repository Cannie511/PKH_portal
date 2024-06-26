<?php

namespace App\Services;

use DB;
use App\Models\MstSupplier;

/**
 * Crm2521Service class
 */
class Crm2521Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectPacking($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_id
                , a.supplier_code
                , a.name
                , a.contact_name
                , a.contact_email
                , a.contact_tel
                , a.address
            from
                mst_supplier a
            where
                a.active_flg = 1
                and a.supplier_id = ?
        ";

        $sqlParam[] = $param['supplier_id'];
        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function savePacking(
        $user,
        $param
    ) {

        if (null == $param['supplier_id']) {
            $packing = new MstSupplier();
            $this->updateRecordHeader($packing, $user, false);
        } else {
            $packing = MstSupplier::find($param['supplier_id']);
            $this->updateRecordHeader($packing, $user, true);
        }

        $packing->name = $param['name'];
        $packing->supplier_code  = $param['supplier_code'];
        $packing->address = $param['address'];
        $packing->contact_name = $param['contact_name'];
        $packing->contact_email = $param['contact_email'];
        $packing->contact_tel = $param['contact_tel'];
        //Log::debug($payment);
        DB::transaction(function () use ($packing) {
            $packing->save();
        });

        return $packing->name;
    }

}
