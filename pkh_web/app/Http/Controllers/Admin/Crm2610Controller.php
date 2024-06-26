<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2610Service;
use App\Services\ProductService;
use App\Services\DownloadService;

/**
 * Crm2610Controller
 */
class Crm2610Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2610Service;

    /**
     * @param Crm2610Service $crm2610Service
     * @param DownloadService $downloadService
     * @param ProductService $productService
     */
    public function __construct(
        Crm2610Service $crm2610Service,
        DownloadService $downloadService,
        ProductService $productService
    ) {
        $this->crm2610Service  = $crm2610Service;
        $this->downloadService = $downloadService;
        $this->productService  = $productService;
        // $this->middleware('permission:screen.crm2610');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param        = $request->all();
        $products     = $this->crm2610Service->selectProductListForOrder($param);
        $soldProducts = $this->crm2610Service->selectSoldProduct($param);

        $result = [
            'products'     => $products,
            'soldProducts' => $soldProducts,
        ];

        return response()->success($result);
    }

}
