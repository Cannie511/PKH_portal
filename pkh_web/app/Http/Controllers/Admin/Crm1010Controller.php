<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1010Service;

class Crm1010Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1010Service;

    /**
     * @param Crm1010Service $crm1010Service
     */
    public function __construct(Crm1010Service $crm1010Service)
    {
        $this->crm1010Service = $crm1010Service;
        //$this->middleware( 'permission:screen.crm0710' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        Log::debug('111ahihihihihihihihihihihihihihi');
        $param = $request->all();
        Log::debug($param);
        $listVendor = $this->crm1010Service->selectVendor($param);

        if (null == $param['delivery_id']) {
            $infordelivery = null;
        } else {
            $infordelivery = $this->crm1010Service->selectDelivery($param);
        }

        $result = [
            'listVendor'    => $listVendor,
            'infordelivery' => $infordelivery,
        ];
        Log::debug('ahihihihihihihihihihihihihihi');

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        Log::debug('postSave 111ahihihihihihihihihihihihihihi');
        $param = $request->all();
        $user  = Auth::user();

        $delivery_id = $this->crm1010Service->saveDelivery($user, $param);

        return response()->success($delivery_id);

    }

}
