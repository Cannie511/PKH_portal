<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0711Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm0711Controller
 */
class Hrm0711Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0711Service;
    /**
     * @var mixed
     */
    private $employeeService;

    /**
     * @param Hrm0711Service $hrm0711Service
     * @param DownloadService $downloadService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        Hrm0711Service $hrm0711Service,
        DownloadService $downloadService,
        EmployeeService $employeeService
    ) {
        $this->hrm0711Service  = $hrm0711Service;
        $this->downloadService = $downloadService;
        $this->employeeService = $employeeService;
        // $this->middleware('permission:screen.hrm0711');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $param = $request->all();
        $data  = $this->employeeService->getEmployeeInfo($param["id"]);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Send pass code for payslip
     *
     * @param Request $request
     * @return void
     */
    public function postSendCode(Request $request)
    {
        $param = $request->all();
        $data  = $this->employeeService->sendCode($param["id"]);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->hrm0711Service->selectList($param);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    // /**
    //  * Sample action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.hrm0711.sample');

    //     $data = $this->hrm0711Service->selectList($param);
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    // /**
    //  * Download Excel
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postDownload(Request $request) {
    //     $this->requirePermission('screen.hrm0711.download');
    //     $param = $request->all();
    //     $param['export'] = true;
    //     $data = $this->hrm0711Service->selectList($param);
    //     $paramDownload = [
    //         "data" => $data,
    //         "file_name" => "XuatNhapVatPham",
    //         "view" => "hrm0711-list"
    //     ];
    //     $result = $this->downloadService->downloadExcelFile($paramDownload);
    //     return response()->success($result);
    // }

}
