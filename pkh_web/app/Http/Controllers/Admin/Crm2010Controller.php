<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Services\Crm2010Service;

/**
 * Crm2010Controller
 */
class Crm2010Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2010Service;

    /**
     * @param Crm2010Service $crm2010Service
     */
    public function __construct(Crm2010Service $crm2010Service)
    {
        $this->crm2010Service = $crm2010Service;
        //$this->middleware( 'permission:screen.crm2010' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param  = $request->all();
        $branch = null;

        if (isset($param['branch_id'])) {
            $branch = $this->crm2010Service->selectBranch($param);
        }

        return response()->success($branch);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param = $request->all();
        $user  = Auth::user();
        $res   = $this->crm2010Service->saveBranch($user, $param);

        return response()->success($res);
    }

}
