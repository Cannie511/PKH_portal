<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0910Service;
use App\Services\DownloadService;

/**
 * Hrm0910Controller
 */
class Hrm0910Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0910Service;

    /**
     * @param Hrm0910Service $hrm0910Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0910Service $hrm0910Service,
        DownloadService $downloadService
    ) {
        $this->hrm0910Service  = $hrm0910Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0910');
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
        $data   = $this->hrm0910Service->selectById($param['id']);
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

        $this->middleware('permission:screen.hrm0910.save');
        $this->validate($request, [
            'reason'       => 'required|min:0|max:255',
            'amount'       => 'required|numeric|min:0|max:1',
            'holiday_date' => 'required|date|date_format:Y-m-d',
        ]);

        $param = $request->all();
        $data  = $this->hrm0910Service->saveEntity($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.hrm0910.delete');
    //     $param = $request->all();
    //     $data = $this->hrm0910Service->deleteContract($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
