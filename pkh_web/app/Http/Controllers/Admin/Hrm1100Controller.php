<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1100Service;
use App\Services\DownloadService;

/**
 * Hrm1100Controller
 */
class Hrm1100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1100Service;

    /**
     * @param Hrm1100Service $hrm1100Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1100Service $hrm1100Service,
        DownloadService $downloadService
    ) {
        $this->hrm1100Service  = $hrm1100Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1100');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInitData(Request $request)
    {
        // $param = $request->all();
        $listYear = $this->hrm1100Service->selectListYear();
        $result   = [
            'listYear' => $listYear,
        ];

        return response()->success($result);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $data   = $this->hrm1100Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // /**
    //  * Download Excel
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postDownload(Request $request) {
    //     $this->requirePermission('screen.hrm1100.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm1100Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm1100",
    //         "view" => "hrm1100-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
