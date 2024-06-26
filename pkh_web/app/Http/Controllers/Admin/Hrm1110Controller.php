<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Services\Hrm1110Service;
use App\Services\DownloadService;

/**
 * Hrm1110Controller
 */
class Hrm1110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1110Service;

    /**
     * @param Hrm1110Service $hrm1110Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1110Service $hrm1110Service,
        DownloadService $downloadService
    ) {
        $this->hrm1110Service  = $hrm1110Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1110');
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
        $data   = $this->hrm1110Service->selectById($param['id']);
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

        $this->middleware('permission:screen.hrm1110.save');
        $this->validate($request, [
            'salary_month' => 'required|date|date_format:Y-m-d',
        ]);

        $param = $request->all();

        try {
            DB::beginTransaction();
            $data = $this->hrm1110Service->saveEntity($param);
            DB::commit();

            return response()->success($data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->success([
                "rtnCd" => false,
                "msg"   => "Đã tồn tại dữ liệu này. (" . $e->getMessage() . ")",
            ]);
        }
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.hrm1110.delete');
    //     $param = $request->all();
    //     $data = $this->hrm1110Service->deleteEntity($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
