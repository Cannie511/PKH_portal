<?php

namespace App\Services;

use DB;
use Mail;
use Log;
use App\Models\MstWarehouse;
use Carbon\Carbon;
/**
 * Crm1831Service class
 */
class Crm2910Service extends BaseService
{
/**
     * @param $param
     * @return mixed
     */
    public function selectwarehouse($param)
    {
        $result = null;
        $sqlParam = array();
        $sql = "
        select 
            a.warehouse_id
            , a.name
            , a.address 
            , a.active_flg
            , a.created_at 
            , a.created_by
            , a.updated_at
            , b.name  as updated_by
        from 
            mst_warehouse a 
            left join users b on a.updated_by = b.id
        where 
        1=1
        ";
        $sql .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);

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
    public function saveWarehouse(
        $user,
        $param
    ) {
        $warehouse = null;

        if (isset($param['warehouse_id']) && ($param['warehouse_id'] > 0)) {
            $warehouse = MstWarehouse::find($param['warehouse_id']);
            $this->updateRecordHeader($warehouse, $user, false);
            $msg = "cập nhật " .  " thành Công";
        } else {
            $warehouse = new MstWarehouse();
            $this->updateRecordHeader($warehouse, $user, true);
            $msg = "Lưu thành Công";
        }

        if (null != $warehouse) {
            $warehouse->name                = $param['name'];
            $warehouse->address             = $param['address'];
            $warehouse->active_flg          = $param['active_flg'];

            DB::transaction(function () use ($warehouse) {
                $warehouse->save();
            });
        }

        return $warehouse->warehouse_id;
    }
}