<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2500Service;

/**
 * Crm2500Controller
 */
class Crm2500Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2500Service;

    /**
     * @param Crm2500Service $crm2500Service
     */
    public function __construct(Crm2500Service $crm2500Service)
    {
        $this->crm2500Service = $crm2500Service;
        //$this->middleware( 'permission:screen.crm2500' );
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data  = $this->crm2500Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

}
