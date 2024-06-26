<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm0910Service;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\WarehouseService;
use App\Services\SupplierService;

/**
 * Crm0910Controller
 */
class Crm0910Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0910Service;
    /**
     * @var mixed
     */
    protected $warehouseService;
    /**
     * @var mixed
     */
    protected $productService;
     /**
     * @var mixed
     */
    protected $supplierService;


    /**
     * @param Crm0910Service $crm0910Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0910Service $crm0910Service,
        DownloadService $downloadService,
        WarehouseService $warehouseService
        ,
        ProductService $productService,
        SupplierService $supplierService
    ) {
        $this->crm0910Service   = $crm0910Service;
        $this->downloadService  = $downloadService;
        $this->warehouseService = $warehouseService;
        $this->productService   = $productService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0910');
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param         = $request->all();
        $warehouseList = $this->warehouseService->selectWarehouseList();
        $catList       = $this->productService->selectListCatForWeb();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $result        = [
            'warehouseList' => $warehouseList,
            'catList'       => $catList,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        $month = $param['month'];
        $date  = Carbon::createFromFormat('Y-m-d', substr($month, 0, 7) . '-01');

        $start_date = $date->startOfMonth()->format('Y-m-d');
        $end_date   = $date->endOfMonth()->format('Y-m-d');

        Log::debug('-----------check date---------');
        Log::debug($param);
        Log::debug($start_date);
        Log::debug($end_date);
        $data = $this->warehouseService->selectList($param, $start_date, $start_date, $end_date);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

  
    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0910.download');

        $param = $request->all();
        //$result = $this->crm0910Service->download($param['month']);
        $month = $param['month'];
        $date  = Carbon::createFromFormat('Y-m-d', substr($month, 0, 7) . '-01');

        $start_date = $date->startOfMonth()->format('Y-m-d');
        $end_date   = $date->endOfMonth()->format('Y-m-d');

        Log::debug('-----------check date---------');
        Log::debug($date);
        Log::debug($start_date);
        Log::debug($end_date);
        $data = $this->warehouseService->selectList($param, $start_date, $start_date, $end_date);
        // $data          =  $this->warehouseService->selectList($param['month']);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "TonKhoThang",
            "view"      => "crm0910-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
