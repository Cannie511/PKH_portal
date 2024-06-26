<?php

namespace App\Services;

use App\Models\TrnStoreOrder;
use App\Models\TrnStoreDelivery;

class Bat0240Service extends BaseService
{
    /**
     * Update product of store delivery
     *
     * @param [type] $params
     * @return void
     */
    public function updateStoreOrderSalesman($params)
    {
        TrnStoreOrder::where('store_order_id', $params["storeOrderId"])->update([
            'salesman_id' => $params["newId"],
        ]);
        TrnStoreDelivery::where('store_order_id', $params["storeOrderId"])->update([
            'salesman_id' => $params["newId"],
        ]);
    }

}
