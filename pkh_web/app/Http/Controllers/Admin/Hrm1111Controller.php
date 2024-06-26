<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Services\SalaryService;
use App\Services\Hrm1111Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm1111Controller
 */
class Hrm1111Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1111Service;

    /**
     * @param Hrm1111Service $hrm1111Service
     * @param DownloadService $downloadService
     * @param SalaryService $salaryService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        Hrm1111Service $hrm1111Service,
        DownloadService $downloadService,
        SalaryService $salaryService,
        EmployeeService $employeeService) {

        $this->hrm1111Service  = $hrm1111Service;
        $this->downloadService = $downloadService;
        $this->salaryService   = $salaryService;
        $this->employeeService = $employeeService;
        $this->middleware('permission:screen.hrm1111');
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

        return response()->success([]);
    }

    /**
     * Load data
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $param        = $request->all();
        $salaryInfo   = $this->hrm1111Service->selectById($param['id']);
        $listEmployee = $this->hrm1111Service->selectListEmployee($param['id']);
        $result       = [
            'salaryInfo'   => $salaryInfo,
            'listEmployee' => $listEmployee,
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

        $this->middleware('permission:screen.hrm1111.save');
        $this->validate($request, [
            'id' => 'required|numeric|min:0',
        ]);

        $param = $request->all();
        $data  = $this->hrm1111Service->saveEntity($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Update status
     *
     * @param Request $request
     * @return void
     */
    public function postSend(Request $request)
    {

        $this->middleware('permission:screen.hrm1111.confirm');
        $this->validate($request, [
            'id'     => 'required|numeric|min:0',
            'status' => 'required|numeric|min:0|max:2',
        ]);

        $param = $request->all();
        $data  = $this->hrm1111Service->updateSts($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Update status
     *
     * @param Request $request
     * @return void
     */
    public function postApprove(Request $request)
    {

        $this->middleware('permission:screen.hrm1111.approve');
        $this->validate($request, [
            'id'     => 'required|numeric|min:0',
            'status' => 'required|numeric|min:0|max:2',
        ]);

        $param = $request->all();
        $data  = $this->hrm1111Service->updateSts($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Remove employee from salary table
     *
     * @param Request $request
     * @return void
     */
    public function postRemove(Request $request)
    {
        $this->middleware('permission:screen.hrm1111.save');
        $param = $request->all();

        try {
            DB::beginTransaction();
            // Remove employee
            $data = $this->hrm1111Service->remove($param["id"], $param["salary_id"]);
            // Update salary
            $this->salaryService->updateSalaryTotal($param["salary_id"]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->success([
                "rtnCd" => false,
                "msg"   => "Đã xãy ra lỗi. (" . $e->getMessage() . ")",
            ]);
        }

        return response()->success($data);
    }

    /**
     * Add employee to salary table
     *
     * @param Request $request
     * @return void
     */
    public function postAdd(Request $request)
    {
        $this->middleware('permission:screen.hrm1111.save');
        $param = $request->all();

        try {
            DB::beginTransaction();
            // Remove employee
            $this->salaryService->addEmployee($param["salary_id"], $param["employee_id"]);
            // Update salary
            $this->salaryService->updateSalaryTotal($param["salary_id"]);
            DB::commit();

            return response()->success([
                "rtnCd" => true,
                "msg"   => "Đã thêm thành công)",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->success([
                "rtnCd" => false,
                "msg"   => "Đã xãy ra lỗi. (" . $e->getMessage() . ")",
            ]);
        }
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.hrm1111.delete');
    //     $param = $request->all();
    //     $data = $this->hrm1111Service->deleteEntity($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.hrm0141.download');
        $param = $request->all();

        $result = $this->hrm1111Service->download($param);

        return response()->success($result);
    }

    public function postSendAll(Request $request)
    {
        // $this->requirePermission('screen.hrm0141.download');
        $param = $request->all();

        $result = $this->hrm1111Service->sendAll($param);

        return response()->success($result);
    }

}
