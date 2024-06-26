<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Models\MstBankAccount;
use App\Services\StoreService;
use App\Services\Crm1210Service;

/**
 * Crm1210Controller
 */
class Crm1210Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1210Service;
    /**
     * @var mixed
     */
    protected $storeService;

    /**
     * @param Crm1210Service $crm1210Service
     * @param StoreService $storeService
     */
    public function __construct(
        Crm1210Service $crm1210Service,
        StoreService $storeService
    ) {
        $this->crm1210Service = $crm1210Service;
        $this->storeService   = $storeService;
        //$this->middleware( 'permission:screen.crm1210' );
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
        $store = $this->storeService->selectStoreById($param['store_id']);
        Log::debug($store->name);
        $bank_account = null;

        if (isset($param['bank_account_id']) && $param['bank_account_id'] > 0) {
            $bank_account = MstBankAccount::find($param['bank_account_id']);
        }

        Log::debug('bank account ----------------------------------');
        Log::debug($bank_account);
        $result = [
            'store'        => $store,
            'bank_account' => $bank_account,
        ];

        return response()->success($result);

    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        Log::debug('111ahihihihihihihihihihihihihihi');
        $param    = $request->all();
        $user     = Auth::user();
        $store_id = $this->crm1210Service->saveBankAccount($user, $param);

        return response()->success($store_id);

    }

}
