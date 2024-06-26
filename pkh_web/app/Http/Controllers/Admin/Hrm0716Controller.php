<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Hrm0716Service;
use App\Services\DownloadService;

/**
 * Hrm0716Controller
 */
class Hrm0716Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $hrm0716Service;

    /**
     * @param Hrm0716Service $hrm0716Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Hrm0716Service $hrm0716Service,
        DownloadService $downloadService
    ) {
        $this->hrm0716Service  = $hrm0716Service;
        $this->downloadService = $downloadService;
        $this->middleware('permission:screen.hrm0716');
    }

    /**
     * Load contract
     *
     * @param Request $request
     * @return void
     */
    public function postLoadContract(Request $request)
    {
        $param = $request->all();
        $data  = $this->hrm0716Service->selectContract($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Save contract
     *
     * @param Request $request
     * @return void
     */
    public function postSave(Request $request)
    {

        $this->middleware('permission:screen.hrm0716.save');
        $this->validate($request, [
            'id'           => 'required|numeric|min:0',
            'contract_no'  => 'required',
            'title'        => 'required',
            'salary'       => 'required|numeric|min:0',
            'basic_salary' => 'required|numeric|min:0',
            'start_date'   => 'required|date|date_format:Y-m-d',
            'end_date'     => 'required|date|date_format:Y-m-d',
        ]);

        $param = $request->all();
        $data  = $this->hrm0716Service->saveContract($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * Load contract
     *
     * @param Request $request
     * @return void
     */
    public function postDelete(Request $request)
    {

        $this->middleware('permission:screen.hrm0716.delete');
        $param = $request->all();
        $data  = $this->hrm0716Service->deleteContract($param["id"]);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }
}
