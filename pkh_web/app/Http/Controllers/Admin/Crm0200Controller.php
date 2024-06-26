<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Log;
use Input;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\OrderService;
use App\Services\StatusService;
use App\Services\Crm0200Service;
use App\Services\Crm0210Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\SupplierService;
/**
 * Crm0200Controller
 * Danh sách đặt hàng
 */
class Crm0200Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $authService;
    /**
     * @var mixed
     */
    protected $crm0200Service;
    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $crm0210Service;
    /**
     * @var mixed
     */
    protected $statusService;
    /**
     * @var mixed
     */
    protected $orderService;
      /**
     * @var mixed
     */
    protected $supplierService;
    
    const ORDER_STATUS_TYPE = 1;

    /**
     * @param AuthService $authService
     * @param Crm0200Service $crm0200Service
     * @param Crm0210Service $crm0210Service
     * @param SalesmanService $salesmanService
     * @param StatusService $statusService
     * @param OrderService $orderService
     * @param DownloadService $downloadService
     */
    public function __construct(
        AuthService $authService
        ,
        Crm0200Service $crm0200Service
        ,
        Crm0210Service $crm0210Service
        ,
        SalesmanService $salesmanService
        ,
        StatusService $statusService
        ,
        OrderService $orderService
        ,
        DownloadService $downloadService,
        SupplierService $supplierService
    ) {
        $this->crm0200Service  = $crm0200Service;
        $this->crm0210Service  = $crm0210Service;
        $this->authService     = $authService;
        $this->salesmanService = $salesmanService;
        $this->statusService   = $statusService;
        $this->orderService    = $orderService;
        $this->downloadService = $downloadService;
        $this->supplierService = $supplierService;
        //$this->middleware( 'permission:screen.crm0200' );
    }

    /**
     * @param Request $request
     */
    public function postLoadPromotion(Request $request)
    {
        $param            = $request->all();
        $param["sale_id"] = $this->getRoleSaleMan();
        $promotionList    = $this->crm0210Service->loadPromotionList();
        $salesmanList     = $this->salesmanService->selectDropdown();
        $statusList       = $this->statusService->getStatus(SELF::ORDER_STATUS_TYPE);
        $branchList       = $this->orderService->selectBranchList();
        $reportStatus     = $this->orderService->selectReportStatus($param);
        $supplierList     = $this->supplierService->selectSupplierDropDown();
        $result           = [
            'promotionList' => $promotionList,
            'salesmanList'  => $salesmanList,
            'statusList'    => $statusList,
            'branchList'    => $branchList,
            'reportStatus'  => $reportStatus,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch()
    {
        // if( !$this->authService->can('screen.crm0200') ) {
        //     abort(403);
        // }
        $param = Input::all();
        $sts   = ['0', '2', '4', '5', '6', '', '8'];
        // $param            = $request->all();
        $param["sale_id"]   = $this->getRoleSaleMan();
        $param["order_sts"] = $sts[$param["index"] - 2];
        $list = $this->crm0200Service->selectOrderList($param);
            
        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0200.download');

        $param          = $request->all();
        $sts   = ['0', '2', '4', '5', '6', '', '8'];
        $param["order_sts"] = $sts[$param["index"] - 2];
        $param['down']  = 1;
        
        $result = $this->crm0200Service->download($param);

        return response()->success($result);
    }

}
