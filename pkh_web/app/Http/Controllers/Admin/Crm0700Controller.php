<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ZaloService;
use App\Services\Crm0700Service;
use App\Services\Crm0720Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\ESMS\Esms;

class Crm0700Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0700Service;
     /**
     * @var mixed
     */
    protected $crm0720Service;
    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $zaloService;

    /**
     * @param Crm0700Service $crm0700Service
     * @param SalesmanService $salesmanService
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0700Service $crm0700Service,
        Crm0720Service $crm0720Service,
        SalesmanService $salesmanService,
        DownloadService $downloadService,
        ZaloService $zaloService,
        Esms $esms
    ) {
        $this->crm0700Service  = $crm0700Service;
        $this->crm0720Service  = $crm0720Service;
        $this->salesmanService = $salesmanService;
        $this->downloadService = $downloadService;
        $this->zaloService     = $zaloService;
        $this->esms            = $esms;
        $this->middleware('permission:screen.crm0700');
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postLoadPromotion(Request $request)
    {
        $salesmanList = $this->salesmanService->selectDropdown();
        $result       = [
            'salesmanList' => $salesmanList,
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
            $data = $this->crm0700Service->selectList($param);
        } else {
            $data = $this->crm0700Service->selectZaloNotifyList($param);
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
        //$result = $this->crm0700Service->download($param);
        $this->requirePermission('screen.crm0700.download');
        $data          = $this->crm0700Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "CongNo",
            "view"      => "crm0700-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postNotifyZalo(Request $request)
    {
        $this->requirePermission('screen.crm0700.zalo');
        // $this->middleware('permission:screen.crm0700');
        $param       = $request->all();
        $paramNotify = [];

        // $paramNotify["uid"] = "84915846849";
        // $paramNotify["message"] = $this->crm0700Service->makeMessageToSend($param['payment_id']);

        // $paramNotify = $this->crm0700Service->makeMessageToSend($param['payment_id']);
        // $result      = $this->zaloService->notifyOneFollowerByPhone($paramNotify);
        $this->notifyViaESMS($param);
        $this->crm0700Service->updatePaymentStatus($param['payment_id']);
        
        // $paramNotify["payment_id"] = $param['payment_id'];
        // $paramNotify["errorCode"]  = $result["errorCode"];
        // $paramNotify["errorMsg"]   = $result["errorMsg"];
        // $user                      = Auth::user();
        // $this->crm0700Service->recordZaloNotify($paramNotify, $user);
        $result  = [
            "errorMsg" => "sent"
        ];

        return response()->success($result);
    }

    public function notifyViaESMS($param){
        // Send ZNS to customer
        $item     = $param['item'];
        // $delivery_code      =  explode("_", $item["store_delivery_code"]);
        $amount   = number_format($item["payment_money"],0)." VND";
        // $new_delivery_code  =  $delivery_code[1]. "_". $delivery_code[2] . "_" .strval($param['store_delivery_id']);
        // $id = "don-hang?orderId=".$new_delivery_code;
        $item["month"] =  Carbon::now("m");
        $remaining_obj  = $this->crm0720Service->selectList($item)["data"][0];
        // item.remain_lastmonth = parseInt(item.total_with_discount_lastmonth) - parseInt(item.payment_lastmonth);
        // item.edit_thismonth = parseInt(item.payment_plus_thismonth) + parseInt(item.payment_minus_thismonth);
        // item.remain =
        //     item.remain_lastmonth +
        //     parseInt(item.total_with_discount_thismonth) -
        //     parseInt(item.payment_thismonth) -
        //     parseInt(item.payment_plus_thismonth) -
        //     parseInt(item.payment_minus_thismonth);
        $remain_lastmonth = $remaining_obj->total_with_discount_lastmonth - $remaining_obj->payment_lastmonth;
        $remain          = $remain_lastmonth + $remaining_obj->total_with_discount_thismonth - $remaining_obj->payment_thismonth
                            - $remaining_obj->payment_plus_thismonth - $remaining_obj->payment_minus_thismonth;
        $remain          = number_format($remain,0)." VND";
        // Log::debug() ;

        // $remaining_amount  = number_format( $remaining_amount ,0)." VND";

        Log::debug("------- check remaining amount ---------");
        // Log::debug($remaining_amount);
        $data = [substr($item["store_name"],0,30)
                ,substr($item["address"],0,80)
                , $amount
                ,Carbon::now()->format('Y-m-d')
                ,$remain
                ,"_"
                 ];
        $key = "218410";
        $phone = $item["contact_mobile1"];
        $this->esms->post($key, $phone, $item["store_id"], $data);

    }

    /**
     * @param Request $request
     */
    public function postUpdateAccountant(Request $request)
    {
        $this->requirePermission('screen.crm0700.update');

        // $this->middleware('permission:screen.crm0700');
        Log::debug('-----------checking accountant--------------');
        $param = $request->all();
        $res   = $this->crm0700Service->updateAccountant($param);

        return response()->success($res);
    }

}
