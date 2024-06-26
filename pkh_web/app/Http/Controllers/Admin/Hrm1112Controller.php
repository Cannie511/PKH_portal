<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Services\Hrm1112Service;
use App\Services\DownloadService;

/**
 * Hrm1112Controller
 */
class Hrm1112Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1112Service;

    /**
     * @param Hrm1112Service $hrm1112Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1112Service $hrm1112Service,
        DownloadService $downloadService
    ) {
        $this->hrm1112Service  = $hrm1112Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1112');
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
     * Load data
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {
        $param  = $request->all();
        $data   = $this->hrm1112Service->selectById($param['id']);
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

        $this->middleware('permission:screen.hrm1112.save');
        $this->validate($request, [
            'id'                     => 'required|numeric|min:0',
            'salary_id'              => 'required|numeric|min:0',
            'basic_salary'           => 'required|numeric|min:0',
            'total_days'             => 'required|numeric|min:0',
            'total_hours'            => 'required|numeric|min:0',
            'gross_salary'           => 'required|numeric|min:0',
            'count_dependent_person' => 'required|numeric|min:0',
            'overtime_salary'        => 'required|numeric|min:0',
            'bonus'                  => 'required|numeric|min:0',
            'minus_amount'           => 'required|numeric|min:0',
            'advance'                => 'required|numeric|min:0',
        ]);

        $param = $request->all();

        try {
            DB::beginTransaction();
            $data = $this->hrm1112Service->saveEntity($param);
            // Update salary
            // $this->salaryService->updateSalaryTotal($param["salary_id"]);
            DB::commit();

            $result = [
                'data' => $data,
            ];

            return response()->success($result);
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

    //     $this->middleware('permission:screen.hrm1112.delete');
    //     $param = $request->all();
    //     $data = $this->hrm1112Service->deleteEntity($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
