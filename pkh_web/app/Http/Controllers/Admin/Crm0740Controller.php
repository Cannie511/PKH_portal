<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\StoreService;
use App\Services\Crm0740Service;
use App\Services\ProductService;

/**
 * Crm0740Controller
 */
class Crm0740Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0740Service;
    /**
     * @var mixed
     */
    protected $productService;

    /**
     * @param OrderService $orderService
     * @param StoreService $storeService
     * @param Crm0740Service $crm0740Service
     * @param ProductService $productService
     */
    public function __construct(
        OrderService $orderService,
        StoreService $storeService,
        Crm0740Service $crm0740Service,
        ProductService $productService
    ) {
        $this->crm0740Service = $crm0740Service;
        $this->productService = $productService;
        $this->orderService   = $orderService;
        $this->storeService   = $storeService;
        //$this->middleware( 'permission:screen.crm0740' );
    }

    /**
     * @param Request $request
     */
    public function postSearchProduct(Request $request)
    {
        // Load product list
        $productList = $this->productService->selectProductListForOrder($request->all());

        $result = [
            'list' => $productList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postCreateOne(Request $request)
    {
        $param       = $request->all();
        $productList = $this->crm0740Service->createAmountForProductList($param);

        $result = [
            'list' => $productList,
        ];

        return response()->success($result);
    }

    public function postLoadInit()
    {
        $storeOrderId    = intVal(Input::get('store_order_id', 0));
        $storeDeliveryId = intVal(Input::get('store_delivery_id', 0));

        $order          = null;
        $delivery       = null;
        $deliveryDetail = null;

        $order = $this->orderService->selectOrder($storeOrderId);

        if ($storeDeliveryId > 0) {
            $delivery       = $this->orderService->selectStoreDelivery($storeDeliveryId);
            $deliveryDetail = $this->orderService->selectStoreDeliveryDetail($storeDeliveryId);

            foreach ($deliveryDetail as $detail) {
                $detail->balance    = 0;
                $detail->unit_price = intVal($detail->accountant_price);
            }

        }

        $store = null;

        if ($order) {
            $storeId = intVal($order->store_id);
            $store   = $this->storeService->selectStoreById($storeId);
        }

        $result = [
            'delivery'    => $delivery,
            'store'       => $store,
            'orderDetail' => $deliveryDetail,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');

        $param  = $request->all();
        $result = $this->crm0740Service->download($param);

        return response()->success($result);
    }

}
