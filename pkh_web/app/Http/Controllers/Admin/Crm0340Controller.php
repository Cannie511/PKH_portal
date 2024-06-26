<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0340Service;
use App\Services\SalesmanService;

/**
 * Crm0340Controller
 */
class Crm0340Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0340Service;
    /**
     * @var mixed
     */
    private $areaService;
    /**
     * @var mixed
     */
    private $salesmanService;

    /**
     * @param Crm0340Service $crm0340Service
     * @param AreaService $areaService
     * @param SalesmanService $salesmanService
     */
    public function __construct(
        Crm0340Service $crm0340Service,
        AreaService $areaService,
        SalesmanService $salesmanService
    ) {
        $this->crm0340Service  = $crm0340Service;
        $this->areaService     = $areaService;
        $this->salesmanService = $salesmanService;
        $this->middleware('permission:screen.crm0340');
    }

    public function postLoad()
    {
        $result             = [];
        $result["areaList"] = $this->crm0340Service->selectListArea();

        $result["userList"] = $this->salesmanService->selectDropdown();

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAssign(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $listResult = $this->crm0340Service->assignStore2User($param, $user);

        return response()->success($listResult);
    }

    /**
     * @param Request $request
     */
    public function postMerge(Request $request)
    {
        $param = $request->all();

        $listResult = $this->crm0340Service->mergeStore($param);

        return response()->success($listResult);
    }

}
