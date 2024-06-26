<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm0810Service;
use App\Services\Crm0913Service;
use App\Services\ProductService;
use App\Services\WarehouseService;
use App\Services\SupplierService;

class Crm0913Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0913Service;
    /**
     * @var mixed
     */
    private $crm0810Service;
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
    protected $supplierService;
    /**
     * @param Crm0913Service $crm0913Service
     */
    public function __construct(Crm0913Service $crm0913Service
        ,
        Crm0810Service $crm0810Service
        ,
        WarehouseService $warehouseService
        ,
        ProductService $productService,
        SupplierService $supplierService) {
        $this->crm0913Service   = $crm0913Service;
        $this->crm0810Service   = $crm0810Service;
        $this->warehouseService = $warehouseService;
        $this->productService   = $productService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0913');
    }

    /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param          = $request->all();
        $warehouseList  = $this->warehouseService->selectWarehouseList();
        $catList        = $this->productService->selectListCatForWeb();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $warehouseCheck = [];

        if (isset($param['check_warehouse_id'])) {
            $warehouseCheck = $this->crm0810Service->loadCheckWareHouse($param['check_warehouse_id']);
        }

        $result = [
            'warehouseList'  => $warehouseList,
            'catList'        => $catList,
            'warehouseCheck' => $warehouseCheck,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        Log::debug('param-----');
        Log::debug($param);
        $data1 = $this->warehouseService->selectList($param, $param['check_date'], $param['check_date'], $param['check_date']);

        $data2 = [];

        if (isset($param['warehouse_id'])) {
            $data2 = $this->crm0913Service->selectListProduct($param['check_date'], $param['warehouse_id']);
        }

        $is_check = (null != $data2);

        if ($is_check) {
            Log::debug("co notes");
        } else {
            Log::debug("Khong co notes");
        }

        $data = $this->crm0913Service->getList($data1, $data2);
        Log::debug('check data ----------');
        Log::debug($data1);
        // Log::debug($data);
        $result = [
            'data'     => $data,
            'is_check' => $is_check,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();

        $data = $this->crm0913Service->updateNotes($param);

        $result = [
            'rtnCd' => 'OK',
            'data'  => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param $date
     */
    private function valid_confirm(
        $warehouse_id,
        $date
    ) {
        $checking_record = $this->crm0913Service->countNumberOfCheckingAtDate($warehouse_id, $date);
        $stat            = true;
        $msg             = '';

        if (count($checking_record) == 0) {
            $stat = false;
            $msg  = "Don't exist a checking warehouse data of this warehouse at this time";
        } elseif (count($checking_record) >= 2) {
            $stat = false;
            $msg  = "there exists more than 2 checking warehouse data of a warehouse at this time";
        } elseif (count($checking_record) == 1) {

            if ('1' == $checking_record[0]->checking_sts) {
                $stat = false;
                $msg  = "This checking warehouse data of this warehouse has been confirmed";
            } elseif ('5' == $checking_record[0]->checking_sts) {
                $stat = false;
                $msg  = "This checking warehouse data of this warehouse has been deleted";
            }

        }

        return [
            'sts' => $stat,
            'msg' => $msg,
        ];
    }

    /**
     * @param Request $request
     */
    public function postConfirmWarehouse(Request $request)
    {

        $param = $request->all();
        $this->requirePermission('screen.crm0913.confirm');

        if (!isset($param['check_warehouse_id'])) {
            return [
                'status' => false,
                'num'    => 0,
                'msg'    => "check warehouse id không hợp lệ",
            ];
        }

        if (!isset($param['warehouse_id'])) {
            return [
                'status' => false,
                'num'    => 0,
                'msg'    => "warehouse id không hợp lệ",
            ];
        }

        $check_date     = $param['check_date'];
        $date           = Carbon::createFromFormat('Y-m-d', $check_date);
        $msg            = '';
        $first_checking = $this->valid_confirm($param['warehouse_id'], $date);

// Log::debug($first_checking);
        if (!$first_checking["sts"]) {
            $result = [
                'status' => false,
                'num'    => 0,
                'msg'    => $first_checking["msg"],
            ];

            return response()->success($result);
        }

        //Đếm có sự thay đổi nào từ giai đoạn này trở về sau không vì nếu có thay đổi ở giai đoạn sau sẽ làm double và lệch dữ liệu
        $dataChange  = $this->crm0913Service->countChangeAfterThisDate($param['warehouse_id'], $date);
        $countChange = $dataChange[0]->count;
        $oke         = false;
        $count       = 0;

        if (0 == $countChange) {
            // $data1 = $this->crm0913Service->selectList($param['check_date']);
            $data1 = $this->warehouseService->selectList($param, $param['check_date'], $param['check_date'], $param['check_date']);
            // $data2 = $this->crm0913Service->selectListProduct($param['check_date']);
            $data2 = [];

            if (isset($param['warehouse_id'])) {
                $data2 = $this->crm0913Service->selectListProduct($param['check_date'], $param['warehouse_id']);
            }

            $data = $this->crm0913Service->getList($data1, $data2);

// in_edit : + : 3

// out_edit: - : 4
            foreach ($data as $item) {
                if (isset($item->differrence)) {

                    $oke   = true;
                    $value = -$item->differrence;
                    $this->crm0913Service->createEditChangeForWareHouse($param['warehouse_id'], $value, $item->product_id, $date);
                    $count++;
                } else {
                }

            }

            // Update status for the checking warehouse record with this date to show it has been confirmed
            $this->crm0913Service->updateStatusForCheckWarehouse($param['warehouse_id'], $date);
        } else {
            $oke = false;
            $msg = "There is some checking warehouse data after this time has been confirmed";
        }

        // oke = false khi có sự thay đổi giai đoạn sau hoặc tại thời điểm không kiểm kho
        $result = [
            'status' => $oke,
            'num'    => $count,
            "msg"    => $msg,
        ];

        return response()->success($result);
    }

}
