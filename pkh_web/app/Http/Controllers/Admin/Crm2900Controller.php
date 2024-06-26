<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2900Service;
use App\Services\WarehouseService;

/**
 * Crm2300Controller
 */
class Crm2900Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2900Service;
    /**
     * @var mixed
     */
    protected $warehouseService;
  

    /**
     * @param Crm2900Service $crm2300Service
     */
    public function __construct(
        Crm2900Service $crm2900Service
        
    ) {
        $this->crm2900Service   = $crm2900Service;
       

        //$this->middleware( 'permission:screen.crm2300' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $data = $this->crm2900Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

  

}
