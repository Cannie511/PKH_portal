<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0153Service;
use App\Services\DownloadService;

/**
 * Hrm0153Controller
 */
class Hrm0153Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0153Service;

    /**
     * @param Hrm0153Service $hrm0153Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0153Service $hrm0153Service,
        DownloadService $downloadService
    ) {
        $this->hrm0153Service  = $hrm0153Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.hrm0153');
    }

    // /**
    //  * Init action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.hrm0153.sample');

    //     $data = $this->hrm0153Service->selectList($param);
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
        $data   = $this->hrm0153Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Checkin
     *
     * @param Request $request
     * @return void
     */
    public function postCheckin(Request $request)
    {
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $param          = $request->all();
        $param["agent"] = $agent;
        $param["ip"]    = $ip;

        $data   = $this->hrm0153Service->checkin($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Checkout
     *
     * @param Request $request
     * @return void
     */
    public function postCheckout(Request $request)
    {
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $param          = $request->all();
        $param["agent"] = $agent;
        $param["ip"]    = $ip;

        $data   = $this->hrm0153Service->checkout($param);
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
    //     $this->requirePermission('screen.hrm0153.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0153Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm0153",
    //         "view" => "hrm0153-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
