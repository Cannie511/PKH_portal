<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\AreaService;

/**
 * AreaController
 */
class AreaController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $areaService;

    /**
     * @param AreaService $areaService
     */
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $param  = $request->all();
        $result = $this->areaService->selectList($param);

        return response()->success($result);
    }

}
