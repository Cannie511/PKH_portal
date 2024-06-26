<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0400Service;
use App\Services\DownloadService;

/**
 * Hrm0400Controller
 */
class Hrm0400Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0400Service;

    /**
     * @param Hrm0400Service $hrm0400Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0400Service $hrm0400Service,
        DownloadService $downloadService
    ) {
        $this->hrm0400Service  = $hrm0400Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0400');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0400Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0400.sample');

    //     $data = $this->hrm0400Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0400.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0400Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0400-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
