<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0410Service;
use App\Services\DownloadService;

/**
 * Hrm0410Controller
 */
class Hrm0410Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0410Service;

    /**
     * @param Hrm0410Service $hrm0410Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0410Service $hrm0410Service,
        DownloadService $downloadService
    ) {
        $this->hrm0410Service  = $hrm0410Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0410');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0410Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0410.sample');

    //     $data = $this->hrm0410Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0410.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0410Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0410-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
