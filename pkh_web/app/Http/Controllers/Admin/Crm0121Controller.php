<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0121Service;
use App\Services\SupplierService;

/**
 * Crm0121Controller
 */
class Crm0121Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0121Service;

    /**
     * @param Crm0121Service $crm0121Service
     */
    public function __construct(
        Crm0121Service $crm0121Service,
        SupplierService $supplierService
    )
    {
        $this->crm0121Service = $crm0121Service;
        $this->supplierService = $supplierService;
        //$this->middleware( 'permission:screen.crm0121' );
    }

    public function postLoadInit()
    {
        $initData = $this->supplierService->selectSupplierDropDown();

        return response()->success(['init' => $initData]);
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $initData = $this->supplierService->selectSupplierDropDown();
        $product  = $this->crm0121Service->loadProductCat($request->get('product_cat1_id'));

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
            'supplier_id' => 'required|numeric|min:0',
            'name'        => 'required',
           
        ]);

        $param  = $request->all();
        $result = $this->crm0121Service->create($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|numeric|min:0',
            'name'        => 'required',
           
        ]);

        $param  = $request->all();
        $result = $this->crm0121Service->update($param);

        return response()->success($result);
    }

}
