<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1640Service;
use App\Services\DownloadService;
use App\Services\WarehouseService;
use App\Services\SupplierService;

/**
 * Crm1640Controller
 */
class Crm1640Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1640Service;
    /**
     * @var mixed
     */
    protected $warehouseService;
/**
     * @var mixed
     */
    protected $supplierService;
    /**
     * @param Crm1640Service $crm1640Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1640Service $crm1640Service
        ,
        DownloadService $downloadService
        ,
        WarehouseService $warehouseService,
        SupplierService $supplierService
    ) {
        $this->crm1640Service   = $crm1640Service;
        $this->downloadService  = $downloadService;
        $this->warehouseService = $warehouseService;
        $this->supplierService = $supplierService;

        //$this->middleware( 'permission:screen.crm1640' );
    }
    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param          = $request->all();
        $supplierList  = $this->supplierService->selectSupplierDropDown();

        $result = [
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */

// public function postSearch(Request $request) {

// $param = $request->all();

// $data = $this->crm1640Service->selectList($param);

//

// $result = [

// 'data' => $data

// ];

// return response()->success($result);
    // }
    public function postSearch(Request $request)
    {
        $param         = $request->all();
        $warehouseList = $this->warehouseService->selectWarehouseList();

        if (1 == $param['index']) {
            $data = $this->crm1640Service->searchForFactory($param);
        } else {
            $data = $this->crm1640Service->searchForStore($param);
        }

        $result = [
            'warehouseList' => $warehouseList,
            'index'         => $param['index'],
            'data'          => $data,
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
        //$result = $this->crm0920Service->download($request->all());

        $data          = $this->crm1640Service->selectForDownload($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "NhapBaoHanh-TraLai",
            "view"      => "crm1640-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
