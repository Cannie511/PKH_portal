<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0710Service;
use App\Services\DownloadService;

/**
 * Hrm0710Controller
 */
class Hrm0710Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0710Service;

    /**
     * @param Hrm0710Service $hrm0710Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0710Service $hrm0710Service,
        DownloadService $downloadService
    ) {
        $this->hrm0710Service  = $hrm0710Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0710');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0710Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0710.sample');

    //     $data = $this->hrm0710Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0710.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0710Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0710-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
