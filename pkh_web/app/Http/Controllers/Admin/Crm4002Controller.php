<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm4002Service;

class Crm4002Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm4002Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @param crm4002Service $crm4002Service
     * 
     */
    public function __construct(Crm4002Service $crm4002Service){
        $this->crm4002Service = $crm4002Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request){
        $param = $request->all();
        $year = $param['year'] ?? date('Y');
        $quarter = $param['quarter'] ?? ceil(date('n') / 3);   
        $data = $this->crm4002Service->getData($param,$year,$quarter);   
        foreach($data as $v){
            $voucherItem = $this->crm4002Service->getVoucher($v->store_id,$year,$quarter);
            $v->voucher = $voucherItem;
        }    
        $result = [
            "data" => $data,
        ];
        
        return response()->success($result);
    }
    public function getYears(Request $request)
    {
        $years = $this->crm4002Service->getYears($request->all());
        return response()->json($years);
    }
    
}   
