<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Log;
use Auth;
use Input;
use Illuminate\Http\Request;
use App\Models\TrnStoreOrder;
use App\Services\Crm0210Service;
use App\Services\Crm0410Service;
use App\Services\Crm0400Service;
use App\Services\WarehouseService;
use App\Services\Delivery\CusDeliveryService;

/**
 * Crm0110Controller
 * Danh muc san pham danh cho nhan vien ban hang
 */
class Crm0410Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0410Service;
    /**
     * @var mixed
     */
    protected $cusDeliveryService;
    /**
     * @var mixed
     */
    protected $warehouseService;
    /**
     * @var mixed
     */
    private $crm0210Service;
    /**
     * @param Crm0410Service $crm0410Service
     * @param CusDeliveryService $cusDeliveryService
     */
    public function __construct(
        Crm0410Service $crm0410Service
        ,
        Crm0400Service $crm0400Service
        ,
        CusDeliveryService $cusDeliveryService
        ,
        WarehouseService $warehouseService
        ,
        Crm0210Service $crm0210Service
    ) {
        $this->crm0410Service     = $crm0410Service;
        $this->crm0400Service     = $crm0400Service;
        $this->cusDeliveryService = $cusDeliveryService;
        $this->warehouseService   = $warehouseService;
        $this->crm0210Service     = $crm0210Service;

        //$this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        // Save delivery
        $result                  = $this->cusDeliveryService->loadInit($user, $param);
        $warehouseList           = $this->warehouseService->selectWarehouseList();
        $result['warehouseList'] = $warehouseList;

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        // Save delivery
        $result = $this->cusDeliveryService->createStoreDelivery($user, $param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postPrintPacking(Request $request)
    {
        $paramIn = $request->all();
        $user    = Auth::user();

        $result = $this->cusDeliveryService->printPacking($user, $paramIn);

        return response()->success($result);
    }

/*
[Input]:
+ store_delivery_ids: int
[output]:
+ pdffile
[Action]:
+ Only update percent completion of order if delivery status is new.
+ Change delivery status to dang giao.
+ Create pdf file.
 */
    /**
     * @param Request $request
     */
    public function postPrint(Request $request)
    {
        $paramIn = $request->all();
        $user    = Auth::user();

        $res = $this->cusDeliveryService->printDelivery($user, $paramIn);

        $result         = $res['result'];
        $store_order_id = $res['store_order_id'];
// get store order id

        // get order accordding to id
        $order = TrnStoreOrder::find($store_order_id);
        // Split remaining amount into new order
        $this->crm0210Service->splitOrderForDelivery($order);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postShipping(Request $request)
    {
        $paramIn = $request->all();
        $user    = Auth::user();

        $result = $this->cusDeliveryService->confirmShipping($user, $paramIn);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postReceive(Request $request)
    {
        $paramIn = $request->all();
        $user    = Auth::user();

        $param       = $paramIn;
        $param["id"] = $param['store_delivery_id'];
        $imgList     = $this->crm0410Service->loadImages($param);

        if (sizeof($imgList["list"]) == 0) {
            $result = [
                'rtnCd'     => false,
                'message' => "Chưa upload chứng từ",
            ];

            return response()->success($result);
        }

        // $result = $this->cusDeliveryService->confirmReceive($user, $paramIn);
        Log::debug("----Check receive-------");
        Log::debug($paramIn);
        $result = $this->crm0400Service->updateReceive($paramIn, $user);
        $result = [
            'rtnCd'     => true,
        ];
        return response()->success($result);
    }

/*
[Input]:
+ store_delivery_id.
[output]:
+ rtnCd = true/false
+ msg : inform to user
[Action]:
+ change delivery_sts = 4 (Finish)
 */
    /**
     * @param Request $request
     */
    public function postFinish(Request $request)
    {
        $paramIn = $request->all();
        $user    = Auth::user();

        $result = $this->cusDeliveryService->confirmFinish($user, $paramIn);

        return response()->success($result);
    }

    /*
    [Input]:
    + store_delivery_id.
    + note
    [output]:
    + rtnCd = true/false
    + msg : inform to user
    [Action]:
    + change delivery_sts = 5 (cancel)
    + Save cancel note.
    + Save cancel time.
    + Delete data in warehouse_change with store_delivery_id.
     */
    public function postCancel()
    {
        $result = $this->orderService->cancelDelivery(Input::all());

        return response()->success($result);
    }

/*
[Input]:
+ store_delivery_id.
+ notes
[output]:
+ rtnCd = true/false
+ msg : inform to user
[Action]:
+ Create new cancel request data
 */
    /**
     * @param Request $request
     */
    public function postRequestCancel(Request $request)
    {
        $result = $this->crm0410Service->requestCancel($request->all());

        return response()->success($result);
    }

/*
[Input]:
+ request_id
[output]:
+ rtnCd = true/false
+ msg : inform to user
[Action]:
+ change delivery_sts = 5 (cancel)
+ Save cancel note.
+ Save cancel time.
+ Delete data in warehouse_change with store_delivery_id.
 */
    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        $result = $this->crm0410Service->accept($request->all());

        return response()->success($result);
    }

/*
[Input]:
+ request_id
[output]:
+ rtnCd = true/false
+ msg : inform to user
[Action]:
+ update
 */
    /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        $result = $this->crm0410Service->deny($request->all());

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0410Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0410Service->loadImages($param);
        Log::info("list image:", $result);

        return response()->success($result);
    }

}
