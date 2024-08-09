<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm3020Service;

class Crm3020Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm3020Service;
    /**
     * @param Crm3020Service $crm3020Service
     * 
     */
    public function __construct(Crm3020Service $crm3020Service){
        $this->crm3020Service = $crm3020Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $store_id = $request->input('store_id');
        
        $data = $this->crm3020Service->selectList($param);     
        $totalOrderCount = $this->crm3020Service->getAvgCountAStoreOrderQuarterOfYear($store_id);
        $result = [
            'data' => $data,
            'data1' =>$totalOrderCount
        ];

        return response()->success($result);
    }
}   
