<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0800Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm0800Controller
 */
class Hrm0800Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0800Service;

    /**
     * @param Hrm0800Service $hrm0800Service
     * @param DownloadService $downloadService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        Hrm0800Service $hrm0800Service,
        DownloadService $downloadService,
        EmployeeService $employeeService
    ) {
        $this->hrm0800Service  = $hrm0800Service;
        $this->downloadService = $downloadService;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm0800');
    }

    /**
     * Init action
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {
        // $this->requirePermission('screen.hrm0800.sample');

        $param        = $request->all();
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
        $data   = $this->hrm0800Service->selectList($param);
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
    //     $this->requirePermission('screen.hrm0800.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0800Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "hrm0800",
    //         "view" => "hrm0800-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
