<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use App\Models\MstStore;
use Illuminate\Http\Request;
use App\Services\Crm0331Service;

class Crm0331Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0331Service;

    /**
     * @param Crm0331Service $crm0331Service
     */
    public function __construct(Crm0331Service $crm0331Service)
    {
        $this->crm0331Service = $crm0331Service;
        //$this->middleware( 'permission:screen.crm0331' );
        $this->crm0331Service = $crm0331Service;
    }

    /**
     * @param Request $request
     */
    public function postInit(Request $request)
    {
        $storeId                = $request->get('storeId');
        $store                  = MstStore::find($storeId);
        $result                 = [];
        $result["item"]         = $store;
        $user                   = Auth::user();
        $result["listSalesman"] = $user->name;

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $result                 = [];
        $storeWorkingId         = $request->get('storeWorkingId');
        $result["storeWorking"] = $this->crm0331Service->loadStoreWorking($storeWorkingId);
        Log::debug('*************working***************');
        // Log::debug(print_r($result["storeWorking"][0]->working_time, true));
        $result["image"] = $this->crm0331Service->loadImage($storeWorkingId);
        Log::debug(print_r($result["image"], true));

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param          = $request->all();
        $user           = Auth::user();
        $StoreWorkingId = $this->crm0331Service->createStoreWorking($user, $param);
        $result         = [
            'rtnCd'          => 'OK',
            'StoreWorkingId' => $StoreWorkingId,
        ];

        return response()->success($result);
    }
}
