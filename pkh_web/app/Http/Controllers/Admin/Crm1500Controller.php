<?php

namespace App\Http\Controllers\Admin;

use Log;
use Illuminate\Http\Request;
use App\Services\Crm1500Service;

/**
 * Crm1500Controller
 */
class Crm1500Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1500Service;

    /**
     * @param Crm1500Service $crm1500Service
     */
    public function __construct(Crm1500Service $crm1500Service)
    {
        $this->crm1500Service = $crm1500Service;
        //$this->middleware( 'permission:screen.crm1500' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1500Service->selectList($param);
        Log::debug('--------------------search crm1300');
        Log::debug($list);
        Log::debug($param);

        return response()->success($list);
    }

}
