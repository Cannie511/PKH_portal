<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\StatusService;
use App\Services\Crm2300Service;
use App\Services\WarehouseService;

/**
 * Crm2300Controller
 */
class Crm2300Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2300Service;
    /**
     * @var mixed
     */
    protected $warehouseService;
    /**
     * @var mixed
     */
    protected $statusService;
    const EXIM_STATUS_TYPE = 3;

    /**
     * @param Crm2300Service $crm2300Service
     */
    public function __construct(
        Crm2300Service $crm2300Service
        ,
        WarehouseService $warehouseService
        ,
        StatusService $statusService
    ) {
        $this->crm2300Service   = $crm2300Service;
        $this->warehouseService = $warehouseService;
        $this->statusService    = $statusService;

        //$this->middleware( 'permission:screen.crm2300' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        if (1 == $param['index']) {
            $data = $this->crm2300Service->selectEximList($param);
        } else {
            // $data = $this->crm2300Service->selectImportList($param);
        }

        return response()->success($data);
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param          = $request->all();
        $warehouseList  = $this->warehouseService->selectWarehouseList();
        $eximStatusList = $this->statusService->getWarehouseEximStatus(SELF::EXIM_STATUS_TYPE);
        $result         = [
            'warehouseList'  => $warehouseList,
            'eximStatusList' => $eximStatusList,
        ];

        return response()->success($result);
    }

}
