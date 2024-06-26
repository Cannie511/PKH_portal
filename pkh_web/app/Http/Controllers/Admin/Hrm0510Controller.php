<?php

namespace App\Http\Controllers\Admin;

use App\Services\Hrm0510Service;
use App\Services\DownloadService;

/**
 * Hrm0510Controller
 */
class Hrm0510Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0510Service;

    /**
     * @param Hrm0510Service $hrm0510Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0510Service $hrm0510Service,
        DownloadService $downloadService
    ) {
        $this->hrm0510Service  = $hrm0510Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0510');
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0510Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0510.sample');

    //     $data = $this->hrm0510Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0510.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0510Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0510-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
