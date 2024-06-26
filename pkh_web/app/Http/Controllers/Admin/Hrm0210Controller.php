<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\ETestService;

/**
 * Hrm0120Controller
 * Danh sach duyet don
 */
class Hrm0210Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $eTestService;

    /**
     * @param ETestService $eTestService
     */
    public function __construct(ETestService $eTestService)
    {
        $this->eTestService = $eTestService;
        // $this->middleware('permission.hrm0120');
    }

    /**
     * @param Request $request
     */
    public function postStart(Request $request)
    {
        $param  = $request->all();
        $result = $this->eTestService->start($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $param  = $request->all();
        $result = $this->eTestService->load($param);

        return response()->success($result);
    }

    /**
     * Save
     *
     * @return JSON
     */
    public function postSave(Request $request)
    {

        $param  = $request->all();
        $result = $this->eTestService->save($param);

        return response()->success($result);
    }
}
