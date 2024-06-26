<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\Crm0100Service;
use App\Services\ProductService;
use App\Services\DownloadService;
use App\Services\SupplierService;
/**
 * Crm0110Controller
 * Danh muc san pham
 */
class Crm0100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0100Service;
    /**
     * @var mixed
     */
    protected $productService;
/**
     * @var mixed
     */
    protected $supplierService;
    /**
     * @param Crm0100Service $crm0100Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0100Service $crm0100Service,
        DownloadService $downloadService,
        ProductService $productService,
        SupplierService $supplierService
    ) {
        $this->crm0100Service  = $crm0100Service;
        $this->downloadService = $downloadService;
        $this->productService  = $productService;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm0100');
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postLoadInit(Request $request)
    {
        $param       = $request->all();
        $catList     = $this->productService->selectListProductCat2();
        $handleList  = $this->productService->selectListProductCat1();
        $colorList   = $this->productService->getColorList();
        $packingList = $this->productService->getPackingList();
        $supplierList  = $this->supplierService->selectSupplierDropDown();
        $result = [
            'catList'     => $catList,
            'colorList'   => $colorList,
            'packingList' => $packingList,
            'handleList'  => $handleList,
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm0100Service->selectListProduct($param);

        return response()->success(["data" => $list]);
    }

    /**
     * @param Request $request
     */
    public function postUpdatePrice(Request $request)
    {
        $this->requirePermission('screen.crm0100.update_price');

        $this->validate($request, [
            'import_price'       => 'required|numeric|min:0',
            'selling_price'        => 'required|numeric|min:0',
           
        ]);

        $param  = $request->all();
        $result = $this->crm0100Service->updatePrice($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        $this->requirePermission('screen.crm0100.download');

        $param = $request->all();
        //$result = $this->crm0100Service->download();
        $param = [
            'download' => 1,
        ];
        $data          = $this->crm0100Service->selectListProduct($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "ProductList",
            "view"      => "crm0100-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postPriority(Request $request)
    {
        $result = $this->crm0100Service->makePriority();

        return response()->success($result);
    }

}
