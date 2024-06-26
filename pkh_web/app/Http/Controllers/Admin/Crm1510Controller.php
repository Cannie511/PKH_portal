<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1510Service;

/**
 * Crm1510Controller
 */
class Crm1510Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1510Service;

    /**
     * @param Crm1510Service $crm1510Service
     */
    public function __construct(Crm1510Service $crm1510Service)
    {
        $this->crm1510Service = $crm1510Service;
        //$this->middleware( 'permission:screen.crm1510' );
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        Log::debug('postSave---------------------');
        $param = $request->all();
        $user  = Auth::user();

        $packing = $this->crm1510Service->savePacking($user, $param);

        return response()->success($packing);

    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {

        $param = $request->all();

        $packing = $this->crm1510Service->selectPacking($param);
        Log::debug('postInit---------------------');
        Log::debug($packing);

        return response()->success($packing);

    }

}
