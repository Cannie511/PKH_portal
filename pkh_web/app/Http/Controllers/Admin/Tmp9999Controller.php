<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Tmp9999Service;
use App\Services\DownloadService;

/**
 * Tmp9999Controller
 */
class Tmp9999Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $tmp9999Service;

    /**
     * @param Tmp9999Service $tmp9999Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Tmp9999Service $tmp9999Service,
        DownloadService $downloadService
    ) {
        $this->tmp9999Service  = $tmp9999Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.tmp9999');
    }

    // /**
    //  * Init action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.tmp9999.sample');

    //     $data = $this->tmp9999Service->selectList($param);
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $data   = $this->tmp9999Service->selectList($param);
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
    //     $this->requirePermission('screen.tmp9999.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->tmp9999Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "tmp9999",
    //         "view" => "tmp9999-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
