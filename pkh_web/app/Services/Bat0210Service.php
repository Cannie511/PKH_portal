<?php

namespace App\Services;

use DB;
use App\Models\TrnStoreDelivery;

class Bat0210Service extends BaseService
{
    /**
     * Update product of store delivery
     *
     * @param [type] $params
     * @return void
     */
    public function updateStoreDeliveryProduct($params)
    {
        // Update store delivery detail
        $this->updateStoreDeliveryDetail($params);

        // Update store delivery
        $this->updateStoreDelivery($params);

        // Update warehouse change
        $this->updateWarehouseChange($params);

        // Run batch So ngay ton kho
    }

    /**
     * @param $params
     * @return null
     */
    private function updateStoreDeliveryDetail($params)
    {

        if ($params["amount"] < 0 && $params["price"] < 0) {
            return;
        }

        $sqlParam = [];
        $sql      = "
            update trn_store_delivery_detail
            set ";
        $comma = "";

        if ($params["amount"] > 0) {
            $sql .= " amount = ? ";
            $sqlParam[] = $params["amount"];
            $comma      = ",";
        }

        if ($params["price"] > 0) {
            $sql .= $comma . " unit_price = ? ";
            $sqlParam[] = $params["price"];
        }

        $sqlParam[] = $params["storeDeliveryId"];
        $sqlParam[] = $params["productId"];

        $sql .= "
            where
                store_delivery_id = ?
                and product_id = ?
			 ";

        return DB::update(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $params
     */
    private function updateStoreDelivery($params)
    {
        $sqlParam = [$params["storeDeliveryId"]];
        $sql      = "
            select
              COALESCE(sum(amount * unit_price),0) sum
            from
              trn_store_delivery_detail
            where
              store_delivery_id = ?
        ";

        $row = DB::select(DB::raw($sql), $sqlParam)[0];
        $sum = $row->sum;

        $storeDelivery = TrnStoreDelivery::find($params["storeDeliveryId"]);

        if ($storeDelivery) {
            $storeDelivery->total = $sum;

            $totalWithDiscount = $sum * (intval($storeDelivery->discount_1) + intval($storeDelivery->discount_2)) / 100;
            $totalWithDiscount = floor($totalWithDiscount / 1000) * 1000;
            $totalWithDiscount = $sum - $totalWithDiscount;

            $storeDelivery->total_with_discount = $totalWithDiscount;

            $storeDelivery->save();
        }

    }

    /**
     * @param $params
     * @return null
     */
    private function updateWarehouseChange($params)
    {

        if ($params["amount"] < 0) {
            return;
        }

        $sqlParam = [];
        $sql      = "
            update trn_warehouse_change
            set amount = ? ";

        $sqlParam[] = $params["amount"];
        $sqlParam[] = $params["storeDeliveryId"];
        $sqlParam[] = $params["productId"];

        $sql .= "
            where
                store_delivery_id = ?
                and product_id = ?
			 ";

        return DB::update(DB::raw($sql), $sqlParam);
    }

}
