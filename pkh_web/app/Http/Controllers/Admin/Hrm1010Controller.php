<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm1010Service;
use App\Services\DownloadService;

/**
 * Hrm1010Controller
 */
class Hrm1010Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm1010Service;

    /**
     * @param Hrm1010Service $hrm1010Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm1010Service $hrm1010Service,
        DownloadService $downloadService
    ) {
        $this->hrm1010Service  = $hrm1010Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm1010');
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
        $data   = $this->hrm1010Service->selectById($param['id']);
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

        $this->middleware('permission:screen.hrm1010.save');
        $this->validate($request, [
            'id'      => 'required|numeric|min:0',
            'title'   => 'required|max:1024',
            'content' => 'required',
        ]);

        $param = $request->all();
        $data  = $this->hrm1010Service->saveEntity($param);

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
    public function postPublish(Request $request)
    {

        $this->middleware('permission:screen.hrm1010.publish');
        $this->validate($request, [
            'id'      => 'required|numeric|min:1',
            'title'   => 'required|max:1024',
            'content' => 'required',
        ]);

        $param  = $request->all();
        $data   = $this->hrm1010Service->publish($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDelete(Request $request)
    {

        $this->middleware('permission:screen.hrm1010.delete');
        $param = $request->all();
        $data  = $this->hrm1010Service->deleteEntity($param["id"]);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
