<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0600Service;
use App\Services\DownloadService;

/**
 * Hrm0600Controller
 */
class Hrm0600Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0600Service;

    /**
     * @param Hrm0600Service $hrm0600Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0600Service $hrm0600Service,
        DownloadService $downloadService
    ) {
        $this->hrm0600Service  = $hrm0600Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0600');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0600Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0600.sample');

    //     $data = $this->hrm0600Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0600.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0600Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0600-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
