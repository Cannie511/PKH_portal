<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2700Service;
use App\Services\DownloadService;

/**
 * Crm2700Controller
 */
class Crm2700Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2700Service;

    /**
     * @param Crm2700Service $crm2700Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2700Service $crm2700Service,
        DownloadService $downloadService
    ) {
        $this->crm2700Service  = $crm2700Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm2700');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->crm2700Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // /**
    //  * Sample action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.crm2700.sample');

    //     $data = $this->crm2700Service->selectList($param);
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm2700.download');
        $param           = $request->all();
        $param['export'] = true;
        $data            = $this->crm2700Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "XuatNhapVatPham",
            "view"      => "crm2700-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
