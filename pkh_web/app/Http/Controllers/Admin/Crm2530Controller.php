<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2530Service;
use App\Services\DownloadService;

/**
 * Crm2530Controller
 */
class Crm2530Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2530Service;

    /**
     * @param Crm2530Service $crm2530Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2530Service $crm2530Service,
        DownloadService $downloadService
    ) {
        $this->crm2530Service  = $crm2530Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm2530');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $data   = $this->crm2530Service->selectList($param);
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
        // $this->requirePermission('screen.crm2530.download');
        $param           = $request->all();
        $param['export'] = true;
        $data            = $this->crm2530Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "XuatNhapVatPham",
            "view"      => "crm2530-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
