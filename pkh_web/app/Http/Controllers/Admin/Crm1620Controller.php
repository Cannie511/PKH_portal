<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1620Service;
use App\Services\SupplierService;
/**
 * Crm1620Controller
 */
class Crm1620Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1620Service;
/**
     * @var mixed
     */
    protected $supplierService;
    /**
     * @param Crm1620Service $crm1620Service
     */
    public function __construct(Crm1620Service $crm1620Service,
                                SupplierService $supplierService)
    {
        $this->crm1620Service = $crm1620Service;
        $this->supplierService = $supplierService;
        $this->middleware('permission:screen.crm1620');
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
        $list  = $this->crm1620Service->selectList($param);

        //Log::debug('--------------------search crm1600');
        //Log::debug($list);
        //Log::debug($param);

        return response()->success($list);
    }

}
