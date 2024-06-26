<?php namespace App\Services\Order;

use DB;
use Log;
use Carbon\Carbon;

//Factory
use App\Models\MstStore;
use App\Models\MstProduct;

//
use App\Models\MstPromotion;
use App\Models\TrnStoreOrder;

//Service
use App\Services\BaseService;
use App\Services\OrderService;
use App\Services\Crm0210Service;

//Model
use App\Services\GenCodeService;
use App\Services\ProductService;
use App\Models\TrnStoreOrderDetail;
use App\Services\Request\RequestFactoryService;
use App\Services\Order\Promotion\PromotionFactoryService;

class CusOrderService extends BaseService
{
    /**
     * @var mixed
     */
    private $promotionFactory;
    /**
     * @var mixed
     */
    private $stateFactory;

    /**
     * @var mixed
     */
    private $state;

// Managing which action can do in current state.
    /**
     * @var mixed
     */
    private $promotion;
    /**
     * @var mixed
     */
    private $request;

    /**
     * @var mixed
     */
    private $isPromotion;
    /**
     * @var mixed
     */
    private $isNew;

    /**
     * @var mixed
     */
    private $orderID;
    /**
     * @var mixed
     */
    private $storeID;

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
    private $genCodeService;
    /**
     * @var mixed
     */
    private $crm0210Service;

    const REQUEST_TYPE = 1;

// Request order service
    /***------ACTION CODE--------------***/
    const CREATE_NEW_ORDER       = 1;
    const SAVE_ORDER             = 2;
    const CANCLE_ORDER           = 3;
    const ORDER_CODE             = 1;
    const CANCLE_REMAINING_ORDER = 4;
    const CREATE_PACKING_ORDER   = 5;
    const GET_ORDER              = 6;
    const GET_INFOR              = 7;

/***
 * INPUT:
 *  + orderId;
 *  + promotionId (if new)
 * OUTPUT:
 ***/
    /**
     * @param $param
     */
    private function init($param)
    {
        $this->orderID = $param["order_id"];
        $this->storeID = $param["store_id"];

        if (0 != $this->orderID) {
            $this->isNew  = false; // atrribute class
            $order        = TrnStoreOrder::find($this->orderID);
            $order_sts    = intval($order->order_sts);
            $promotion_id = null == $order->promotion_id ? 0 : $order->promotion_id; // null?

        } else {
            $this->isNew = true;

// atrribute class
            //is_promotion
            $promotion_id = $param["promotion_id"];
            $order_sts    = 0;
        }

        $promotion_type = 0;

// $this->state     = $this->stateFactory->createStatus($order_sts);
        if (0 != $promotion_id) {
            $promotion_find = MstPromotion::find($promotion_id);
            $promotion_type = $promotion_find->promotion_type;
        }

        $this->promotion = $this->promotionFactory->createPromotion($promotion_type, $promotion_id);

        if (null != $this->promotion) {
            $this->isPromotion = true;
        } else {
            $this->isPromotion = false;
        }

    }

