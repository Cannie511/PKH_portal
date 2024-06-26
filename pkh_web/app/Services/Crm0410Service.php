<?php

namespace App\Services;

use DB;
use Log;
use Auth;
use Mail;
use Carbon\Carbon;
use App\Models\MstProduct;
use App\Models\TrnStoreOrder;
use App\Services\ImageService;
use App\Models\MstProductSeries;
use App\Models\TrnStoreDelivery;
use App\Models\TrnWarehouseChange;
use App\Models\TrnOrderEditRequest;
use App\Models\TrnStoreOrderDetail;
use App\Models\TrnStoreDeliveryDetail;

class Crm0410Service extends BaseService
{
    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Finish delivery
     * @param  [type] $param
     *             store_delivery_id: id
     *             notes: result
     * @return [type]
     *             rtnCd: 0: ok 1: NG
     *             msg
     */
    public function finishDelivery($param)
    {
        $delivery = TrnStoreDelivery::find($param["store_delivery_id"]);

        if (isset($delivery)) {

            if ("5" == $delivery->delivery_sts) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Phiếu đã hủy #" . $delivery->store_delivery_id,
                ];
            }

            $delivery->delivery_sts = "4";
            $delivery->save();

            return [
                "rtnCd" => true,
                "msg"   => "Đã hoàn tất phiếu xuất #" . $delivery->store_delivery_id,
            ];
        }

        return [
            "rtnCd" => false,
            "msg"   => "Phiếu xuất không tồn tại.",
        ];
    }

    /**
     * Create store delivery
     * @param  [type] $user           [description]
     * @param  [type] $delivery       [description]
     * @param  [type] $deliveryDetail [description]
     * @return [type]                 [description]
     */
    public function createStoreDelivery(
        $user,
        $delivery,
        $deliveryDetail
    ) {

        $entityDelivery = null;
        $isUpdateMode   = false;

        $total              = 0;
        $listDeliveryDetail = array();
        $listOrderDetail    = array();
        $listWhChange       = array();
        $detailSeqNo        = 1;

        // Get store delivery id
        $store_delivery_id = -1;

        if (isset($delivery['store_delivery_id']) && $delivery['store_delivery_id'] > 0) {
            $store_delivery_id = $delivery['store_delivery_id'];
        }

        $checkOver = $this->checkOverDelivery($delivery["store_order_id"], $store_delivery_id, $deliveryDetail);

        if ("NG" == $checkOver["rtnCd"]) {
            return $checkOver;
        }

        foreach ($deliveryDetail as $item) {
            $productId        = $item['product_id'];
            $storeOrderDetail = TrnStoreOrderDetail::where('store_order_id', $delivery["store_order_id"])
                ->where('product_id', $productId)
                ->first();

            $selling_price = 0;

            if (isset($storeOrderDetail)) {
                $selling_price = $storeOrderDetail->unit_price;
            }

            if (!empty($item['amount'])) {
                // $product = MstProduct::find($item['product_id']);
                $total += $selling_price * intval($item['amount']);

                $orderDetail                    = new TrnStoreDeliveryDetail();
                $orderDetail->store_delivery_id = 0;
                $orderDetail->product_id        = $productId;
                $orderDetail->seq_no            = $detailSeqNo++;
                $orderDetail->amount            = $item['amount'];
                $orderDetail->unit_price        = $selling_price;
                $this->updateRecordHeader($orderDetail, $user, true);
                $listOrderDetail[] = $orderDetail;

                if ($item['amount'] > 0) {

                    $product = MstProduct::find($productId);

                    if (null != $product && 1 == $product->product_type) {
                        $productSeries = MstProductSeries::where('product_id', $productId)->get();

                        if (!empty($productSeries)) {

                            foreach ($productSeries as $serie) {
                                $whChange                        = new TrnWarehouseChange();
                                $whChange->warehouse_change_type = 2;
                                $whChange->product_id            = $serie->product_detail_id;
                                $whChange->amount                = $item['amount'];
                                $this->updateRecordHeader($whChange, $user, true);
                                $listWhChange[] = $whChange;
                            }

                        }

                    } else {
                        $whChange                        = new TrnWarehouseChange();
                        $whChange->warehouse_change_type = 2;
                        $whChange->product_id            = $productId;
                        $whChange->amount                = $item['amount'];
                        $this->updateRecordHeader($whChange, $user, true);
                        $listWhChange[] = $whChange;
                    }

                }

            }

        }

        $orderEntity = TrnStoreOrder::find($delivery['store_order_id']);

        if (isset($delivery['store_delivery_id']) && $delivery['store_delivery_id'] > 0) {
            // Update
            $isUpdateMode   = true;
            $entityDelivery = TrnStoreDelivery::find($delivery['store_delivery_id']);
            $this->updateRecordHeader($entityDelivery, $user, false);
        } else {
            // Create
            $isUpdateMode = false;

            $entityDelivery                 = new TrnStoreDelivery();
            $entityDelivery->store_order_id = $delivery['store_order_id'];
            $entityDelivery->discount_1     = $orderEntity->discount_1;
            $entityDelivery->discount_2     = $orderEntity->discount_2;
            $entityDelivery->store_id       = $orderEntity->store_id;
            $entityDelivery->delivery_sts   = '0';
            $entityDelivery->delivery_date  = Carbon::today();
            $entityDelivery->salesman_id    = $orderEntity->salesman_id;
            $entityDelivery->order_type     = $orderEntity->order_type;
            $this->updateRecordHeader($entityDelivery, $user, true);
        }

        $totalWithDiscount = $total * ($entityDelivery->discount_1 + $entityDelivery->discount_2) / 100;
        $totalWithDiscount = floor($totalWithDiscount / 1000) * 1000;
        $totalWithDiscount = $total - $totalWithDiscount;

        $entityDelivery->total               = $total;
        $entityDelivery->total_with_discount = $totalWithDiscount;
        $entityDelivery->notes               = $delivery['notes'] . '';

        DB::transaction(function () use ($entityDelivery, $delivery, $listOrderDetail, $isUpdateMode, $listWhChange) {
            $entityDelivery->save();

            // Update status of order
            TrnStoreOrder::where('store_order_id', $delivery['store_order_id'])
                ->update([
                    'order_sts'  => '2',
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);

            if (isset($delivery['store_delivery_id'])) {
                // Delete TrnStoreDeliveryDetail
                TrnStoreDeliveryDetail::where('store_delivery_id', $delivery['store_delivery_id'])->delete();
                // Delete trn_warehouse_change
                TrnWarehouseChange::where('store_delivery_id', $delivery['store_delivery_id'])->delete();
            }

// Create detail
            foreach ($listOrderDetail as $detail) {
                $detail->store_delivery_id = $entityDelivery->store_delivery_id;
                $detail->save();
            }

// Create warehouse change
            foreach ($listWhChange as $whChange) {
                $whChange->store_delivery_id = $entityDelivery->store_delivery_id;
                $whChange->changed_date      = $entityDelivery->delivery_date;
                $whChange->save();
            }

        });

        return [
            'rtnCd'           => 'OK',
            'storeDeliveryId' => $entityDelivery->store_delivery_id,
        ];
    }

    /**
     * @param $store_order_id
     * @param $store_delivery_id
     * @param $deliveryDetail
     */
    public function checkOverDelivery(
        $store_order_id,
        $store_delivery_id,
        $deliveryDetail
    ) {
        // Get MaxDelivery
        $listMaxDelivery = $this->selectMaxDelivery($store_order_id, $store_delivery_id);

        Log::debug("listMaxDelivery");
        Log::debug(print_r($listMaxDelivery, true));
        Log::debug(print_r($deliveryDetail, true));

        // Compare with current delivery
        $listNG = [];

        foreach ($deliveryDetail as $delivery) {
            $productId = intval($delivery['product_id']);

            if (!empty($delivery['amount'])) {
                $amount = intval($delivery['amount']);

                if ($amount > 0) {
                    $listMaxDelivery[$productId] = $listMaxDelivery[$productId] - $amount;

                    if ($listMaxDelivery[$productId] < 0) {
                        array_push($listNG, MstProduct::find($productId)->product_code);
                    }

                }

            }

        }

        if (empty($listNG)) {
            return ['rtnCd' => 'OK'];
        }

        $msg = "Vượt số lượng đặt: " . implode(',', $listNG);

        return [
            "rtnCd"  => "NG",
            "rtnMsg" => $msg,
        ];
    }

    /**
     * @param $store_order_id
     * @param $store_delivery_id
     * @return mixed
     */
    private function selectMaxDelivery(
        $store_order_id,
        $store_delivery_id
    ) {
        // Select order amount
        $listProductOrder = TrnStoreOrderDetail::where('store_order_id', $store_order_id)
            ->orderBy('product_id')
            ->get();

        // Get sum order
        $listSumDelivery = $this->selectSumDeliveryOfOrder($store_order_id, $store_delivery_id);

        $listResult = [];

        foreach ($listProductOrder as $order) {
            $listResult[$order->product_id] = $order->amount;
        }

        foreach ($listSumDelivery as $delivery) {
            $listResult[$delivery->product_id] = $listResult[$delivery->product_id] - $delivery->amount;
        }

        return $listResult;
    }

    /**
     * @param $store_order_id
     * @param $store_delivery_id
     */
    private function selectSumDeliveryOfOrder(
        $store_order_id,
        $store_delivery_id
    ) {
        Log::debug('-------------check select sum order-----------');
        Log::debug($store_delivery_id);

        if (null == $store_delivery_id) {
            $store_delivery_id = 0;
        }

        $sqlParam = [$store_order_id, $store_delivery_id];
        $sql      = "
            select
              a.product_id
              , coalesce(sum(a.amount),0) amount
            from
              trn_store_delivery_detail a join trn_store_delivery b
                on a.store_delivery_id = b.store_delivery_id
                and b.delivery_sts in (0, 1, 2, 3, 4,6,7,8,9) join trn_store_order c
                on b.store_order_id = c.store_order_id
                and c.order_sts in (0, 1, 2, 3, 4)
                and c.store_order_id = ?
            where a.store_delivery_id <> ?
            group by
              a.product_id
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $deliveryId
     */
    public function updatePrintedStatus($deliveryId)
    {

        $logonUser = $this->logonUser();
        TrnStoreDelivery::where('store_delivery_id', $deliveryId)
            ->update(
                [
                    'delivery_sts' => '1',
                    'updated_at'   => Carbon::now(),
                    'updated_by'   => $logonUser->id,
                ]
            );
    }

    /**
     * @param $deliveryId
     * @return mixed
     */
    public function getProductSeries($deliveryId)
    {
        $sqlParam = [$deliveryId];
        $sql      = "
            select
              a.product_id
              , d.name serie_name
              , c.product_code
              , c.name product_name
              , c.name_origin
              , c.standard_packing
            from
              mst_product_series a join trn_store_delivery_detail b
                on b.product_id = a.product_id join mst_product c
                on c.product_id = a.product_detail_id join mst_product d
                on d.product_id = a.product_id
            where
              b.store_delivery_id = ?
              and d.product_type = 1
            order by
              a.product_id
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function requestCancel($params)
    {
        return $this->addRequest(2, $params['store_delivery_id'], $params['notes']);
    }

    /**
     * @param $type
     * @param $storeDeliveryId
     * @param $notes
     */
    private function addRequest(
        $type,
        $storeDeliveryId,
        $notes
    ) {
        $logonUser             = $this->logonUser();
        $entity                = new TrnOrderEditRequest();
        $entity->request_type  = $type;
        $entity->request_sts   = '0';
        $entity->ref_id        = $storeDeliveryId;
        $entity->request_notes = $notes;
        $entity->request_date  = Carbon::today();
        $this->updateRecordHeader($entity, $logonUser, true);

        $entity->save();

        $param = [];

// 1: huy don dat hang

// 2: huy phieu xuat hang

// 3: tach don hang va huy phan chua giao
        // 4: huy cong no
        $param['type']      = 'Hủy phiếu xuất';
        $param['notes']     = $notes;
        $param['user']      = $logonUser->name;
        $param['user_mail'] = $logonUser->email;

        $storeDelivery             = TrnStoreDelivery::find($storeDeliveryId);
        $storeOrder                = TrnStoreOrder::find($storeDelivery->store_order_id);
        $param['store_order_code'] = $storeOrder->store_order_code;
        $param['url']              = '/crm0410//' . $storeOrder->store_id . '/' . $storeDeliveryId;

        // Send email
        Mail::queue('admin.emails.request_edit', ['param' => $param], function ($m) use ($logonUser, $param, $storeDeliveryId, $storeOrder) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');
            $m->to(['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com'], '[PKH-PORTAL]')->subject('[PHK-Portal] Y/c xu ly don hang #' . $storeOrder->store_order_code . " - " . $logonUser->name);
        });

        return [
            'rtnCd' => true,
            'msg'   => 'Cập nhật thành công.',
        ];
    }

    /**
     * @param $storeDeliveryId
     */
    public function selectRequestList($storeDeliveryId)
    {
        $sqlParam = [$storeDeliveryId];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
            where
              ref_id = ?
              and request_type in (2)
              and a.active_flg = '1'
        ";

        $sql .= "
            order by a.request_id desc
        ";

        // return $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function accept($params)
    {

        $res = [];
        DB::transaction(function () use ($params, &$res) {
            $entity = TrnOrderEditRequest::find($params["request_id"]);

            if (null == $entity) {
                return [
                    'rtnCd' => false,
                    'msg'   => 'Không tìm thấy yêu cầu',
                ];
            }

            $logonUser = $this->logonUser();

            if (2 == $entity->request_type) {
                // Huy don hang
                $delivery = TrnStoreDelivery::find($entity->ref_id);

                if (isset($delivery)) {

                    $delivery->delivery_sts = "5";
                    $delivery->notes_cancel = $entity->request_notes . '\n' . $params["notes"];
                    $delivery->cancel_time  = Carbon::now();
                    $this->updateRecordHeader($delivery, $logonUser, false);
                    $delivery->save();

                    $entity->response_notes = $params["notes"];
                    $entity->request_sts    = 1;
                    $this->updateRecordHeader($entity, $logonUser, false);

                    $entity->save();

                    TrnWarehouseChange::where('store_delivery_id', $delivery->store_delivery_id)
                        ->delete();

                    $res = [
                        "rtnCd" => true,
                        "msg"   => "Đã hủy đơn hàng #" . $delivery->store_delivery_id,
                    ];
                } else {
                    $res = [
                        "rtnCd" => false,
                        "msg"   => "Đơn đặt hàng không tồn tại.",
                    ];
                }

            }

        });

        return $res;
    }

    /**
     * @param $params
     */
    public function deny($params)
    {
        $entity = TrnOrderEditRequest::find($params["request_id"]);

        if ($entity) {
            $logonUser              = $this->logonUser();
            $entity->response_notes = $params["notes"];
            $entity->request_sts    = 2;
            $this->updateRecordHeader($entity, $logonUser, false);

            $entity->save();

            return [
                'rtnCd' => true,
                'msg'   => 'Cập nhật thành công.',
            ];
        }

    }

    /**
     * @param $storeOrder
     * @param $sumOrder
     * @param $storeDeliveryDetail
     */
    public function updateCompletionPercent(
        $storeOrder,
        $sumOrder,
        $storeDeliveryDetail
    ) {
        $old_percent = $storeOrder->completion_percent; //Get current percentage of order
        $sumDelivery = 0;

        foreach ($storeDeliveryDetail as $item) {
            $sumDelivery += $item->amount;
        }

        $new_percent = (float) ($sumDelivery) / (float) ($sumOrder[0]->sum) + (float) ($old_percent);

        if (1 == $new_percent) {
            TrnStoreOrder::where('store_order_id', $storeOrder->store_order_id)
                ->update(
                    [
                        'completion_percent' => $new_percent,
                        'order_sts'          => '4',
                    ]
                );
        } else {
            TrnStoreOrder::where('store_order_id', $storeOrder->store_order_id)
                ->update(
                    [
                        'completion_percent' => $new_percent,
                    ]
                );
        }

    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "crm0410";
        $fileName     = $this->imageService->uploadImage($newsId, $base64Img, $locationName);

        return [
            "rtnCd"    => true,
            "fileName" => $fileName,
        ];
    }

    /**
     * @param $param
     */
    public function loadImages($param)
    {
        $locationName = "crm0410";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
    }

}
