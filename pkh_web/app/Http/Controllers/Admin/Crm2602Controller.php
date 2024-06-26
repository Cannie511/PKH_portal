<?php

namespace App\Http\Controllers\Admin;

use App\Services\Crm2602Service;
use App\Services\DownloadService;

/**
 * Crm2602Controller
 */
class Crm2602Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2602Service;

    /**
     * @param Crm2602Service $crm2602Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm2602Service $crm2602Service,
        DownloadService $downloadService
    ) {
        $this->crm2602Service  = $crm2602Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.crm2602');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->crm2602Service->selectList($param);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    // /**
    //  * Sample action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.crm2602.sample');

    //     $data = $this->crm2602Service->selectList($param);
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    // /**
    //  * Download Excel
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postDownload(Request $request) {
    //     $this->requirePermission('screen.crm2602.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->crm2602Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "crm2602-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
