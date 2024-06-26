<?php namespace App\Services\Delivery;

use DB;
use Carbon\Carbon;
use App\Models\MstArea;
use App\Models\MstStore;

//
use App\Models\MstBranch;
use App\Models\MstProduct;

//Service
use App\Models\MstAreaGroup;
use App\Models\TrnStoreOrder;
use App\Services\BaseService;
use App\Services\OrderService;
use App\Services\StoreService;
use App\Services\StatusService;
use App\Models\TrnStoreDelivery;

//Factory
use App\Services\Crm0410Service;

//Model
use App\Services\Crm1000Service;
use App\Services\GenCodeService;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\FuncConfService;
use App\Models\TrnWarehouseChange;
use App\Models\TrnStoreOrderDetail;
use App\Models\TrnStoreDeliveryDetail;
use App\Services\Request\RequestFactoryService;

class CusDeliveryService extends BaseService
{
    /**
     * @var mixed
     */
    private $storeOrderId;
    /**
     * @var mixed
     */
    private $storeDeliveryId;
    /**
     * @var mixed
     */
    private $isUpdateMode;
    /**
     * @var mixed
     */
    private $status;
    /**
     * @var mixed
     */
    private $statusFactory;

    /**
     * @var mixed
     */
    protected $downloadService;

    /**
     * @var mixed
     */
    private $request;
    /**
     * @var mixed
     */
    private $orderService;
    /**
     * @var mixed
     */
    private $productService;
    /**
     * @var mixed
     */
    private $storeService;
    /**
     * @var mixed
     */
    private $statusService;
    /**
     * @var mixed
     */
    private $genCodeService;

    /**
     * @var mixed
     */
    private $crm0410Service;

    /**
     * @var mixed
     */
    private $crm1000Service;

    const WAREHOUSE_CHANGE_TYPE = 2;
    const DELIVERY_CODE         = 2;
    const REQUEST_TYPE          = 2;
    const DELIVERY_STATUS_TYPE  = 2;

    /**
     * @param RequestFactoryService $requestFactory
     * @param ProductService $productService
     * @param OrderService $orderService
     * @param DownloadService $downloadService
     * @param StoreService $storeService
     * @param StatusService $statusService
     * @param Crm0410Service $crm0410Service
     * @param GenCodeService $genCodeService
     * @param Crm1000Service $crm1000Service
     */
    public function __construct(
        RequestFactoryService $requestFactory
        ,
        ProductService $productService
        ,
        OrderService $orderService
        ,
        DownloadService $downloadService
        ,
        StoreService $storeService
        ,
        StatusService $statusService
        ,
        Crm0410Service $crm0410Service

        ,
        GenCodeService $genCodeService
        ,
        Crm1000Service $crm1000Service,
        FuncConfService $funcConfService
    ) {
        $this->request = $requestFactory->createRequest(SELF::REQUEST_TYPE);
        //$this->stateFactory     = $stateFactory;
        $this->orderService   = $orderService;
        $this->storeService   = $storeService;
        $this->productService = $productService;
        $this->statusService  = $statusService;
        $this->crm0410Service = $crm0410Service;

        $this->downloadService = $downloadService;
        $this->genCodeService  = $genCodeService;
        $this->crm1000Service  = $crm1000Service;
        $this->funcConfService = $funcConfService;
    }

    /**
     * @param $productId
     * @param $storeOrderDetail
     * @return int
     */
    private function getSellingPriceFromOrder(
        $productId,
        $storeOrderDetail
    ) {

        foreach ($storeOrderDetail as $item) {

            if ($productId == $item["product_id"]) {
                return $item["unit_price"];
            }

        }

        return 0;
    }

