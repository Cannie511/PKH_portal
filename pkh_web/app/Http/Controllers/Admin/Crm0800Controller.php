<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\Crm0800Service;
use App\Services\WarehouseService;
use App\Http\Controllers\Controller;

/**
 * Crm0800Controller
 */
class Crm0800Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0800Service;
    /**
     * @var mixed
     */
    protected $orderService;
    /**
     * @var mixed
     */
    protected $warehouseService;

    /**
     * @param Crm0800Service $crm0800Service
     * @param OrderService $orderService
     */
    public function __construct(
        Crm0800Service $crm0800Service
        ,
        OrderService $orderService
        ,
        WarehouseService $warehouseService
    ) {
        $this->crm0800Service   = $crm0800Service;
        $this->orderService     = $orderService;
        $this->warehouseService = $warehouseService;

        $this->middleware('permission:screen.crm0800');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm0800Service->selectList($param);
        // $branchList = $this->orderService->selectBranchList();
        $warehouseList = $this->warehouseService->selectWarehouseList();

        $result = [
            'list'          => $list,
            'warehouseList' => $warehouseList,
        ];

        return response()->success($result);
    }

//    public function postSample(Request $request) {
    //        $this->requirePermission('screen.crm0800.sample');
    //
    //        $data = $this->crm0800Service->selectList($param);
    //        $result = [
    //            'data' => $data
    //        ];
    //        return response()->success($result);
    //    }

}
