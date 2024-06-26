<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0715Service;
use App\Services\DownloadService;

/**
 * Hrm0715Controller
 */
class Hrm0715Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0715Service;

    /**
     * @param Hrm0715Service $hrm0715Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0715Service $hrm0715Service,
        DownloadService $downloadService
    ) {
        $this->hrm0715Service  = $hrm0715Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0715');
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
        $data  = $this->hrm0715Service->selectList($param);

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
    //     $this->requirePermission('screen.hrm0715.sample');

    //     $data = $this->hrm0715Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0715.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0715Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0715-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
