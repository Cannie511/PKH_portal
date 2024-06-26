<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1110Service;

/**
 * Crm1110Controller
 */
class Crm1110Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1110Service;

    /**
     * @param Crm1110Service $crm1110Service
     */
    public function __construct(Crm1110Service $crm1110Service)
    {
        $this->crm1110Service = $crm1110Service;
        //$this->middleware( 'permission:screen.crm1110' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        Log::debug('111ahihihihihihihihihihihihihihi');
        $param = $request->all();
        Log::debug($param);

        if (null == $param['delivery_vendor_id']) {
            $inforVendor = null;
        } else {
            $inforVendor = $this->crm1110Service->selectVendor($param);
        }

        $result = [
            'inforVendor' => $inforVendor,
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

        $vendor = $this->crm1110Service->saveDeliveryVendor($user, $param);
        $result = [
            'vendor' => $vendor,
        ];

        return response()->success($vendor);

    }

}
