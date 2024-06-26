<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0810Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm0810Controller
 */
class Hrm0810Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0810Service;

    /**
     * @param Hrm0810Service $hrm0810Service
     * @param DownloadService $downloadService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        Hrm0810Service $hrm0810Service,
        DownloadService $downloadService,
        EmployeeService $employeeService
    ) {
        $this->hrm0810Service  = $hrm0810Service;
        $this->downloadService = $downloadService;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm0810');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInitData(Request $request)
    {
        $param        = $request->all();
        $listEmployee = $this->employeeService->getDropdownEmployee();
        $result       = [
            'listEmployee' => $listEmployee,
        ];

        return response()->success($result);
    }

    /**
     * Load data
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $param  = $request->all();
        $data   = $this->hrm0810Service->selectById($param['id']);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Save entity
     *
     * @param Request $request
     * @return void
     */
    public function postSave(Request $request)
    {

        $this->middleware('permission:screen.hrm0810.save');
        $this->validate($request, [
            'id'           => 'required|numeric|min:0',
            'employee_id'  => 'required|numeric|min:0',
            'num_days'     => 'required|numeric|min:0|max:20',
            'expired_date' => 'required|date|date_format:Y-m-d',
        ]);

        $param = $request->all();
        $data  = $this->hrm0810Service->saveEntity($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.hrm0810.delete');
    //     $param = $request->all();
    //     $data = $this->hrm0810Service->deleteContract($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
