<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2710Service;
use App\Services\ProductService;
use App\Services\DownloadService;

/**
 * Crm2710Controller
 */
class Crm2710Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2710Service;
    /**
     * @var mixed
     */
    protected $productService;

    /**
     * @param Crm2710Service $crm2710Service
     * @param DownloadService $downloadService
     * @param ProductService $productService
     */
    public function __construct(
        Crm2710Service $crm2710Service,
        DownloadService $downloadService,
        ProductService $productService
    ) {
        $this->crm2710Service  = $crm2710Service;
        $this->downloadService = $downloadService;
        $this->productService  = $productService;
        $this->middleware('permission:screen.crm2710');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param = $request->all();
        // $data = $this->crm2710Service->selectList($param);
        $productList = $this->productService->selectProductListForOrder(array());

        $result = [
            'productList' => $productList,
        ];

        return response()->success($result);
    }

    // /**
    //  * Search
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSearch(Request $request) {
    //     $param = $request->all();
    //     $data = $this->crm2710Service->selectList($param);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    // /**
    //  * Sample action
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // public function postSample(Request $request) {
    //     $this->requirePermission('screen.crm2710.sample');

    //     $data = $this->crm2710Service->selectList($param);
    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

    /**
     * Download Excel
     *
     * @param Request $request
     * @return void
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.crm2710.download');
        $data = $request->all();
        // $param['export'] = true;
        // $data = $this->crm2710Service->selectList($param);
        // $paramDownload = [
        //     "data" => $data,
        //     "file_name" => "XuatNhapVatPham",
        //     "view" => "crm2710-qr"
        // ];
        $paramDownload = [
            "data"        => $data,
            "file_name"   => "qr",
            "folder_name" => "qr-code",
            "view"        => "crm2710-qr",
            "type"        => 1,
            "paper"       => 'a4',
        ];

        $result = $this->downloadService->downloadPDFFile($paramDownload);

        return response()->success($result);
    }

}
