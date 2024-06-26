<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1600Service;
use App\Services\SupplierService;
/**
 * Crm1600Controller
 */
class Crm1600Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1600Service;
  /**
     * @var mixed
     */
    protected $supplierService;
    /**
     * @param Crm1600Service $crm1600Service
     */
    public function __construct(Crm1600Service $crm1600Service,
                                SupplierService $supplierService)
    {
        $this->crm1600Service = $crm1600Service;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm1600');
    }

     /**
     * Search order
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param          = $request->all();
        $supplierList  = $this->supplierService->selectSupplierDropDown();

        $result = [
            'supplierList'  => $supplierList
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1600Service->selectList($param);
        //Log::debug('--------------------search crm1600');
        //Log::debug($list);
        //Log::debug($param);

        return response()->success($list);
    }

}