    /**
     * @param $deliveryDetail
     * @param $user
     */
    private function createListDeliveryToSave(
        $deliveryDetail,
        $user,
        $storeOrderId
    ) {
        $total           = 0;
        $detailSeqNo     = 1;
        $listOrderDetail = array();

        $storeOrderDetail = TrnStoreOrderDetail::where('store_order_id', $storeOrderId)->get();

        foreach ($deliveryDetail as $item) {
            $productId = $item['product_id'];

            $selling_price = $this->getSellingPriceFromOrder($productId, $storeOrderDetail);

            if (!empty($item['amount']) && ($item['amount'] > 0)) {
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
            }

        }

        return
            [
            "listOrderDetail" => $listOrderDetail,
            "total"           => $total,
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
        $param
    ) {

        $delivery       = $param["order"];
        $warehouse_id   = $delivery['warehouse_id'];
        $deliveryDetail = $param["orderDetail"];
        // $this->init($delivery);
        $storeOrderId    = $delivery["store_order_id"];
        $storeDeliveryId = $delivery["store_delivery_id"];

        $entityDelivery = null;
        $isUpdateMode   = false;

        // Get store delivery id
        $store_delivery_id = -1;

        if (isset($delivery['store_delivery_id']) && $delivery['store_delivery_id'] > 0) {
            $store_delivery_id = $delivery['store_delivery_id'];
        }

        // Kiem tra so luong xuat co vuot qua so luong dc xuat con lai ko
        $checkOver = $this->crm0410Service->checkOverDelivery($storeOrderId, $storeDeliveryId, $deliveryDetail);

        if ("NG" == $checkOver["rtnCd"]) {
            return $checkOver;
        }

        // TODO: kiem tra vuot qua ton kho
        $checkOverWareHouse = $this->checkOverWareHouse($storeDeliveryId, $deliveryDetail);

        if ("NG" == $checkOverWareHouse["rtnCd"]) {
            return $checkOverWareHouse;
        }

        $resOrderDetail  = $this->createListDeliveryToSave($deliveryDetail, $user, $storeOrderId);
        $listOrderDetail = $resOrderDetail["listOrderDetail"];
        $total           = $resOrderDetail["total"];

        if (0 == $total) {
            return [
                'rtnCd'           => false,
                'rtnMsg'          => 'Không thể lưu vì không có sản phẩm',
                'storeDeliveryId' => 0,
            ];
        }

        $orderEntity = TrnStoreOrder::find($delivery['store_order_id']);

        if (isset($delivery['store_delivery_id']) && $delivery['store_delivery_id'] > 0) {
            // Update
            $isUpdateMode   = true;
            $entityDelivery = TrnStoreDelivery::find($delivery['store_delivery_id']);
            $this->updateRecordHeader($entityDelivery, $user, false);
        } else {
            $store = MstStore::find($delivery['store_id']);
            // Create
            $isUpdateMode = false;

            $entityDelivery                 = new TrnStoreDelivery();
            $entityDelivery->store_order_id = $delivery['store_order_id'];
            $entityDelivery->discount_1     = $orderEntity->discount_1;
            $entityDelivery->discount_2     = $orderEntity->discount_2;
            $entityDelivery->store_id       = $orderEntity->store_id;
            $entityDelivery->supplier_id    = $orderEntity->supplier_id;
            $entityDelivery->branch_id      = $user->branch_id;
            $entityDelivery->delivery_sts   = '0';
            $entityDelivery->delivery_date  = Carbon::today();
            $entityDelivery->salesman_id    = $store->salesman_id;
            $entityDelivery->order_type     = $orderEntity->order_type;
            $paramIn                        = [
                "order_type" => $orderEntity->order_type,
            ];
            $entityDelivery->store_delivery_code = $this->genCodeService->genCode(SELF::DELIVERY_CODE, $paramIn);
            $this->updateRecordHeader($entityDelivery, $user, true);
        }

        // $totalWithDiscount = round($total - ($total *  ($entityDelivery->discount_1 + $entityDelivery->discount_2) / 100 ));
        $totalWithDiscount                   = $total * ($entityDelivery->discount_1 + $entityDelivery->discount_2) / 100;
        $totalWithDiscount                   = floor($totalWithDiscount / 1000) * 1000;
        $totalWithDiscount                   = $total - $totalWithDiscount;
        $entityDelivery->warehouse_id        = $warehouse_id;
        $entityDelivery->total               = $total;
        $entityDelivery->total_with_discount = $totalWithDiscount;
        $entityDelivery->notes               = $delivery['notes'] . '';
        // How much volume per a delivery
        $entityDelivery->volume = $delivery['volume'];
        // How many carton per a delivery
        $entityDelivery->carton = $delivery['carton'];

        DB::transaction(function () use ($user, $entityDelivery, $delivery, $listOrderDetail, $isUpdateMode) {
            $entityDelivery->save();

            if (!$isUpdateMode) {
                // Update status of order
                TrnStoreOrder::where('store_order_id', $delivery['store_order_id'])
                    ->update([
                        'order_sts'  => '2',
                        'updated_by' => $user->id,
                        'updated_at' => Carbon::now(),
                    ]);
            }

            if (isset($delivery['store_delivery_id'])) {
                // Delete TrnStoreDeliveryDetail
                TrnStoreDeliveryDetail::where('store_delivery_id', $delivery['store_delivery_id'])->delete();
            }

// Create detail
            foreach ($listOrderDetail as $detail) {
                $detail->store_delivery_id = $entityDelivery->store_delivery_id;
                $detail->save();
            }

        });

        if ('6' == $entityDelivery->delivery_sts) {
            $this->updateStatusConfirm($user, $entityDelivery->store_delivery_id);
        }

        return [
            'rtnCd'           => true,
            'storeDeliveryId' => $entityDelivery->store_delivery_id,
        ];
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function printPacking(
        $user,
        $param
    ) {
        $result          = [];
        $storeDeliveryId = $param['store_delivery_id'];

        $deliveries = [];

        $delivery     = $this->orderService->selectStoreDelivery($storeDeliveryId);
        $branchEntity = MstBranch::find($delivery->branch_id);

        $deliveryDetail = $this->orderService->selectStoreDeliveryDetail($storeDeliveryId);
        $store          = $this->storeService->selectStoreById($delivery->store_id);

        $delivery->details = $deliveryDetail;
        $delivery->store   = $store;

        $deliveries[] = $delivery;

        $user = $this->logonUser();
        $data = [
            'orders'   => $deliveries,
            'username' => $user->name,
            'branch'   => $branchEntity,
        ];

        if (count($deliveries) == 1) {
            //$pdfName = $orders[0]->store_order_code;
            $pdfName = "ORDER";
        } else {
            $pdfName = "ORDER";
        }

        $paramDownload = [
            "user"        => $user,
            "descript"    => "PRINT_PACKING",
            "data"        => $data,
            "file_name"   => $pdfName,
            "folder_name" => "check_order",
            "view"        => "crm0210-check",
            "type"        => 1,
            "paper"       => 'a4',
        ];
        $result = $this->downloadService->downloadPDFFile($paramDownload);

        $this->updateStatusPacking($user, $storeDeliveryId);

        return $result;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function printDelivery(
        $user,
        $param
    ) {
        $storeDeliveryId     = $param['store_delivery_id'];
        $storeDelivery       = $this->orderService->selectStoreDelivery($storeDeliveryId);
        $storeDeliveryDetail = $this->orderService->selectStoreDeliveryDetail($storeDeliveryId);

        $storeOrder = $this->orderService->selectOrder($storeDelivery->store_order_id);

        $store        = $this->storeService->selectStoreById($storeOrder->store_id);
        $payment_date = null;

// get payment date
        if (isset($store->area1) && null != $store->area1) {
            $area = MstArea::where('area_id', $store->area1)->first();
            if (isset($area) && isset($area->area_group_id) && null != $area->area_group_id) {
                $areaGroup = MstAreaGroup::where('area_group_id', $area->area_group_id)->first();

                if (isset($areaGroup)) {
                    $temp         = new Carbon($storeDelivery->delivery_date);
                    $temp         = $temp->addDay($areaGroup->payment_day);
                    $payment_date = $temp->format('Y-m-d');
                }

            }

        }

        // Get product series
        $productSeries = $this->crm0410Service->getProductSeries($storeDeliveryId);
        $branchEntity  = MstBranch::find($storeDelivery->branch_id);

        $data = [
            'storeDelivery'       => $storeDelivery,
            'storeDeliveryDetail' => $storeDeliveryDetail,
            'storeOrder'          => $storeOrder,
            'store'               => $store,
            'payment_date'        => $payment_date,
            'productSeries'       => $productSeries,
            'branch'              => $branchEntity,
        ];

        $paper     = 'a4';
        $pdfView   = "crm0410-export-a4";
        $isPrintA5 = false;

        if ($isPrintA5) {
            $paper   = 'a5';
            $pdfView = "crm0410-export-a5";
        }

        $paramDownload = [
            "data"        => $data,
            "file_name"   => $storeOrder->store_order_code,
            "folder_name" => "store_delivery",
            "view"        => $pdfView,
            "type"        => 1,
            "paper"       => $paper,
        ];
        $result = [];
        $result = $this->downloadService->downloadPDFFile($paramDownload);

//chỉ cập nhật khi trạng thái hiện tại là xác nhận
        if ('7' == $storeDelivery->delivery_sts) {
            $this->updateWarehouseChange($user, $storeDeliveryDetail, $storeDelivery);
            $this->updateStatusDelivery($user, $storeDeliveryId);
            $this->updateCompletionPercent($storeDelivery->store_order_id);
        }

        return [
            'result'         => $result,
            'store_order_id' => $storeDelivery->store_order_id,
        ];
    }

    /**
     * @param $storeOrderId
     * @return int
     */
    public function updateCompletionPercent($storeOrderId)
    {
        $orderDetail          = $this->orderService->selectOrderDetail($storeOrderId);
        $deliveryExportDetail = $this->orderService->selectDeliveryExportDetail($storeOrderId);
        $export               = 0;
        $total                = 0;
        foreach ($deliveryExportDetail as $item) {
            $export += $item->amount;
        }

        foreach ($orderDetail as $item) {
            $total += $item->amount;
        }

        $new_percent = (float) ($export) / (float) ($total);
        if (1 == $new_percent) {
            TrnStoreOrder::where('store_order_id', $storeOrderId)
                ->update(
                    [
                        'completion_percent' => $new_percent,
                        'order_sts'          => '4',
                    ]
                );
        } else {
            TrnStoreOrder::where('store_order_id', $storeOrderId)
                ->update(
                    [
                        'completion_percent' => $new_percent,
                    ]
                );
        }

        return 0;

    }

    /**
     * @param $user
     * @param $storeDeliveryDetail
     * @param $storeDelivery
     * @return int
     */
    private function updateWarehouseChange(
        $user,
        $storeDeliveryDetail,
        $storeDelivery
    ) {
        $listWhChange = array();
        foreach ($storeDeliveryDetail as $detail) {
            $productId                       = $detail->product_id;
            $product                         = MstProduct::find($productId);
            $whChange                        = new TrnWarehouseChange();
            $whChange->branch_id             = $storeDelivery->branch_id;
            $whChange->warehouse_id          = $storeDelivery->warehouse_id;
            $whChange->warehouse_change_type = SELF::WAREHOUSE_CHANGE_TYPE;
            $whChange->product_id            = $productId;
            $whChange->amount                = $detail->amount;
            $whChange->store_delivery_id     = $detail->store_delivery_id;
            $whChange->changed_date          = Carbon::now();
            $this->updateRecordHeader($whChange, $user, true);
            $listWhChange[] = $whChange;
        }

        DB::transaction(function () use ($listWhChange) {

// Create detail
            foreach ($listWhChange as $detail) {

                $detail->save();
            }

        });

        return 0;
    }

    /**
     * @param $user
     * @param $param
     */
    public function confirmShipping(
        $user,
        $param
    ) {

        $this->updateStatusShipping($user, $param);

        return [
            'rtnCd'           => true,
            'storeDeliveryId' => $param["store_delivery_id"],
        ];

    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    public function confirmReceive(
        $user,
        $storeDeliveryId
    ) {
        $this->updateStatusReceive($user, $storeDeliveryId);

        return [
            'rtnCd'           => true,
            'storeDeliveryId' => $storeDeliveryId,
        ];

    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    public function confirmFinish(
        $user,
        $storeDeliveryId
    ) {
        $this->updateStatusFinish($user, $storeDeliveryId);

        return [
            'rtnCd'           => true,
            'storeDeliveryId' => $storeDeliveryId,
        ];

    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    private function updateStatusFinish(
        $user,
        $storeDeliveryId
    ) {
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts' => '4',
                'finish_time'  => Carbon::now(),
                'finish_by'    => $user->id,
                'updated_by'   => $user->id,
                'updated_at'   => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    private function updateStatusReceive(
        $user,
        $storeDeliveryId
    ) {
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts' => '9',
                'receive_time' => Carbon::now(),
                'receive_by'   => $user->id,
                'updated_by'   => $user->id,
                'updated_at'   => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $param
     */
    private function updateStatusShipping(
        $user,
        $param
    ) {
        $storeDeliveryId = $param["store_delivery_id"];
        $shippingId      = $param["shipping_id"];
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts'  => '8',
                'shipping_time' => Carbon::now(),
                'shipping_id'   => $shippingId,
                'shipping_by'   => $user->id,
                'updated_by'    => $user->id,
                'updated_at'    => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    private function updateStatusDelivery(
        $user,
        $storeDeliveryId
    ) {
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts'  => '1',
                'delivery_time' => Carbon::now(),
                'delivery_by'   => $user->id,
                'updated_by'    => $user->id,
                'updated_at'    => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    private function updateStatusConfirm(
        $user,
        $storeDeliveryId
    ) {
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts' => '7',
                'confirm_time' => Carbon::now(),
                'confirm_by'   => $user->id,
                'updated_by'   => $user->id,
                'updated_at'   => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $storeDeliveryId
     */
    private function updateStatusPacking(
        $user,
        $storeDeliveryId
    ) {
        TrnStoreDelivery::where('store_delivery_id', $storeDeliveryId)
            ->update([
                'delivery_sts' => '6',
                'packing_time' => Carbon::now(),
                'packing_by'   => $user->id,
                'updated_by'   => $user->id,
                'updated_at'   => Carbon::now(),
            ]);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function loadInit(
        $user,
        $param
    ) {

        $storeOrderId = $param['store_order_id'];
        if (!isset($param['store_delivery_id'])) {
            $storeDeliveryId = 0;
        } else {
            $storeDeliveryId = $param['store_delivery_id'];
        }

        $amountDetail = [];
        $shippingList = null;
        $order        = null;
        $orderDetail  = null;
        $store        = null;

        $order       = $this->orderService->selectOrder($storeOrderId);
        $orderDetail = $this->orderService->selectOrderDetail($storeOrderId);

        $deliveryExportDetail = $this->orderService->selectDeliveryExportDetail2($storeOrderId);
        $delivery             = null;
        $deliveryDetail       = null;

        foreach ($orderDetail as $oDetail) {
            foreach ($deliveryExportDetail as $eDetail) {
                if ($eDetail->product_id == $oDetail->product_id) {
                    $oDetail->amount = $oDetail->amount - $eDetail->amount;
                    break;
                }

            }

        }

        foreach ($orderDetail as $detail) {
            $detail->amountExport = $detail->amount;
        }

        if ($storeDeliveryId > 0) {
            $delivery       = $this->orderService->selectStoreDelivery($storeDeliveryId);
            $deliveryDetail = $this->orderService->selectStoreDeliveryDetail($storeDeliveryId);
            if (isset($deliveryDetail)) {
                foreach ($orderDetail as $oDetail) {
                    $amountExport = 0;
                    $unit_price   = $oDetail->unit_price;
                    $volume       = 0;

                    foreach ($deliveryDetail as $dDetail) {
                        if ($oDetail->product_id == $dDetail->product_id) {
                            $amountExport = $dDetail->amount;
                            $unit_price   = $dDetail->unit_price;
                            $volume       = $dDetail->volume;
                            break;
                        }

                    }

                    //$oDetail->amount        =  $oDetail->amount  + $amountExport;
                    $oDetail->amountExport = $amountExport;
                    $oDetail->unit_price   = $unit_price;
                    $oDetail->volume       = $volume;

                    if (0 != $oDetail->amountExport) {
                        $amountDetail[] = $oDetail;
                    }

                }

            }

            $order->store_delivery_code = $delivery->store_delivery_code;

            if ('1' == $delivery->delivery_sts) {
                $shippingList = $this->crm1000Service->selectShippingListToday();
            }

        } else {

// Remaining order detail = Total order detail - Total delivery detail
            foreach ($orderDetail as $oDetail) {
                if (0 != $oDetail->amount) {
                    $amountDetail[] = $oDetail;
                }

            }

        }

        $order->notesOrder = $order->notes;
        $storeId           = intVal($order->store_id);
        $store             = $this->storeService->selectStoreById($storeId);
        $storeSign         = $this->storeService->selectStoreSign($storeId);

        if (isset($delivery)) {

            $order->discount_1        = $delivery->discount_1;
            $order->discount_2        = $delivery->discount_2;
            $order->notes             = $delivery->notes;
            $order->notes_cancel      = $delivery->notes_cancel;
            $order->store_delivery_id = $delivery->store_delivery_id;
            $order->delivery_date     = $delivery->delivery_date;
            $order->delivery_sts      = $delivery->delivery_sts;
            $order->branch_name       = $delivery->branch_name;
            $order->warehouse_id      = $delivery->warehouse_id;
        }

        $requestList = null;
        if ($storeDeliveryId > 0) {
            $requestList = $this->crm0410Service->selectRequestList($storeDeliveryId);
        }

        $statusList = $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE);

        // Load Sign
        $listSign = null;

        if (isset($delivery)) {
            $listSign = $this->loadSignByDeliveryId($storeDeliveryId);
        }

        $result = [
            'store'         => $store,
            'order'         => $order,
            'delivery'      => $delivery,
            'orderDetail'   => $amountDetail,
            'requestList'   => $requestList,
            'statusList'    => $statusList,
            'shippingList'  => $shippingList,
            'signList'      => $listSign,
            'storeSignList' => $storeSign,
        ];

        return $result;
    }

    /**
     * @param $storeDeliveryId
     * @return mixed
     */
    public function loadSignByDeliveryId($storeDeliveryId)
    {
        $sqlParam = array();
        $sql      = "
			select
                a.store_delivery_sign_id,
                a.store_delivery_id,
                a.img_path,
                a.description
			from
                trn_store_delivery_sign a
			where
			  a.store_delivery_id = ?
			  and a.active_flg = '1'
        ";

        $sqlParam[] = $storeDeliveryId;

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

    /**
     * @param $storeDeliveryId
     * @param $deliveryDetail
     */
    public function checkOverWareHouse(
        $storeDeliveryId,
        $deliveryDetail
    ) {

        // Check setting
        $deliveryAllowEmpty = $this->funcConfService->selectByKey(FuncConfService::DELIVERY_ALLOW_EMPTY);

        if ('1' == $deliveryAllowEmpty) {
            return [
                "rtnCd" => 'OK',
            ];
        }

        $listProductId = array_column($deliveryDetail, 'product_id');

        if (count($listProductId) == 0) {
            return [
                "rtnCd" => 'OK',
            ];
        }

        $idString = implode(',', $listProductId);

        $sql = "
        select
          a.product_id
          , a.product_code
          , a.amount
        from
          v_warehouse a
        where
          product_id in ($idString)
        ";

        $listWarehouse = DB::select(DB::raw($sql));

        $rtnCd = 'OK';

        $listNGProduct = [];

        foreach ($listWarehouse as $item) {

            foreach ($deliveryDetail as $detail) {

                if ($item->product_id == $detail["product_id"]) {

                    if ($item->amount < intval($detail['amount'])) {
                        $rtnCd           = 'NG';
                        $listNGProduct[] = substr($item->product_code, 0, 6);
                    }

                }

            }

        }

        if ('OK' == $rtnCd) {
            return [
                "rtnCd" => 'OK',
            ];
        }

        $rtnMsg = 'Hàng không còn đủ trong kho (' . implode(',', $listNGProduct) . ")";

        return [
            "rtnCd"  => $rtnCd,
            "rtnMsg" => $rtnMsg,
        ];
    }

}
