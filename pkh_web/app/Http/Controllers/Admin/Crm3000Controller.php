<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm3000Service;

class Crm3000Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm3000Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @param crm3000Service $crm3000Service
     * 
     */
    public function __construct(Crm3000Service $crm3000Service){
        $this->crm3000Service = $crm3000Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request){
        $param = $request->all();
        $data = $this->crm3000Service->selectList($param);
        $avgSale = $this->crm3000Service->getAverageSalePerYear($param); 
        $result = [
            "data"=>$data,
            "avg_sale"=> $avgSale
        ];
        return response()->success($result);
    }
}   
