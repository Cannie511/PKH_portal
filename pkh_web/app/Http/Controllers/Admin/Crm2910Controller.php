<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm2910Service;

/**
 * crm2910Controller
 */
class Crm2910Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2910Service;
    /**
     * @var mixed
     */
 

    /**
     * @param crm2910Service $crm2910Service
     * 
     */
    public function __construct(
        crm2910Service $crm2910Service
    ) {
        $this->crm2910Service = $crm2910Service;
        // $this->middleware( 'permission:screen.crm2910' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param       = $request->all();
      
        $form        = $this->crm2910Service->selectWarehouse($param);
        $result      = [
           
            'form'        => $form,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm2910Service->saveWarehouse($user, $param);

        return response()->success($result);
    }

   
 
}
