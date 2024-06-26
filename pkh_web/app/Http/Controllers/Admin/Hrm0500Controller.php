<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0500Service;
use App\Services\DownloadService;

/**
 * Hrm0500Controller
 */
class Hrm0500Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0500Service;

    /**
     * @param Hrm0500Service $hrm0500Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0500Service $hrm0500Service,
        DownloadService $downloadService
    ) {
        $this->hrm0500Service  = $hrm0500Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0500');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0500Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0500.sample');

    //     $data = $this->hrm0500Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0500.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0500Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0500-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