    /**
     * @param RequestFactoryService $requestFactory
     * @param PromotionFactoryService $promotionFactory
     * @param ProductService $productService
     * @param OrderService $orderService
     * @param GenCodeService $genCodeService
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(
        RequestFactoryService $requestFactory
        ,
        PromotionFactoryService $promotionFactory

        ,
        ProductService $productService
        ,
        OrderService $orderService
        ,
        GenCodeService $genCodeService
        ,
        Crm0210Service $crm0210Service
    ) {
        $this->request = $requestFactory->createRequest(SELF::REQUEST_TYPE);

        $this->promotionFactory = $promotionFactory;
        $this->orderService     = $orderService;
        $this->productService   = $productService;
        $this->genCodeService   = $genCodeService;
        $this->crm0210Service   = $crm0210Service;
    }

    /**
     * @param $user
     * @param $order
     * @param $orderDetail
     * @return mixed
     */
    private function getListOrderDetail(
        $user,
        $order,
        $orderDetail
    ) {
        $listOrderDetail = array();
        $detailSeqNo     = 1;
        $total           = 0;
        $msg             = '';
        if ($this->isPromotion) {
            //promotion
            $result = $this->promotion->getListOrderDetailForPromotion($user, $order, $orderDetail);
        } else {

            foreach ($orderDetail as $item) {

                $product = MstProduct::find($item['product_id']);
                // DAm bao gia cu khong thay doi khi he thong chuyen sang bang gia moi
                $tempSellingPrice = $item["unit_price"];
                $amount           = intval($item['amount']);

                if ($amount < 0) {
                    $amount = -$amount;
                }

//$tempOld = $tempSellingPrice;
                //$tempSellingPrice = $this->getPromotionPrice($order['promotion_id'], $item['product_id'], $product->selling_price, intval($item['amount']));
                $total += $tempSellingPrice * intval($amount);
                $orderDetail                 = new TrnStoreOrderDetail();
                $orderDetail->store_order_id = 0;
                $orderDetail->product_id     = $product->product_id;
                $orderDetail->seq_no         = $detailSeqNo++;
                $orderDetail->amount         = $amount;
                $orderDetail->unit_price     = $tempSellingPrice;
                $this->updateRecordHeader($orderDetail, $user, true);
                $listOrderDetail[] = $orderDetail;
            }

            $result = [
                'msg'             => $msg,
                'listOrderDetail' => $listOrderDetail,
                'total'           => $total,
                'error'           => 1,
            ];
        }

        return $result;
    }

### CODE: ACTION_1: 1
    /**
     * @param $param
     * @return mixed
     */
    public function saveOrder($param)
    {
        $this->init($param);
        $entityOrder  = null;
        $isUpdateMode = false;
        $order        = $param["param"]["order"];
        $orderDetail  = $param["param"]["orderDetail"];
        $user         = $param["user"];

        $result = $this->getListOrderDetail($user, $order, $orderDetail);

        $listOrderDetail = $result["listOrderDetail"];
        $total           = $result["total"];
        $msg             = $result["msg"];
        $error           = $result["error"];

// promotions do not contain discount
        if ((isset($order['promotion_id']) && $order['promotion_id'] <= 4) ||
            (isset($order['order_type']) && 1 != $order['order_type'])) {
            $order['discount_1'] = 0;
            $order['discount_2'] = 0;
        }

        //$totalWithDiscount = round($total - ($total * (intval($order['discount_1']) + intval($order['discount_2'])) / 100),0);
        $totalWithDiscount = $total * (intval($order['discount_1']) + intval($order['discount_2'])) / 100;
        $totalWithDiscount = floor($totalWithDiscount / 1000) * 1000;
        $totalWithDiscount = $total - $totalWithDiscount;
        $store             = MstStore::find($order['store_id']);

        if (isset($order['store_order_id']) && $order['store_order_id'] > 0) {
            // Update
            $isUpdateMode = true;

            $entityOrder = TrnStoreOrder::find($order['store_order_id']);
            $this->updateRecordHeader($entityOrder, $user, false);
        } else {
            // Create
            $isUpdateMode = false;
            $paramCode    = [
                "order_type" => $order['order_type'],
            ];
            $entityOrder                   = new TrnStoreOrder();
            $entityOrder->store_order_code = $this->genCodeService->genCode(SELF::ORDER_CODE, $paramCode);
            $entityOrder->store_id         = $order['store_id'];
            $entityOrder->branch_id        = $user->branch_id;
            $entityOrder->order_sts        = 0;
            $entityOrder->order_date       = Carbon::today();
            $entityOrder->promotion_id     = $order['promotion_id'];
            $entityOrder->order_type       = $order['order_type'];

//

// Thiet lap doanh so don hang cho sales

            if (isset($store) && null != $store->salesman_id) {
                $entityOrder->salesman_id = $store->salesman_id;
            }

            $this->updateRecordHeader($entityOrder, $user, true);
        }

        $entityOrder->discount_1          = $order['discount_1'];
        $entityOrder->discount_2          = $order['discount_2'];
        $entityOrder->supplier_id         = $order['supplier_id'];
        $entityOrder->total               = $total;
        $entityOrder->notes               = $order['notes'];
        $entityOrder->total_with_discount = $totalWithDiscount;
        // How much volume per a delivery
        $entityOrder->volume = $order['volume'];
        // How many carton per a delivery
        $entityOrder->carton = $order['carton'];

        if (-1 != $error) {
            DB::transaction(function () use ($entityOrder, $order, $listOrderDetail, $isUpdateMode, $store) {

                if (null == $store->first_order) {
                    $store->first_order = Carbon::today();
                    $store->save();
                }

                $entityOrder->save();

                if (false == $isUpdateMode) {
                    Log::debug('---------------generate code here-------------');
                    //$entityOrder->store_order_code = ah_gen_order_code($order['store_id'], $entityOrder->store_order_id, true);
                    $entityOrder->save();
                }

                TrnStoreOrderDetail::where('store_order_id', $order['store_order_id'])->delete();

                foreach ($listOrderDetail as $detail) {
                    $detail->store_order_id = $entityOrder->store_order_id;
                    $detail->save();
                }

            });
        } else {
            $entityOrder->store_order_id = 0;
        }

        $resultOrder = [
            'orderId' => $entityOrder->store_order_id,
            'msg'     => $msg,
            'error'   => $error,
        ];

        return $resultOrder;
    }

### CODE: ACTION_3: 3
    /**
     * @param $param
     * @return mixed
     */
    public function cancleOrder($param)
    {
        //$this->init();
        $result = $this->request->createRequest(1, $param);

        return $result;
    }

### CODE: ACTION_4: 4
    /**
     * @param $param
     * @return mixed
     */
    public function cancleRemainingOrder($param)
    {
        $result = $this->request->createRequest(3, $param);

        return $result;

    }

