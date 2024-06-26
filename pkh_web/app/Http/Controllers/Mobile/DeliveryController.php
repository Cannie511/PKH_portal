<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\DeliveryService;

/**
 * DeliveryController
 */
class DeliveryController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $deliveryService;
    /**
     * @param DeliveryService $deliveryService
     */
    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->deliveryService->selectList($params);

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
     * @param $delivery_id
     */
    public function show(
        Request $request,
        $delivery_id
    ) {
        $result = $this->deliveryService->getDetail($delivery_id);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $delivery_id
     */
    public function sign(
        Request $request,
        $delivery_id
    ) {
        $params                      = $request->all();
        $params["store_delivery_id"] = $delivery_id;

        $result = $this->deliveryService->sign($params);

        return response()->success($result);
    }

}
