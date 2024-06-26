<?php

namespace App\Services;

use DB;
use App\Models\TrnStoreOrder;
use App\Services\Bat0210Service;

class Bat0220Service extends BaseService
{
    /**
     * @param Bat0210Service $bat0210Service
     */
    public function __construct(Bat0210Service $bat0210Service)
    {
        $this->bat0210Service = $bat0210Service;
    }

    /**
     * Update product of store delivery
     *
     * @param [type] $params
     * @return void
     */
    public function updateStoreOrderProduct($params)
    {

        // Update price of order
        $order = TrnStoreOrder::find($params['storeOrderId']);

        if (empty($order)) {
            return;
        }

        $this->updateStoreOrderDetail($params);

        // Update store
        $this->updateStoreOrder($params);

        // Update delivery
        $this->updateAllDelivery($params);
    }

    /**
     * @param $params
     * @return null
     */
    private function updateStoreOrderDetail($params)
    {

        if ($params["price"] < 0) {
            return;
        }

        $sqlParam = [];
        $sql      = "
            update trn_store_order_detail
            set ";
        $comma = "";

        if ($params["price"] > 0) {
            $sql .= $comma . " unit_price = ? ";
            $sqlParam[] = $params["price"];
        }

        $sqlParam[] = $params["storeOrderId"];
        $sqlParam[] = $params["productId"];

        $sql .= "
            where
                store_order_id = ?
                and product_id = ?
			 ";

        return DB::update(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $params
     */
    private function updateStoreOrder($params)
    {
        $sqlParam = [$params["storeOrderId"]];
        $sql      = "
            select
              COALESCE(sum(amount * unit_price),0) sum
            from
              trn_store_order_detail
            where
              store_order_id = ?
        ";

        $row = DB::select(DB::raw($sql), $sqlParam)[0];
        $sum = $row->sum;

        $storeOrder = TrnStoreOrder::find($params["storeOrderId"]);

        if ($storeOrder) {
            $storeOrder->total = $sum;

            $totalWithDiscount = $sum * (intval($storeOrder->discount_1) + intval($storeOrder->discount_2)) / 100;
            $totalWithDiscount = floor($totalWithDiscount / 1000) * 1000;
            $totalWithDiscount = $sum - $totalWithDiscount;

            $storeOrder->total_with_discount = $totalWithDiscount;

            $storeOrder->save();
        }

    }

    /**
     * @param $params
     */
    private function updateAllDelivery($params)
    {
        $sqlParam = [$params["storeOrderId"]];
        $sql      = "
            select
              store_delivery_id
            from
              trn_store_delivery
            where
              store_order_id = ?
        ";

        $rows = DB::select(DB::raw($sql), $sqlParam);

        foreach ($rows as $row) {
            $param2 = [
                "storeDeliveryId" => $row->store_delivery_id,
                "productId"       => $params["productId"],
                "price"           => $params["price"],
                "amount"          => -1,
            ];

            $this->bat0210Service->updateStoreDeliveryProduct($param2);
        }

    }

}
