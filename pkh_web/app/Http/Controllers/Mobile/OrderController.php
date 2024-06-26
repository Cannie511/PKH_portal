<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\OrderService;

/**
 * OrderController
 */
class OrderController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->orderService->selectList($params);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function views(Request $request)
    {
        $result = [
            [
                "view_id" => 1,
                "name"    => "view1",
            ],
            [
                "view_id" => 2,
                "name"    => "view2",
            ],
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $order_id
     */
    public function show(
        Request $request,
        $order_id
    ) {
        $result = $this->orderService->getDetail($order_id);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $order_id
     */
    public function deliveries(
        Request $request,
        $order_id
    ) {
        $params             = $request->all();
        $params["order_id"] = $order_id;

        $result = $this->orderService->selectDeliveries($order_id);

        return response()->success($result);
    }
}
