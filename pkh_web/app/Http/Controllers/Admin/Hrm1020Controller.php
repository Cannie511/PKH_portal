<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1020Service;
use App\Services\DownloadService;

/**
 * Hrm1020Controller
 */
class Hrm1020Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1020Service;

    /**
     * @param Hrm1020Service $hrm1020Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1020Service $hrm1020Service,
        DownloadService $downloadService
    ) {
        $this->hrm1020Service  = $hrm1020Service;
        $this->downloadService = $downloadService;
        //$this->middleware('permission:screen.hrm1020');
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
        $data   = $this->hrm1020Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm1020.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm1020Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm1020",
    //         "view" => "hrm1020-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
