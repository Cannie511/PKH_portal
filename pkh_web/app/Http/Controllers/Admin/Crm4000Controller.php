<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\Crm4000Service;
use App\Services\eSmsService;
class Crm4000Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm4000Service;

        /**
     * @var mixed
     */
    private $esmsService;
    /**
     * @param crm4000Service $crm4000Service
     * 
     */

       /**
     * @param esmsService $esmsService
     * 
     */

     public function __construct(Crm4000Service $crm4000Service, eSmsService $esmsService){
        $this->crm4000Service = $crm4000Service;
        $this->esmsService = $esmsService;
    }

     /**
     * @param Request $request
     */

     public function postSearch(Request $request)
     {
        $param = $request->all();
        $year = $param['year'];
        $data = $this->crm4000Service->getStore($param);
        $result = [
            "data" => $data,
            "year" =>$year
        ];
        return response()->success($result);
     }

     public function postPay (Request $request)
     {
        $param = $request->all();
        $data = $this->crm4000Service->selectSpecificPayment($param['payment_id']);
        $store_name = preg_replace('/\([^)]*\)/', '', $data->store_name);// loại bỏ các thông tin trong ()
        $store_name = str_replace(' ', '', $store_name);// bỏ khoản trắng
        $param['customer_name'] = $store_name;
        $param['address'] = $data->address;
        $param['payments'] = $data->payment_money;
        $param['date'] =  $data->payment_date;
        $phone = $data->contact_mobile1;
        $param['total_score_card'] = $data->total_score_card;
        $store_id = $data->store_id;
        
        
        // đưa dữ liệu vào params để truyền vào sms
        $params = array(
            $param['customer_name'],  
            $param['address'],        
            $param['payments'],       
            $param['date'],           
            $param['payment_id'],
            $param['total_score_card']      
        );

        // tempalte thanh toán + thông báo điểm 
        // $params = array(
        //     $param['customer_name'],  
        //     $param['address'],        
        //     $param['payments'],       
        //     $param['date'],           
        //     $param['payment_id'],
        //     $param['total_score_card']      
        // );

        $send = $this->esmsService->sendZalo($phone,$params, $store_id);
        if ($send != "100" )
        {
            $send = $this->esmsService->sendSMS($phone,$param);
            $send = 1;
        }
        $result = [
                "Param" =>$param,
                "Send" => $send,
                // "SMS"=>$sms
        ];
        return response()->success($result);
     }
}
