<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\Crm0140Service;
use App\Services\DownloadService;
use App\Services\FuncConfService;
use App\Services\SupplierService;

/**
 * Crm0140Controller
 */
class Crm0140Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0140Service;
    /**
     * @var mixed
     */
    protected $downloadService;

// public function __construct(Crm0140Service $crm0140Service){

//     $this->crm0140Service = $crm0140Service;

//     //$this->middleware( 'permission:screen.crm0140' );

// }

    /**
     * @var mixed
     */
    protected $funcConfService;

    /**
     * @param FuncConfService $funcConfService
     * @param Crm0140Service $crm0140Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        FuncConfService $funcConfService,
        Crm0140Service $crm0140Service,
        DownloadService $downloadService,
        SupplierService $supplierService
    ) {
        $this->funcConfService = $funcConfService;
        $this->crm0140Service  = $crm0140Service;
        $this->downloadService = $downloadService;
        $this->supplierService = $supplierService;
    }

    public function postLoadInit() {
        $listSupplier = $this->supplierService->selectSupplierDropDown();
        return response()->success(['listSupplier' => $listSupplier]);
    }

    public function postLoad(Request $request)
    {
        $param        = $request->all();;

        $supplier_id = isset($param['supplier_id'])? $param['supplier_id'] : 1;
        $key = FuncConfService::CRM_PRICE_LIST . "_" . $supplier_id;
        $crmPriceList = $this->funcConfService->selectByKey($key, 'txt_val');

        $listPrice = $this->crm0140Service->selectListPrice($crmPriceList);

        foreach ($listPrice['product'] as $item) {
            //$code = $item->supplier_id == 1 ? substr($item->product_code, 0, 6) : $item->product_code;
            $code = substr($item->product_code, 0, 6);
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
            Log::debug(print_r($item->imgUrl, true));
        }

        $result = [
            'crm_price_list' => $crmPriceList,
            'listPrice'      => $listPrice,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postSave(Request $request)
    {
        $crmPriceList = "";
        $param        = $request->all();

        if (isset($param['crm_price_list'])) {
            $crmPriceList = $param['crm_price_list'];
        }

        $supplier_id = isset($param['supplier_id'])? $param['supplier_id'] : 1;
        $key = FuncConfService::CRM_PRICE_LIST . "_" . $supplier_id;
        $this->funcConfService->updateByKey($key, $crmPriceList, 'txt_val');

        $result = [
            'crm_price_list' => $crmPriceList,
        ];

        return $this->postLoad($request);
    }

    /**
     * @param Request $request
     */
    public function postPrint(Request $request)
    {
        $listPrice = $request->all();

        ini_set('max_execution_time', 300);

// 0: 'landscape'
        // 1: 'portrait'
        $type = 0;

        if (0 == $request['dir']) {
            $type = 1;
        }

        $data = $listPrice;

        if (0 == $type) {
            $view = "crm0140-export";
        } else {
            $view = "crm0140-export-portrait";
        }

        $paramDownload = [
            "data"        => $data,
            "file_name"   => "Price_list",
            "folder_name" => "price_list",
            "view"        => $view,
            "type"        => $type, // 0: 'landscape', 1: 'portrait'
            "paper"       => 'a4',
        ];
        $result = $this->downloadService->downloadPDFFile($paramDownload);
        /*$pdf = null;
        if( $type == 'landscape' ) {
        $pdf = PDF::loadView('admin.pdfs.crm0140-export', $listPrice)
        ->setPaper('a4', 'landscape');
        } else {
        $pdf = PDF::loadView('admin.pdfs.crm0140-export-portrait', $listPrice)
        ->setPaper('a4', 'portrait');
        }

        $pdfName = "Price_list_" . uniqid(true) . ".pdf";

        // Create path if not exist
        $path = storage_path('app/pdf/price_list/');
        if(!File::exists($path)) {
        File::makeDirectory($path, 0755, true, true);
        }

        // Save file
        $pdf->save($path . $pdfName);

        $result = [
        'url' => '/pdf/price_list/' . $pdfName,
        'rtnCd' => true
        ];*/

        return response()->success($result);
    }

}
