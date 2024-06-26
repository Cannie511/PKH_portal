<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm1700Service;

/**
 * Crm1700Controller
 */
class Crm1700Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm1700Service;

    /**
     * @param Crm1700Service $crm1700Service
     */
    public function __construct(Crm1700Service $crm1700Service)
    {
        $this->crm1700Service = $crm1700Service;
        //$this->middleware( 'permission:screen.crm1700' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm1700Service->selectPromotionList($param);

        return response()->success($list);
    }

}