    /**
     * @param $param
     * @return mixed
     */
    public function acceptOrderRequest($param)
    {
        $result = $this->request->acceptRequest($param, $this->crm0210Service);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function denyOrderRequest($param)
    {
        $result = $this->request->denyRequest($param);

        return $result;
    }

    ### CODE: ACTION_5: 5
    public function createPackingOrder()
    {
        $this->init();
    }

### CODE: ACTION_6: 6

/***
 * INPUT:
 *   + $storeOrderId: 0:<>0
 *   + $store_id
 * OUTPUT:
 *   + $order
 *   + $orderDetail
 *   + $orderDelivery
 *   + $requestList
 * ***/
    /**
     * @param $param
     * @return mixed
     */
    public function getProductList($param)
    {
        $this->init($param);
        $productList = $this->productService->selectProductListForOrderWithWarehouse($param['param']);

        if ($this->isPromotion) {

            $newProductList      = [];
            $promotionProductIds = $this->promotion->getProductList();

            foreach ($productList as $product) {

                if (in_array($product->product_id, $promotionProductIds)) {
                    $newProductList[] = $product;
                }

            }

            $productList = $newProductList;
        }

        return $productList;
    }

### CODE: ACTION_7: 7

/***
 * INPUT:
 *   + $storeOrderId: 0:<>0
 *   + $store_id
 * OUTPUT:
 *   + $order
 *   + $orderDetail
 *   + $orderDelivery
 *   + $requestList
 * ***/
    /**
     * @param $param
     */
    public function getInfor($param)
    {
        $this->init($param);

/*if (!$this->state->getPermission(SELF::GET_INFOR)){
return;
}*/

        if (!$this->isNew) {
            $order         = $this->orderService->selectOrder($this->orderID);
            $orderDetail   = $this->orderService->selectOrderDetail($this->orderID);
            $orderDelivery = $this->orderService->selectDeliveryListByOrder($this->orderID);
            $requestList   = $this->request->loadRequest($this->orderID);
        } else {
            $order = [
                'discount_1'     => $param['discount'],
                'discount_2'     => 0,
                'notes'          => '',
                'store_id'       => $this->storeID,
                'store_order_id' => 0,
                'order_type'     => 0,
                'version_no'     => 0,
            ];
            $orderDetail   = null;
            $orderDelivery = array();
            $requestList   = null;

        }

        return [
            'order'         => $order,
            'orderDetail'   => $orderDetail,
            'orderDelivery' => $orderDelivery,
            'requestList'   => $requestList,
        ];
    }

}
