<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm1310Service;
use App\Services\Crm1610Service;
use App\Services\Crm1630Service;
use App\Services\DownloadService;
use App\Services\WarehouseService;

/**
 * Crm1610Controller
 */
class Crm1610Controller extends AdminBaseController
{
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
     * @param Crm1310Service $crm1310Service
     * @param Crm1630Service $crm1630Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm1610Service $crm1610Service,
        Crm1310Service $crm1310Service,
        Crm1630Service $crm1630Service,
        DownloadService $downloadService,
        WarehouseService $warehouseService
    ) {
        $this->crm1610Service   = $crm1610Service;
        $this->crm1630Service   = $crm1630Service;
        $this->crm1310Service   = $crm1310Service;
        $this->downloadService  = $downloadService;
        $this->warehouseService = $warehouseService;
        $this->middleware('permission:screen.crm1610');
    }

    /**
     * @param $supplierDeliveryId
     * @param $deliveryDetail
     * @param $supplierOrderId
     * @param $orderDetail
     * @return mixed
     */
    public function chooseDetail(
        $supplierDeliveryId,
        $deliveryDetail,
        $supplierOrderId,
        $orderDetail
    ) {

        if ($supplierDeliveryId > 0 && $supplierOrderId > 0) {

            foreach ($deliveryDetail as $dDetail) {
                $amountExport      = 0;
                $dDetail->duty_tax = intval($dDetail->duty_tax);

                foreach ($orderDetail as $oDetail) {

                    if ($oDetail->product_id == $dDetail->product_id) {
                        $amountExport = $oDetail->amount;
                        break;
                    }

                }

                $dDetail->amountOrder = $amountExport;
            }

            return $deliveryDetail;
        } elseif (0 == $supplierDeliveryId && $supplierOrderId > 0) {

            foreach ($orderDetail as $oDetail) {
                $oDetail->amountOrder = $oDetail->amount;
                $oDetail->duty_tax    = 0;
            }

            return $orderDetail;
        }

    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $supplierDeliveryId = intVal($request->get('supplier_delivery_id', 0));
        $supplierOrderId    = intVal($request->get('supplier_order_id', 0));
        $warehouseList      = $this->warehouseService->selectWarehouseList();

        $deliveryDetail = [];
        $supplier       = [];
        $delivery       = [];

        if ($supplierDeliveryId > 0) {
            $deliveryDetail = $this->crm1610Service->selectDeliveryDetail($supplierDeliveryId);
            $supplier       = $this->crm1610Service->selectExactSupplier($supplierDeliveryId);
            $delivery       = $this->crm1610Service->selectDelivery($supplierDeliveryId);
        }

        if ($supplierOrderId > 0) {
            $orderDetail = $this->crm1310Service->selectOrderDetail($supplierOrderId);
            $supplier    = $this->crm1310Service->selectExactSupplier($supplierOrderId);
            $order       = $this->crm1310Service->selectOrder($supplierOrderId);
        }

        $listSupplier = $this->crm1310Service->selectSupplier();
        //Log::debug('----------------------------load init');

        $detail = $this->chooseDetail($supplierDeliveryId, $deliveryDetail, $supplierOrderId, $orderDetail);
        //Log::debug($detail);
        $result = [
            'deliveryDetail' => $detail,
            'listSupplier'   => $listSupplier,
            'supplier'       => $supplier,
            'delivery'       => $delivery,
            'warehouseList'  => $warehouseList,
        ];
        //Log::debug($result);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearchProduct(Request $request)
    {
        // Load product list
        $productList = $this->crm1310Service->selectProductListForOrder($request->all());

        $result = [
            'list' => $productList,
        ];

        return response()->success($result);
    }

    /**
     * @param $color
     * @return mixed
     */
    public function engSub($color)
    {

        if ("Trắng" == $color) {
            return "White";
        }

        if ("trắng" == $color) {
            return "White";
        }

        if ("Trắng + Mạ bạc" == $color) {
            return "White chrome";
        }

        if ("Trắng + Chrome" == $color) {
            return "White chrome";
        }

        if ("Mạ bạc" == $color) {
            return "Chrome";
        }

        if ("Mạ Bạc" == $color) {
            return "Chrome";
        }

        if ("Mạ TIC" == $color) {
            return "Titanium chrome";
        }

        if ("Kem" == $color) {
            return "Ivory";
        }

        if ("Xanh Dương" == $color) {
            return "Blue";
        }

        if ("Xanh Lá" == $color) {
            return "Green";
        }

        if ("Trắng + Kem" == $color) {
            return "White ivory";
        }

        if ("Trắng + Xám" == $color) {
            return "White grey";
        }

        return $color;
    }

    /**
     * @param Request $request
     */
    public function postPrintCheck(Request $request)
    {
        $param              = $request->all();
        $supplierDeliveryId = $param['supplier_delivery_id'];
        $form               = $this->crm1610Service->selectDelivery($supplierDeliveryId);

        $today = Carbon::now();
        $day   = $this->crm1610Service->getDay($today);
        $month = $this->crm1610Service->getMonth($today);
        $year  = $this->crm1610Service->getYear($today);
        $mark  = $this->crm1610Service->getMark($today);

        if (null == $supplierDeliveryId) {
            return null;
        }

        $deliveryDetail = $this->crm1610Service->selectDeliveryDetail($supplierDeliveryId);

        foreach ($deliveryDetail as $item) {
            $item->color = $this->engSub($item->color);
        }

        //Log::debug($form);
        $data = [
            'orders'       => $deliveryDetail,
            'form'         => $form,
            'day'          => $day,
            'month'        => $month,
            'year'         => $year,
            'mark'         => $mark,
            'payment_desc' => $param['payment_desc'],
        ];

        /*$pdf = PDF::loadView('admin.pdfs.crm1610-check', $data);

        $pdfName = 'SaleContract' . "_" . uniqid(true) . ".pdf";

        // Create path if not exist
        $path = storage_path('app/pdf/check_order/');
        if(!File::exists($path)) {
        File::makeDirectory($path, 0755, true, true);
        }

        // Save file
        $pdf->save($path . $pdfName);

        $result = [
        'url' => '/pdf/check_order/' . $pdfName,
        'rtnCd' => true
        ];*/
        $paramDownload = [
            "data"        => $data,
            "file_name"   => "SaleContract",
            "folder_name" => "check_order",
            "view"        => "crm1610-check",
            "type"        => 1,
            "paper"       => 'a4',
        ];
        $result = $this->downloadService->downloadPDFFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postConfirm(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $doThis = $this->crm1610Service->confirmStatus($user, $param);

        if (5 == $param['index']) {
            $this->crm1630Service->createImportForFac($user, $param['form']);
        }

        $result = [
            'rtnCd'    => 'OK',
            'instance' => $doThis,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postExpectedDate(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $doThis = $this->crm1610Service->saveExpectedDate($user, $param);

        $result = [
            'rtnCd'    => 'OK',
            'instance' => $doThis,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postActualDate(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();

        $doThis = $this->crm1610Service->saveActualDate($user, $param);

        $result = [
            'rtnCd' => 'OK',

        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @return null
     */
    public function postSave(Request $request)
    {
        $param = $request->all();

//$storeOrderId = $param["order"]["store_order_id"];
        if (!isset($param['supplier_order_id']) || null == $param['supplier_order_id']) {
            return;
        }

        $user = Auth::user();
        // Save order
        $supplierDelivery = $this->crm1610Service->createSupplierDelivery($user, $param);

        $result = [
            'rtnCd'            => 'OK',
            'supplierDelivery' => $supplierDelivery,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownloadWarehouse(Request $request)
    {
        $param = $request->all();
        //$result = $this->crm1610Service->downloadWarehouse($param);
        $data          = $this->crm1610Service->selectDeliveryDetail($param['supplier_delivery_id']);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "warehouse",
            "view"      => "crm1610-warehouse",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownloadAdmin(Request $request)
    {
        $param = $request->all();
        //$result = $this->crm1610Service->downloadAdmin($param);
        $data          = $this->crm1610Service->selectDeliveryDetail($param['supplier_delivery_id']);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "admin",
            "view"      => "crm1610-admin",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

}
