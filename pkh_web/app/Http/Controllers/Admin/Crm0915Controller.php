<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0915Service;
use App\Services\DownloadService;

/**
 * Crm0915Controller
 */
class Crm0915Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0915Service;

    /**
     * @param Crm0915Service $crm0915Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0915Service $crm0915Service,
        DownloadService $downloadService
    ) {
        $this->crm0915Service  = $crm0915Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.crm0915');
    }

    // /**
    //  * Init action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.crm0915.sample');

    //     $data = $this->crm0915Service->selectList($param);
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
        $data   = $this->crm0915Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.crm0915.download');
        $param           = $request->all();
        $param['export'] = true;
        $data            = $this->crm0915Service->selectList($param);
        $paramDownload   = [
            "data"      => $data,
            "file_name" => "crm0915",
            "view"      => "crm0915-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
