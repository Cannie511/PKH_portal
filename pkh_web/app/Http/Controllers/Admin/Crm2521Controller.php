<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\Crm2521Service;

/**
 * Crm2521Controller
 */
class Crm2521Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2521Service;

    /**
     * @param Crm2521Service $crm2521Service
     */
    public function __construct(Crm2521Service $crm2521Service)
    {
        $this->crm2521Service = $crm2521Service;
        //$this->middleware( 'permission:screen.crm2521' );
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        Log::debug('postSave---------------------');
        $param = $request->all();
        $user  = Auth::user();

        $packing = $this->crm2521Service->savePacking($user, $param);

        return response()->success($packing);

    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {

        $param = $request->all();

        $packing = $this->crm2521Service->selectPacking($param);
        Log::debug('postInit---------------------');
        Log::debug($packing);

        return response()->success($packing);

    }

}
