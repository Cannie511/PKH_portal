<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0900Service;
use App\Services\DownloadService;

/**
 * Hrm0900Controller
 */
class Hrm0900Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0900Service;

    /**
     * @param Hrm0900Service $hrm0900Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0900Service $hrm0900Service,
        DownloadService $downloadService
    ) {
        $this->hrm0900Service  = $hrm0900Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0900');
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
        $listYear = $this->hrm0900Service->selectListYear();
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
        $data   = $this->hrm0900Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0900.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0900Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm0900",
    //         "view" => "hrm0900-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
