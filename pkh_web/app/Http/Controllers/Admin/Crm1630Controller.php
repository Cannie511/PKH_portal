<?php
namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\Crm1610Service;
use App\Services\Crm1630Service;
use App\Services\ProductService;
use App\Services\WarehouseService;

/**
 * Crm1630Controller
 */
class Crm1630Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1630Service;
    /**
     * @var mixed
     */
    private $productService;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @var mixed
     */
    private $crm1610Service;

    /**
     * @var mixed
     */
    protected $warehouseService;

    /**
     * @param Crm1610Service $crm1610Service
     * @param Crm1630Service $crm1630Service
     * @param ProductService $productService
     * @param StoreService $storeService
     */
    public function __construct(
        Crm1610Service $crm1610Service,
        Crm1630Service $crm1630Service,
        ProductService $productService,
        StoreService $storeService,
        WarehouseService $warehouseService
    ) {
        $this->crm1610Service   = $crm1610Service;
        $this->crm1630Service   = $crm1630Service;
        $this->productService   = $productService;
        $this->storeService     = $storeService;
        $this->warehouseService = $warehouseService;
        $this->middleware('permission:screen.crm1630');
    }

    /**
     * Search product
     *
     * @return JSON
     */
    public function postSearchProduct(Request $request)
    {
        // Load product list
        $productList = $this->productService->selectProductListForOrder($request->all());

        $result = [
            'list' => $productList,
        ];

        return response()->success($result);
    }

    /**
     * @param $supplierDeliveryId
     * @param $deliveryDetail
     * @param $importWhFac
     * @param $requestList
     * @return mixed
     */
    public function chooseDetail(
        $supplierDeliveryId,
        $deliveryDetail,
        $importWhFac,
        $requestList
    ) {

        if ($supplierDeliveryId > 0) {

            if (0 == $importWhFac->active_flg) {
                // Lúc chưa nhập kho ảo thì lấy giá trị init bên json note

                $deliveryDetail = $this->decodeAmountImport($deliveryDetail, $requestList);

                return $deliveryDetail;
            } else {
                // Lúc nhập rồi thì lấy dữ liệu ở warehouse change
                $warehouseChangeDetail = $this->crm1630Service->selectWarehouseChange($importWhFac->import_wh_factory_id);

                foreach ($warehouseChangeDetail as $item) {

                    foreach ($deliveryDetail as $oDetail) {

                        if ($item->product_id == $oDetail->product_id) {
                            $item->amountImport = $item->amount;
                            $item->amount       = $oDetail->amount;
                        }

                    }

                }

                return $warehouseChangeDetail;
            }

        }

        return null;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadInitCase1(Request $request)
    {
        $importWhFacId = intVal($request->get('import_wh_factory_id', 0));

        if ($importWhFacId <= 0) {
            return;
        }

        $importWhFac = $this->crm1630Service->selectImportWhFac($importWhFacId);
        $supplier    = [
            'name'  => $importWhFac->name,
            'pi_no' => $importWhFac->pi_no,
        ];

        $flag           = 1;
        $requestList    = $this->crm1630Service->selectRequestList($importWhFacId, $flag);
        $deliveryDetail = $this->crm1610Service->selectDeliveryDetail($importWhFac->supplier_id);
        $importDetail   = $this->chooseDetail($importWhFac->supplier_id, $deliveryDetail, $importWhFac, $requestList);

        $result = [
            'importWhFac'  => $importWhFac,
            'importDetail' => $importDetail,
            'supplier'     => $supplier,
            'requestList'  => $requestList,
        ];

        return $result;
    }

    /**
     * @param Request $request
     */
    public function loadInitCase2(Request $request) {}

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadInitCase3(Request $request)
    {
        $storeId = intVal($request->get('store_id', 0));

        if ($storeId > 0) {
            $store = $this->storeService->selectStoreById($storeId);
        }

        $result = [
            'store' => $store,
        ];

        return $result;
    }

    /**
     * @param $importDetail
     * @param $requestList
     * @return mixed
     */
    private function decodeAmountImport(
        $importDetail,
        $requestList
    ) {
        // Chọn ra request pending hay accept;
        $str = "";

//Chose item has status pending
        foreach ($requestList as $item) {
            if (0 == $item->request_sts) {
                $str = $item->request_notes;
            }

        }

        $jsonData = (array) json_decode($str);
        foreach ($importDetail as $item1) {
            foreach ($jsonData as $item2) {
                if ($item1->product_id == $item2->id) {
                    $item1->amountImport = $item2->amount;
                }

            }

        }

        return $importDetail;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadInitCase4(Request $request)
    {
        $importWhStoreId = intVal($request->get('import_wh_store_id', 0));
        if ($importWhStoreId > 0) {
            $flag          = 2;
            $importWhStore = $this->crm1630Service->getTrnImportWhStore($importWhStoreId);
            $storeId       = $importWhStore->store_id;
            $importDetail  = $this->crm1630Service->getTrnImportWhStoreDetail($importWhStoreId);
            $requestList   = $this->crm1630Service->selectRequestList($importWhStoreId, $flag);
            $importDetail  = $this->decodeAmountImport($importDetail, $requestList);
        }

        if ($storeId > 0) {
            $store = $this->storeService->selectStoreById($storeId);
        }

        $result = [
            'store'         => $store,
            'importDetail'  => $importDetail,
            'importWhStore' => $importWhStore,
            'requestList'   => $requestList,
        ];

        return $result;
    }

    /**
     * @param Request $request
     * @return null
     */
    public function postLoadInit(Request $request)
    {
        $type = intVal($request->get('type', 0));
        if ($type <= 0 || $type > 4) {
            return;
        }

        $warehouseList = $this->warehouseService->selectWarehouseList();
        switch ($type) {
            case 1:
                $result = $this->loadInitCase1($request);
                break;
            case 3:
                $result = $this->loadInitCase3($request);
                break;
            case 4:
                $result = $this->loadInitCase4($request);
                break;
        }

        $result['warehouseList'] = $warehouseList;
        Log::debug($result);

        return response()->success($result);
    }

    /**
     * @param $param
     */
    public function checkImportFromFac($param)
    {
        if (isset($param['import_wh_factory_id']) && $param['import_wh_factory_id'] > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $param
     */
    public function checkImportFromStore($param)
    {
        if (!isset($param['import_type']) || !isset($param['store_id'])) {
            return false;
        }

        if ($param['import_type'] < 1 || $param['import_type'] > 2) {
            return false;
        }

        if (($param['store_id']) < 0) {
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        if ($this->checkImportFromStore($param)) {
            $data = $this->crm1630Service->createImportForStore($user, $param);
        }

        $result = [
            'rtnCd' => 'OK',
        ];

        return response()->success($result);
    }

/* import type
+  : Nhap hang nha may
+ 1: Bao hanh
+ 2: Tra lai
 */
    /**
     * @param Request $request
     */
    public function postRequestImport(Request $request)
    {
        $param = $request->all();

//Log::debug('param request -------');
        //Log::debug($param);

        $result = $this->crm1630Service->addRequestImport($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        $this->requirePermission('screen.crm1630.approve');

        $result = $this->crm1630Service->accept($request->all());

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        $this->requirePermission('screen.crm1630.deny');

        $result = $this->crm1630Service->deny($request->all());

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm1630Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm1630Service->loadImages($param);
        // Log::info("list image:",$result);

        return response()->success($result);
    }

}
