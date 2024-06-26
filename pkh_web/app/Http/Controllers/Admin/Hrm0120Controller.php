<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\AbsentService;
use App\Services\Hrm0120Service;
use App\Services\EmployeeService;

class Hrm0120Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $absentService;

    /**
     * @param AbsentService $absentService
     * @param Hrm0120Service $hrm0120Service
     */
    public function __construct(
        AbsentService $absentService,
        Hrm0120Service $hrm0120Service,
        EmployeeService $employeeService
    ) {
        $this->absentService   = $absentService;
        $this->hrm0120Service  = $hrm0120Service;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm0120');
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $listStaff = $this->employeeService->getDropdownEmployee();
        $result    = [
            'listStaff' => $listStaff,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->hrm0120Service->search($param, true);

        return response()->success($list);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.hrm0120.download');

        $param  = $request->all();
        $result = $this->hrm0120Service->download($request->all());

        return response()->success($result);
    }

    // public function postSearch(Request $request)
    // {
    //     $param = $request->all();
    //     $list = $this->absentService->search($param, true);

    //     return response()->success($list);
    // }

    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        $param  = $request->all();
        $result = $this->absentService->accept($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        $param  = $request->all();
        $result = $this->absentService->deny($param);

        return response()->success($result);
    }

}
