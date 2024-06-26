<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Log;
use Auth;
use Input;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\StatusService;
use App\Services\Crm0210Service;
use App\Services\Crm0400Service;
use App\Services\Crm0410Service;
use App\Services\Crm1000Service;
use App\Services\DownloadService;
use App\Services\SalesmanService;
use App\Services\WarehouseService;
use App\Services\SupplierService;
/**
 * Crm0400Controller
 * Danh sach phieu xuat
 */
class Crm0400Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $orderService;
    /**
     * @var mixed
     */
    protected $crm0210Service;
    /**
     * @var mixed
     */
    protected $crm1000Service;
    /**
     * @var mixed
     */
    protected $crm0400Service;
    /**
     * @var mixed
     */
    protected $crm0410Service;

    /**
     * @var mixed
     */
    protected $salesmanService;
    /**
     * @var mixed
     */
    protected $warehouseService;

    /**
     * @var mixed
     */
    protected $statusService;
     /**
     * @var mixed
     */
    protected $supplierService;
    const DELIVERY_STATUS_TYPE = 2;

    /**
     * @param OrderService $orderService
     * @param Crm0210Service $crm0210Service
     * @param SalesmanService $salesmanService
     * @param StatusService $statusService
     * @param DownloadService $downloadService
     */
    public function __construct(
        OrderService $orderService
        ,
        Crm0210Service $crm0210Service
        ,
        Crm1000Service $crm1000Service
        ,
        Crm0400Service $crm0400Service
        ,
        SalesmanService $salesmanService
        ,
        Crm0410Service $crm0410Service
        ,
        StatusService $statusService
        ,
        DownloadService $downloadService
        ,
        WarehouseService $warehouseService,
        SupplierService $supplierService
    ) {
        $this->orderService     = $orderService;
        $this->crm0210Service   = $crm0210Service;
        $this->crm1000Service   = $crm1000Service;
        $this->crm0400Service   = $crm0400Service;
        $this->salesmanService  = $salesmanService;
        $this->statusService    = $statusService;
        $this->downloadService  = $downloadService;
        $this->warehouseService = $warehouseService;
        $this->crm0410Service   = $crm0410Service;
        $this->supplierService  = $supplierService;
        //$this->middleware( 'role.sale' );
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch()
    {

        $sts              = ['0', '6', '7', '1', '8', '9', '4', '5'];
        $param            = Input::all();
        $param["sale_id"] = $this->getRoleSaleMan();

        if ($param["index"] < 10) {
            $param["delivery_sts"] = $sts[$param["index"] - 2];
            $list                  = $this->orderService->selectDeliveryList($param);
        } elseif (10 == $param["index"]) {
            $list = $this->crm0400Service->selectDeliveryStats($param);
        }

        return response()->success($list);
    }

    public function postMap()
    {
        $param            = Input::all();
        $param["sale_id"] = $this->getRoleSaleMan();
        $list_1           = $this->crm0400Service->selectMapData($param);
        $list_2           = $this->crm0400Service->selectMapDataOrder($param);
        $list_3           = $this->crm0400Service->selectDeliveryVendor($param);

        $data = [
            'data_1' => $list_1,
            'data_2' => $list_2,
            'data_3' => $list_3,
        ];

        return response()->success($data);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postShipping(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $result = [
            'oke' => $this->crm0400Service->updateShipping($param, $user),
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postReceive(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $param["id"] = $param['store_delivery_id'];
        $imgList     = $this->crm0410Service->loadImages($param);

        if (sizeof($imgList["list"]) == 0) {
            $result = [
                'oke'     => false,
                'message' => "Chưa upload chứng từ",
            ];

            return response()->success($result);
        }

        Log::debug('-----check param');
        Log::debug($param);
        $result = [
            'oke' => $this->crm0400Service->updateReceive($param, $user),
        ];

        return response()->success($result);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postLoadInitShipping(Request $request)
    {
        $param = $request->all();
        // $param['down']  = 1;
        $param['down'] = 1;
        $shippingList  = $this->crm1000Service->selectList($param);
        Log::debug('-------- postLoadInitShipping -----------');
        Log::debug($shippingList);
        $result = [
            'shippingList' => $shippingList,
        ];

        return response()->success($result);
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
        $statusList       = $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE);
        $branchList       = $this->orderService->selectBranchList();
        $reportStatus     = $this->orderService->selectReportDeliveryStatus($param);
        $warehouseList    = $this->warehouseService->selectWarehouseList();
        $supplierList     = $this->supplierService->selectSupplierDropDown();
        $test = [];

        foreach ($statusList as $sts) {

            foreach ($reportStatus as $rep) {

                if ($sts["status_id"] == $rep->delivery_sts) {
                    $test[] = $rep;
                    break;
                }

            }

        }

//Log::debug('------------check test status-------------');
        //Log::debug($test);

        $result = [
            'promotionList' => $promotionList,
            'salesmanList'  => $salesmanList,
            'statusList'    => $statusList,
            'branchList'    => $branchList,
            'reportStatus'  => $test,
            'warehouseList' => $warehouseList,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0400.download');
        $param = $request->all();

        $data = [
            "list"   => $this->orderService->selectDeliveryList($param),
            "status" => $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE),
        ];

        $paramDownload = [
            "data"      => $data,
            "file_name" => "XuatHang",
            "view"      => "crm0400-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownloadList(Request $request)
    {
        $this->requirePermission('screen.crm0400.download');

        $param          = $request->all();
        // $sts            = ['0', '6', '7', '1', '8', '9', '4', '5'];
        // $param["delivery_sts"] = $sts[$param["index"] - 2];
        $param['down']         = 1;
        $param["sale_id"] = $this->getRoleSaleMan();

        $result = $this->crm0400Service->downloadList($param);

        return response()->success($result);
    }

}
