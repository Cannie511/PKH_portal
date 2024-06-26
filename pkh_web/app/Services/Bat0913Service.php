<?php

namespace App\Services;

use DB;
use App\Models\TrnWarehouseChange;

class Bat0913Service extends BaseService
{
    /**
     * @param $checkedDate
     */
    private function findCheckWarehouseByDate(
        $warehouse_id,
        $checkedDate
    ) {
        $sqlParam = array();
        $sql      = "
        select
            *
        from
            trn_check_warehouse a
        where
            a.check_date = ?
            and a.warehouse_id = ?
        ";

        $sqlParam[] = $checkedDate;
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $checkedDate
     * @return mixed
     */
    public function updateStatusForCheckWarehouse(
        $warehouse_id,
        $checkedDate
    ) {
        $check_warehouse = $this->findCheckWarehouseByDate($warehouse_id, $checkedDate);

        if ($check_warehouse) {
            $check_warehouse_id = $check_warehouse[0]->id;
        } else {
            return;
        }

        if (null == $check_warehouse_id) {
            return;
        }

        $sql      = "update trn_check_warehouse set checking_sts = '0'  where id = ? ";
        $affected = DB::update($sql, [$check_warehouse_id]);

        return $affected;
    }

    /**
     * Update product of store delivery
     *
     * @param [type] $params
     * @return void
     */
    public function deleteChange(
        $warehouse_id,
        $fromDate
    ) {
        TrnWarehouseChange::where('changed_date', $fromDate)
            ->where('warehouse_change_type', 3)
            ->where('warehouse_id', $warehouse_id)->delete();
        TrnWarehouseChange::where('changed_date', $fromDate)
            ->where('warehouse_change_type', 4)
            ->where('warehouse_id', $warehouse_id)->delete();

        $this->updateStatusForCheckWarehouse($warehouse_id, $fromDate);
    }

}
