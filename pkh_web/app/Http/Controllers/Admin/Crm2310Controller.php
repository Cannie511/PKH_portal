<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\StatusService;
use App\Services\Crm2310Service;
use App\Services\ProductService;
use App\Services\WarehouseService;
use App\Services\Request\RequestFactoryService;

/**
 * Crm2310Controller
 */
class Crm2310Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2310Service;
    /**
     * @var mixed
     */
    protected $warehouseService;

    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $statusService;

    /**
     * @var mixed
     */
    protected $requestService;
    const EXIM_STATUS_TYPE = 3;
    const REQUEST_TYPE     = 7;

    /**
     * @param Crm2310Service $crm2310Service
     */
    public function __construct(Crm2310Service $crm2310Service
        ,
        WarehouseService $warehouseService
        ,
        ProductService $productService
        ,
        StatusService $statusService
        ,
        RequestFactoryService $requestService
    ) {
        $this->crm2310Service   = $crm2310Service;
        $this->warehouseService = $warehouseService;
        $this->productService   = $productService;
        $this->statusService    = $statusService;

        $this->request = $requestService->createRequest(SELF::REQUEST_TYPE);
        //$this->middleware( 'permission:screen.crm2310' );
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param         = $request->all();
        $warehouseList = $this->warehouseService->selectWarehouseList();
        // $productList        = $this->productService->selectProductListForOrder(array());
        $warehouse       = null;
        $warehouseDetail = [];
        $requestList     = [];

        if (isset($param['warehouse_exim_id'])) {
            $warehouse       = $this->crm2310Service->selectOneExim($param);
            $requestList     = $this->request->loadRequest($param['warehouse_exim_id']);
            $warehouseDetail = $this->crm2310Service->selectEximDetail($param);
        }

        $eximStatusList = $this->statusService->getWarehouseEximStatus(SELF::EXIM_STATUS_TYPE);

        if (!$warehouse) {
            $warehouse = [
                ['notes' => ''],
            ];
            $warehouseDetail = [];
        }

// Log::debug('-----check warehouse-------');

// Log::debug($warehouse);
        // Log::debug($param);
        $result = [
            'warehouseList'   => $warehouseList,
            // 'productList'        => $productList,
            'warehouse'       => $warehouse,
            'warehouseDetail' => $warehouseDetail,
            'eximStatusList'  => $eximStatusList,
            'requestList'     => $requestList,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        // Save Export
        $entity            = $this->crm2310Service->saveExim($param, $user);
        $warehouse_exim_id = $entity['warehouse_exim_id'];
        $result            = [
            'warehouse_exim_id' => $warehouse_exim_id,
            'rtnCd'             => 'OK',
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     * Add to trn_warehouse_change the amounts of products in trn_warehouse_exim_detail with specific warehouse_exim_id
     * Set their warehouse_change_type = 8 - xuất sang kho khác
     * Change exim_sts to 1
     */
    public function postCreateExport(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        // Save Export in trn warehouse change
        $flag         = 1;
        $warehouse_id = $param['from_warehouse_id'];
        $type         = 8;
        $ref_id       = $param['warehouse_exim_id'];
        $this->warehouseService->saveDataInWarehouseChange($flag, $user, $param, $type, $warehouse_id, $ref_id);

        // Update exim_sts
        $this->crm2310Service->updateStatusToExport($user, $param);

        $result = [
            'rtnCd' => 'OK',
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     * Add to trn_warehouse_change the amounts of products in trn_warehouse_exim_detail with specific warehouse_exim_id
     * Set their warehouse_change_type = 7 - nhập từ kho khác
     * Change exim_sts to 2
     */
    public function postCreateImport(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        // Save Export in trn warehouse change
        $flag         = 1;
        $warehouse_id = $param['to_warehouse_id'];
        $type         = 7;
        $ref_id       = $param['warehouse_exim_id'];
        $this->warehouseService->saveDataInWarehouseChange($flag, $user, $param, $type, $warehouse_id, $ref_id);

        // Update exim_sts
        $this->crm2310Service->updateStatusToImport($user, $param);

        $result = [
            'rtnCd' => 'OK',
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postRequestCancel(Request $request)
    {
        //$result = $this->crm0210Service->requestCancel($request->all());
        $param = $request->all();

        $result = $this->request->createRequest(SELF::REQUEST_TYPE, $param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        //$result = $this->crm0210Service->accept($request->all());
        $param = $request->all();

        $result = $this->request->acceptRequest($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        //$result = $this->crm0210Service->deny($request->all());
        $param = $request->all();

        $result = $this->request->denyRequest($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm2310Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm2310Service->loadImages($param);
        // Log::info("list image:",$result);

        return response()->success($result);
    }

}
