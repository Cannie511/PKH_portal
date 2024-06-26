<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\ZaloService;
use App\Services\Crm0750Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\StatusService;

class Crm0750Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0750Service;
    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $zaloService;
   /**
     * @var mixed
     */
    protected $statusService;
    
    const ORDER_STATUS_TYPE = 1;
    /**
     * @param Crm0750Service $crm0750Service
     * @param SalesmanService $salesmanService
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0750Service $crm0750Service,
        SalesmanService $salesmanService,
        DownloadService $downloadService,
        ZaloService $zaloService,
        StatusService $statusService
    ) {
        $this->crm0750Service  = $crm0750Service;
        $this->salesmanService = $salesmanService;
        $this->downloadService = $downloadService;
        $this->zaloService     = $zaloService;
        $this->statusService   = $statusService;
        $this->middleware('permission:screen.crm0750');
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postLoadPromotion(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $statusList       = $this->statusService->getStatus(SELF::ORDER_STATUS_TYPE);
        $result       = [
            'salesmanList' => $salesmanList,
            'statusList'    => $statusList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();

        if (1 == $param['index']) {
            $data = $this->crm0750Service->selectList($param);
        } else {
            $data = $this->crm0750Service->selectZaloNotifyList($param);
        }

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        //$this->requirePermission('screen.crm0910.download');
        $param = $request->all();
        //$result = $this->crm0750Service->download($param);
        $this->requirePermission('screen.crm0750.download');
        $data          = $this->crm0750Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "CongNo",
            "view"      => "crm0750-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

 
   
    /**
     * @param Request $request
     */
    public function postNotifyZalo(Request $request)
    {
        $this->requirePermission('screen.crm0750.zalo');
        // $this->middleware('permission:screen.crm0750');
        $param       = $request->all();
        $paramNotify = [];

// $paramNotify["uid"] = "84915846849";
        // $paramNotify["message"] = $this->crm0750Service->makeMessageToSend($param['payment_id']);

        $paramNotify = $this->crm0750Service->makeMessageToSend($param['payment_id']);
        $result      = $this->zaloService->notifyOneFollowerByPhone($paramNotify);

        if (1 == $result["errorCode"]) {
            $this->crm0750Service->updatePaymentStatus($param['payment_id']);
        }

        $paramNotify["payment_id"] = $param['payment_id'];
        $paramNotify["errorCode"]  = $result["errorCode"];
        $paramNotify["errorMsg"]   = $result["errorMsg"];
        $user                      = Auth::user();
        $this->crm0750Service->recordZaloNotify($paramNotify, $user);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdateAccountant(Request $request)
    {
        $this->requirePermission('screen.crm0700.update');

        // $this->middleware('permission:screen.crm0750');
        Log::debug('-----------checking accountant--------------');
        $param = $request->all();
        $res   = $this->crm0750Service->updateAccountant($param);

        return response()->success($res);
    }

}
