<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Log;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\Crm0751Service;
use App\Services\Crm0710Service;
use App\Services\StatusService;
/**
 * Crm0751Controller
 */
class Crm0751Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0751Service;
      /**
     * @var mixed
     */
    private $crm0710Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @var mixed
     */
    protected $statusService;

    const ORDER_STATUS_TYPE = 1;
    /**
     * @param Crm0751Service $crm0751Service
     * @param StoreService $storeService
     */
    public function __construct(
        Crm0710Service $crm0710Service,
        Crm0751Service $crm0751Service,
        StoreService   $storeService  ,
        StatusService  $statusService
    ) {
        $this->crm0710Service = $crm0710Service;
        $this->crm0751Service = $crm0751Service;
        $this->storeService   = $storeService;
        $this->statusService   = $statusService;
        $this->middleware('permission:screen.crm0751');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param        = $request->all();
        Log::debug('check crm0751---------');
        Log::debug($param);
        $order        = $this->crm0751Service->selectOrderById($param);
        $statusList   = $this->statusService->getStatus(SELF::ORDER_STATUS_TYPE);
        // $listAccount  = $this->crm0751Service->selectBankAccount($param);
        $inforPayment = null;

        if (isset($param['payment_id'])) {
            $inforPayment = $this->crm0751Service->selectPayment($param);
        }


        $result = [
            'order'        => $order[0],
            // 'listAccount'  => $listAccount,
            'inforPayment' => $inforPayment,
            'statusList'    => $statusList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param    = $request->all();
        $user     = Auth::user();
        Log::debug("--------check param 0751 -------");
        Log::debug($param);
        $store_id = $this->crm0751Service->savePayment($user, $param);
        $result   = [
            'store_id' => $store_id,
        ];

        return response()->success($store_id);
    }


    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0751Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0751Service->loadImages($param);
        // Log::info("list image:", $result);

        return response()->success($result);
    }

       /**
     * @param Request $request
     */
    public function postSendRequest(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm0751Service->sendRequest($user, $param);

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postCancel(Request $request)
    {
        $this->requirePermission('screen.crm0751.cancel');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm0751Service->Cancel($user, $param);
        

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        $this->requirePermission('screen.crm0751.accept');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm0751Service->Accept($user, $param);
        

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        $this->requirePermission('screen.crm0751.accept');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm0751Service->Deny($user, $param);
        
        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postAccConfirm(Request $request)
    {
        // $this->requirePermission('screen.crm1831.confirm');
        $this->requirePermission('screen.crm0751.confirm');
        $param  = $request->all();
        $user   = Auth::user();
        $result   = $this->crm0751Service->accConfirm($user, $param);
        
        $param["payment_id"] = Null;
        $param["payment_type"] = '3';
        // $p'notearam['payment_money'] = "";
        $param["notes"] = "Thưởng thanh toán trước ".$param['store_order_code'];
        Log::debug(" postAccConfirm");
        Log::debug($param);
        $res_save = $this->crm0710Service->savePayment($user,  $param);


        return response()->success($result);
    }

    
}
