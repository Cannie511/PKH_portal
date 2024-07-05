<?php

namespace App\Http\Controllers\Admin;

use App\Services\Crm3010Service;
use Auth;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\Crm0210Service;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\SupplierService;
use App\Services\Crm0710Service;

/**
 * Crm0210Controller
 */
class Crm0210Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0210Service;
    private $crm3010Service;
    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $orderService;
    /**
     * @var mixed
     */
    protected $downloadService;

    /**
     * @param OrderService $orderService
     * @param ProductService $productService
     * @param Crm0210Service $crm0210Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        OrderService $orderService,
        ProductService $productService,
        Crm0210Service $crm0210Service,
        DownloadService $downloadService,
        SupplierService $supplierService,
        Crm3010Service $crm3010Service
    ) {
        $this->crm0210Service  = $crm0210Service;
        $this->crm3010Service  = $crm3010Service;
        $this->productService  = $productService;
        $this->orderService    = $orderService;
        $this->downloadService = $downloadService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0210');
    }

    /**
     * @param Request $request
     */
    public function postSearchProduct(Request $request)
    {
        $param = $request->all();
        // Load product list
        //$productList = $this->crm0210Service->selectProductListForOrder($request->all());
        $productNotBuy = $this->crm3010Service->getProductNotBuy($param);
        $result = [
            //'list' => $productList,
            'list_not_buy'=> $productNotBuy
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();

        $user = Auth::user();
        // Save order
        $supplierOrderId = $this->crm0210Service->createSupplierOrder($user, $param);
        $cpayment = $this->crm0210Service->savePayment($user, $param);
       
        $result = [
            'rtnCd'           => 'OK',
            'supplierOrderId' => $supplierOrderId,
            'cpayment'        => $cpayment,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $storeOrderId = intVal($request->get('store_order_id', 0));
        $store_id     = intVal($request->get('store_id', 0));

        $orderDetail     = [];
        $store           = [];
        $order           = [];

      
        if ($storeOrderId > 0) {
            $orderDetail = $this->crm0210Service->selectOrderDetail($storeOrderId);
           // $supplier  = $this->crm0210Service->selectExactSupplier($supplierOrderId);
            $order       = $this->crm0210Service->selectOrder($storeOrderId);

            
        }
        $store     = $this->crm0210Service->selectExactSupplier($store_id);
        
        //Log::debug('----------------------------load init');

        $result = [
            'orderDetail'  => $orderDetail,
           
            'store'     => $store,
            'order'        => $order,
        ];
        //Log::debug($result);

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
        $user            = Auth::user();
        $supplierOrderId = $request->get('supplier_order_id');

        if (null == $supplierOrderId) {
            return null;
        }

        $today       = $this->crm0210Service->updateSendPoDate($user, $supplierOrderId);
        $orderDetail = $this->crm0210Service->selectOrderDetail($supplierOrderId);

        foreach ($orderDetail as $item) {
            $item->color = $this->engSub($item->color);
        }

//Log::debug('-------------------pdf print-----------');
        //Log::debug($orderDetail);
        $data = [
            'orders' => $orderDetail,
        ];

        /*$pdf = PDF::loadView('admin.pdfs.crm0210-check', $data);

        $pdfName = 'ahihi' . "_" . uniqid(true) . ".pdf";

        // Create path if not exist
        $path = storage_path('app/pdf/check_order/');
        if(!File::exists($path)) {
        File::makeDirectory($path, 0755, true, true);
        }

        // Save file
        $pdf->save($path . $pdfName);

        $result = [
        'url' => '/pdf/check_order/' . $pdfName,
        'rtnCd' => true,
        'send_po_date' => $today
        ];*/
        $paramDownload = [
            "data"        => $data,
            "file_name"   => "PO",
            "folder_name" => "check_order",
            "view"        => "crm0210-check",
            "type"        => 1,
            "paper"       => 'a4',
        ];
        $result                 = $this->downloadService->downloadPDFFile($paramDownload);
        $result["send_po_date"] = $today;

        return response()->success($result);
    }

}
