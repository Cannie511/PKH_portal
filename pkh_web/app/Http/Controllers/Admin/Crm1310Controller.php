<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\Crm1310Service;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\SupplierService;

/**
 * Crm1310Controller
 */
class Crm1310Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1310Service;
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
     * @param Crm1310Service $crm1310Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        OrderService $orderService,
        ProductService $productService,
        Crm1310Service $crm1310Service,
        DownloadService $downloadService,
        SupplierService $supplierService
    ) {
        $this->crm1310Service  = $crm1310Service;
        $this->productService  = $productService;
        $this->orderService    = $orderService;
        $this->downloadService = $downloadService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm1310');
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
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();

        $user = Auth::user();
        // Save order
        $supplierOrderId = $this->crm1310Service->createSupplierOrder($user, $param);

        $result = [
            'rtnCd'           => 'OK',
            'supplierOrderId' => $supplierOrderId,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $supplierOrderId = intVal($request->get('supplier_order_id', 0));
        $supplier_id     = intVal($request->get('supplier_id', 0));
        $orderDetail     = [];
        $supplier        = [];
        $order           = [];

      
        if ($supplierOrderId > 0) {
            $orderDetail = $this->crm1310Service->selectOrderDetail($supplierOrderId);
           // $supplier  = $this->crm1310Service->selectExactSupplier($supplierOrderId);
            $order       = $this->crm1310Service->selectOrder($supplierOrderId);
        }
       
        $supplier     = $this->crm1310Service->selectExactSupplier($supplier_id);
        $listSupplier = $this->crm1310Service->selectSupplier();
        //Log::debug('----------------------------load init');

        $result = [
            'orderDetail'  => $orderDetail,
            'order'        => $order,
            'listSupplier' => $listSupplier,
            'supplier'     => $supplier,
     
        ];
        //Log::debug($result);

        return response()->success($result);
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

        $today       = $this->crm1310Service->updateSendPoDate($user, $supplierOrderId);
        $orderDetail = $this->crm1310Service->selectOrderDetail($supplierOrderId);

        foreach ($orderDetail as $item) {
            $item->color = $this->engSub($item->color);
        }

//Log::debug('-------------------pdf print-----------');
        //Log::debug($orderDetail);
        $data = [
            'orders' => $orderDetail,
        ];

        /*$pdf = PDF::loadView('admin.pdfs.crm1310-check', $data);

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
            "view"        => "crm1310-check",
            "type"        => 1,
            "paper"       => 'a4',
        ];
        $result                 = $this->downloadService->downloadPDFFile($paramDownload);
        $result["send_po_date"] = $today;

        return response()->success($result);
    }

}
