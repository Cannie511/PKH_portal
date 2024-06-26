<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0700Service;
use App\Services\DownloadService;

/**
 * Hrm0700Controller
 */
class Hrm0700Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0700Service;

    /**
     * @param Hrm0700Service $hrm0700Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0700Service $hrm0700Service,
        DownloadService $downloadService
    ) {
        $this->hrm0700Service  = $hrm0700Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0700');
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
        $data  = $this->hrm0700Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0700.sample');

    //     $data = $this->hrm0700Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0700.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0700Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0700-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
