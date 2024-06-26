<?php namespace App\Services;

use DB;
use Log;
use Mail;
use Carbon\Carbon;
use App\Models\MstStore;
use App\Models\MstProduct;
use App\Models\TrnStoreOrder;
use App\Models\TrnStoreDelivery;
use App\Models\TrnWarehouseChange;
use App\Models\TrnStoreOrderDetail;

/**
 * Order Service
 */
class OrderStatusService extends BaseService
{
    /**
     * Correct ID
     *
     * @param [type] $orderId
     * @return void
     */
    public function getDelivery($inputDeliveryIdStr) {
        // FDEL_011221_0012_NORM
        // Input pattern:
        // 1) 011221_0012_7720
        // 2) 011221-0012-7720
        // 3) 01122100127720

        if (!isset($inputDeliveryIdStr))
            return null;

        $input = $inputDeliveryIdStr;
        $inputDeliveryIdStr = strtoupper($inputDeliveryIdStr);
        $inputDeliveryIdStr = str_replace("-", "",$inputDeliveryIdStr);
        $inputDeliveryIdStr = str_replace(" ", "",$inputDeliveryIdStr);
        $inputDeliveryIdStr = str_replace("_", "",$inputDeliveryIdStr);

        // if (strlen($inputDeliveryIdStr) != 14) {
        if (preg_match("/^\d{14}$/i", $inputDeliveryIdStr) == 0) {
            return [
                "orderId" => $input,
                "error" => "Vui lòng nhập mã đơn hàng hợp lê"
            ];
        }

        // Load & check delivery
        $deliveryId = intval(substr($inputDeliveryIdStr, -4));

        $delivery = $this->loadDelivery($deliveryId);
        if(!isset($delivery)) {
            return [
                "orderId" => $input,
                "error" => "Vui lòng nhập mã đơn hàng hợp lê"
            ];
        }

        // Verify code
        $store_delivery_code = $delivery->store_delivery_code . $deliveryId;
        $store_delivery_code = str_replace("FDEL", "",$store_delivery_code);
        $store_delivery_code = str_replace("NORM", "",$store_delivery_code);
        $store_delivery_code = str_replace("-", "",$store_delivery_code);
        $store_delivery_code = str_replace(" ", "",$store_delivery_code);
        $store_delivery_code = str_replace("_", "",$store_delivery_code);

        if ($inputDeliveryIdStr != $store_delivery_code) {
            return [
                "orderId" => $input,
                "error" => "Vui lòng nhập mã đơn hàng hợp lê"
            ];
        }

        // Load delivery detail
        $detail = $this->loadDeliveryDetail($deliveryId);

        $data = [
            "orderId" => $input,
            "delivery" => $delivery,
            "detail" => $detail,
        ];

        return $data;
    }

    /**
     * Load delivery
     *
     * @param Int $deliveryId
     * @return Object
     */
    private function loadDelivery($deliveryId) {
        $sqlParam = array();
        $sql      = "
            SELECT
                a.store_delivery_id
                , a.store_order_id
                , a.store_id
                , a.supplier_id
                , a.warehouse_id
                , a.delivery_date
                , a.discount_1
                , a.discount_2
                , a.total
                , a.total_with_discount
                , a.volume
                , a.carton
                , a.seq_no
                , a.delivery_seq_no
                , a.delivery_sts
                , a.notes
                , a.notes_cancel
                , a.cancel_time
                , a.salesman_id
                , a.promotion_id
                , a.branch_id
                , a.shipping_id
                , a.order_type
                , a.packing_time
                , a.confirm_time
                , a.delivery_time
                , a.shipping_time
                , a.receive_time
                , a.finish_time
                , a.packing_by
                , a.confirm_by
                , a.delivery_by
                , a.shipping_by
                , a.receive_by
                , a.finish_by
                , a.store_delivery_code
                , b.name
                , b.address 
            FROM
                trn_store_delivery a
            LEFT JOIN mst_store b ON
                b.store_id = a.store_id
            WHERE
                a.store_delivery_id = ?
    	";

        $sqlParam[] = $deliveryId;

        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) == 0)
            return null;
        return $list[0];
    }

    private function loadDeliveryDetail($deliveryId) {
        $sqlParam = array();
        $sql      = "
        SELECT
            a.product_id
            , a.seq_no
            , a.amount
            , a.unit_price
            , b.name product_name
            , b.product_code product_code
            , c.name product_cat_name
        FROM
            trn_store_delivery_detail a
        LEFT JOIN mst_product b ON
            a.product_id = b.product_id
        LEFT JOIN mst_product_cat c ON
            c.product_cat_id = b.product_cat_id
        WHERE
            a.store_delivery_id = ?
    	";

        $sqlParam[] = $deliveryId;

        $list = DB::select(DB::raw($sql), $sqlParam);

        foreach ($list as $item) {
            $code = substr($item->product_code, 0, 6);
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
        }

        return $list;
    }
}
