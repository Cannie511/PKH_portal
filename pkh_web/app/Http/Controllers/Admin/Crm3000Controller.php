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
        $avg_OD = $this->crm3000Service->getAverageOderFrequencyPerYear($param);
        foreach($data as $v){
            $orderFrequency = $this->crm3000Service->getAverageOrderFrequency($v->store_id);
            $retentionItem = $this->crm3000Service->getRetention($v->store_id);
            $paymentHistory = $this->crm3000Service->getPaymentHistory($v->store_id);
            $v->order_frequency = $orderFrequency;
            $v->retention = $retentionItem;
            $v->payment = $paymentHistory;
        }
        
        $result = [
            "data" => $data,
            "avg_sale" => $avgSale,
            "avg_OD"=>$avg_OD,
        ];
        
        return response()->success($result);
    }
}   
