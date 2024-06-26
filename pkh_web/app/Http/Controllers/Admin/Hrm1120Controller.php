<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1120Service;
use App\Services\DownloadService;

/**
 * Hrm1120Controller
 */
class Hrm1120Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1120Service;

    /**
     * @param Hrm1120Service $hrm1120Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1120Service $hrm1120Service,
        DownloadService $downloadService
    ) {
        $this->hrm1120Service  = $hrm1120Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1120');
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
        // $listEmployee = $this->employeeService->getDropdownEmployee();
        // $result = [
        //     'listEmployee' => $listEmployee
        // ];
        // return response()->success($result);
        return response()->success([]);
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
        $data   = $this->hrm1120Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm1120.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm1120Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm1120",
    //         "view" => "hrm1120-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
