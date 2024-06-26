<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\Crm0710Service;

/**
 * Crm0710Controller
 */
class Crm0710Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0710Service;
    /**
     * @var mixed
     */
    protected $storeService;

    /**
     * @param Crm0710Service $crm0710Service
     * @param StoreService $storeService
     */
    public function __construct(
        Crm0710Service $crm0710Service,
        StoreService $storeService
    ) {
        $this->crm0710Service = $crm0710Service;
        $this->storeService   = $storeService;
        $this->middleware('permission:screen.crm0710');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postLoadInit(Request $request)
    {
        $param        = $request->all();
        $store_id     =  intVal($request->get('store_id', 0));
        $store          = [];
        $store        = $this->storeService->selectStoreById($store_id);
        $cpayment_id     = intVal($request->get('cpayment_id', 0));
        $listAccount  = $this->crm0710Service->selectBankAccount($param);
        $inforPayment = null;


        $payment = $this->crm0710Service->findPayment($cpayment_id);
        

        $result = [
            'store'        => $store,
            'listAccount'  => $listAccount,
            'payment' => $payment,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param    = $request->all();
        $user     = Auth::user();
        $store_id = $this->crm0710Service->savePayment($user, $param);
        $result   = [
            'store_id' => $store_id,
        ];

        return response()->success($store_id);
    }

}
