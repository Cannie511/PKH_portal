<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\ETestService;

/**
 * Hrm0120Controller
 * Danh sach duyet don
 */
class Hrm0200Controller extends AdminBaseController
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
    public function postSearch(Request $request)
    {
        $param  = $request->all();
        $result = $this->eTestService->searchList($param);

        return response()->success($result);
    }

}