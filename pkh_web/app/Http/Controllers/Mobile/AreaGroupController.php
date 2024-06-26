<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\AreaGroupService;

/**
 * AreaGroupController
 */
class AreaGroupController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $areaGroupService;

    /**
     * @param AreaGroupService $areaGroupService
     */
    public function __construct(AreaGroupService $areaGroupService)
    {
        $this->areaGroupService = $areaGroupService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $param  = $request->all();
        $result = $this->areaGroupService->selectList($param);

        return response()->success($result);
    }

}
