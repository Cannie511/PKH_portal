<?php

namespace App\Services;

use DB;
use App\Models\MstPackaging;

/**
 * Crm1510Service class
 */
class Crm1510Service extends BaseService
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
                a.packaging_id
                , a.name
                , a.length
                , a.width
                , a.height
            from
                mst_packaging a
            where
                a.active_flg = 1
                and a.packaging_id = ?
        ";

        $sqlParam[] = $param['packing_id'];
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

        if (null == $param['packing_id']) {
            $packing = new MstPackaging();
            $this->updateRecordHeader($packing, $user, false);
        } else {
            $packing = MstPackaging::find($param['packing_id']);
            $this->updateRecordHeader($packing, $user, true);
        }

        $packing->length = $param['length'];
        $packing->width  = $param['width'];

        $packing->height = $param['height'];
        $packing->name   = $param['length'] . 'x' . $param['width'] . 'x' . $param['height'];
        //Log::debug($payment);
        DB::transaction(function () use ($packing) {
            $packing->save();
        });

        return $packing->length;
    }

}
