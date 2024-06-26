<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0154Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm0154Controller
 */
class Hrm0154Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0154Service;

    /**
     * @param Hrm0154Service $hrm0154Service
     * @param DownloadService $downloadService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        Hrm0154Service $hrm0154Service,
        DownloadService $downloadService,
        EmployeeService $employeeService
    ) {
        $this->hrm0154Service  = $hrm0154Service;
        $this->downloadService = $downloadService;
        $this->employeeService = $employeeService;
        //$this->middleware('permission:screen.hrm0154');
    }

    // /**
    //  * Init action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.hrm0154.sample');

    //     $data = $this->hrm0154Service->selectList($param);
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
    public function postInit(Request $request)
    {
        // $param = $request->all();
        $listEmployee = $this->employeeService->getDropdownEmployee();
        $result       = [
            'listEmployee' => $listEmployee,
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
        $data   = $this->hrm0154Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0154.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0154Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm0154",
    //         "view" => "hrm0154-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
