<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Services\Crm0912Service;
use App\Services\DownloadService;
use App\Services\SupplierService;
/**
 * Crm0912Controller
 */
class Crm0912Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0912Service;
      /**
     * @var mixed
     */
    protected $supplierService;

    /**
     * @param Crm0912Service $crm0912Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0912Service $crm0912Service,
        DownloadService $downloadService,
        SupplierService $supplierService
    ) {
        $this->crm0912Service  = $crm0912Service;
        $this->downloadService = $downloadService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0912');
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
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->crm0912Service->selectList($param);

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
        $this->requirePermission('screen.crm0912.download');

        $param = $request->all();
        //$result = $this->crm0912Service->download($param);
        $data          = $this->crm0912Service->selectList($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "SoNgayTonkho",
            "view"      => "crm0912-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    public function postExec()
    {
        $this->requirePermission('screen.crm0912.exec');

        $exitCode = Artisan::queue("BAT0110", []);

        $result = [
            'rtnCd' => $exitCode,
            'msg'   => "Đang thực thi",
        ];

        ob_clean();

        return response()->success($result);
    }

}
