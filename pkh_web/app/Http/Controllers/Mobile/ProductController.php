<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\ProductService;

/**
 * ProductController
 */
class ProductController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $productService;

    /**
     * Constructor
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * Get list product
     *
     * @param Request $request
     * @return List
     */
    public function index(Request $request)
    {
        $priceList = $this->productService->getPriceList();

        return response()->success($priceList);
    }

    /**
     * Get prices list
     *
     * @param Request $request
     * @return List
     */
    public function getPrices(Request $request)
    {
        $priceList = $this->productService->getPriceList();

        return response()->success($priceList);
    }

}
