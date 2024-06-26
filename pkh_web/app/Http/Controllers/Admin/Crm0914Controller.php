<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0914Service;
use App\Services\DownloadService;

/**
 * Crm0914Controller
 */
class Crm0914Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0914Service;

    /**
     * @param Crm0914Service $crm0914Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0914Service $crm0914Service,
        DownloadService $downloadService
    ) {
        $this->crm0914Service  = $crm0914Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.crm0914');
    }

    // /**
    //  * Init action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.crm0914.sample');

    //     $data = $this->crm0914Service->selectList($param);
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
        $data   = $this->crm0914Service->selectList($param);
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
    //     $this->requirePermission('screen.crm0914.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->crm0914Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "crm0914",
    //         "view" => "crm0914-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
