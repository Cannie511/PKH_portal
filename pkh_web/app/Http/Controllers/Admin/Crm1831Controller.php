<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Crm1830Service;
use App\Services\Crm1831Service;

/**
 * Crm1831Controller
 */
class Crm1831Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1831Service;
    /**
     * @var mixed
     */
    private $crm1830Service;

    /**
     * @param Crm1831Service $crm1831Service
     * @param Crm1830Service $crm1830Service
     */
    public function __construct(
        Crm1831Service $crm1831Service,
        Crm1830Service $crm1830Service
    ) {
        $this->crm1831Service = $crm1831Service;
        $this->crm1830Service = $crm1830Service;
        $this->middleware( 'permission:screen.crm1831' );
    }

    /**
     * @param Request $request
     */
    public function postLoadInit(Request $request)
    {
        $param       = $request->all();
        $departments = $this->crm1830Service->selectDepartments();
        $costcats    = $this->crm1830Service->selectConcats();
        $form        = $this->crm1831Service->selectCost($param);
        $result      = [
            'departments' => $departments,
            'costcats'    => $costcats,
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
        $result = $this->crm1831Service->saveCost($user, $param);

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postSendRequest(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1831Service->sendRequest($user, $param);

    

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postCancel(Request $request)
    {
        $this->requirePermission('screen.crm1831.cancel');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1831Service->Cancel($user, $param);
        

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postAccept(Request $request)
    {
        $this->requirePermission('screen.crm1831.accept');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1831Service->Accept($user, $param);
        

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postDeny(Request $request)
    {
        $this->requirePermission('screen.crm1831.accept');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1831Service->Deny($user, $param);
        

        return response()->success($result);
    }

     /**
     * @param Request $request
     */
    public function postAccConfirm(Request $request)
    {
        $this->requirePermission('screen.crm1831.confirm');
        $param  = $request->all();
        $user   = Auth::user();
        $result = $this->crm1831Service->accConfirm($user, $param);
        

        return response()->success($result);
    }
}
