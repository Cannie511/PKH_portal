<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm1821Service;

/**
 * Crm1821Controller
 */
class Crm1821Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1821Service;

    /**
     * @param Crm1821Service $crm1821Service
     */
    public function __construct(Crm1821Service $crm1821Service)
    {
        $this->crm1821Service = $crm1821Service;
        //$this->middleware( 'permission:screen.crm1821' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param  = $request->all();
        $data   = $this->crm1821Service->selectDepartment($param);
        $result = [
            'department' => $data,
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
        $result = $this->crm1821Service->saveDepartment($user, $param);

        return response()->success($result);
    }

}
