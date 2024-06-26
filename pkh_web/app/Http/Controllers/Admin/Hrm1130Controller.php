<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1130Service;
use App\Services\DownloadService;

/**
 * Hrm1130Controller
 */
class Hrm1130Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1130Service;

    /**
     * @param Hrm1130Service $hrm1130Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1130Service $hrm1130Service,
        DownloadService $downloadService
    ) {
        $this->hrm1130Service  = $hrm1130Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1130');
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
        $data   = $this->hrm1130Service->selectById($param['id']);
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

        $this->middleware('permission:screen.hrm1130.save');
        $this->validate($request, [
            'id'           => 'required|numeric|min:0',
            'employee_id'  => 'required|numeric|min:0',
            'num_days'     => 'required|numeric|min:0|max:20',
            'expired_date' => 'required|date|date_format:Y-m-d',
        ]);

        $param = $request->all();
        $data  = $this->hrm1130Service->saveEntity($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.hrm1130.delete');
    //     $param = $request->all();
    //     $data = $this->hrm1130Service->deleteEntity($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
