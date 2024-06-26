<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\StatusService;
use App\Services\Crm0920Service;
use App\Services\DownloadService;
use App\Services\WarehouseService;
use App\Services\SupplierService;

/**
 * Crm0920Controller
 */
class Crm0920Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0920Service;
    /**
     * @var mixed
     */
    protected $statusService;
    /**
     * @var mixed
     */
    protected $warehouseService;
     /**
     * @var mixed
     */
    protected $supplierService;

    const DELIVERY_STATUS_TYPE = 2;
    const ORDER_STATUS_TYPE    = 1;

    /**
     * @param Crm0920Service $crm0920Service
     * @param DownloadService $downloadService
     * @param WarehouseService $orderService
     * @param StatusService $statusService
     */
    public function __construct(
        Crm0920Service $crm0920Service
        ,
        DownloadService $downloadService
        ,
        WarehouseService $warehouseService
        ,
        StatusService $statusService,
        SupplierService $supplierService
    ) {
        $this->crm0920Service   = $crm0920Service;
        $this->downloadService  = $downloadService;
        $this->statusService    = $statusService;
        $this->warehouseService = $warehouseService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0920');
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param              = $request->all();
        $data               = $this->crm0920Service->selectList($param);
        $statusOrderList    = $this->statusService->getStatus(SELF::ORDER_STATUS_TYPE);
        $statusDeliveryList = $this->statusService->getStatus(SELF::DELIVERY_STATUS_TYPE);
        $warehouseList      = $this->warehouseService->selectWarehouseList();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $result             = [
            'warehouseList'      => $warehouseList,
            'data'               => $data,
            'statusOrderList'    => $statusOrderList,
            'statusDeliveryList' => $statusDeliveryList,
            'supplierList'       => $supplierList
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
        //$result = $this->crm0920Service->download($request->all());
        $param['export'] = true;
        $data            = $this->crm0920Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "XuatNhapKho",
            "view"      => "crm0920-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }
}
