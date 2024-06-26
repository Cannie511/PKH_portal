<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use Auth;
use App\Services\Crm0110Service;
use App\Services\ProductService;

/**
 * Crm0110Controller
 * Danh muc san pham
 */
class Crm0110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0110Service;
    /**
     * @var mixed
     */
    protected $productService;

    /**
     * @param Crm0110Service $crm0110Service
     */
    public function __construct(Crm0110Service $crm0110Service,
        ProductService $productService
    ) {
        $this->crm0110Service = $crm0110Service;
        $this->productService = $productService;

        $this->middleware('permission:screen.crm0110');
    }

    public function postInit()
    {
        $initData = $this->crm0110Service->loadInit();

        $initData["listCat1"]      = $this->productService->selectListProductCat1();
        $initData["listCat2"]      = $this->productService->selectListProductCat2();
        $initData["listColor"]       = $this->productService->getColorList();
        $initData["listFormPacking"] = $this->productService->getPackingList();

        return response()->success(['init' => $initData]);
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $initData                    = $this->crm0110Service->loadInit();
      
        $product = $this->crm0110Service->loadProduct($request->get('product_id'));

        return response()->success([
            'init'    => $initData,
            'product' => $product,
        ]);
    }

    /**
     * @param Request $request
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'supplier_id'      => 'required|numeric|min:0',
            'product_cat1_id'   => 'required|numeric|min:0',
            'product_cat2_id'   => 'required|numeric|min:0',
            'product_code'     => 'required',
            'name'             => 'required',
            'color'             => 'required',
            'pakagingType'             => 'required',
            'warranty'             => 'required',
            'pakaging' => 'required|numeric|min:1',


        ]);

        $param  = $request->all();
        $result = $this->crm0110Service->create($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'supplier_id'      => 'required|numeric|min:0',
            'product_cat1_id'   => 'required|numeric|min:0',
            'product_cat2_id'   => 'required|numeric|min:0',
            'product_code'     => 'required',
            'name'             => 'required',
            'color'             => 'required',
            'pakagingType'             => 'required',
            'warranty'             => 'required',
            'pakaging' => 'required|numeric|min:1',
        ]);

        $param  = $request->all();
        $result = $this->crm0110Service->update($param);

        return response()->success($result);
    }

}
