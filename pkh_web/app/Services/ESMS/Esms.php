<?php
/**
 * Zalo © 2019
 *
 */

namespace App\Services\ESMS;

use App\Services\ESMS\EsmsEndpoint;
use App\Services\ESMS\EsmsRequest;
use App\Services\ESMS\EsmsTempId;
use App\Services\FuncConfService;
use App\Models\TrnEsmsRecord;
use DB;
use Log;
/**
 * Class Esms
 *
 * @package Zalo
 */
class Esms
{
    /**
     * @const string Version number of the Zalo PHP SDK.
     */
    const VERSION = '2.0.0';

    /**
     * @const string Version number of the Zalo PHP SDK.
     */
    const API_KEY    = 'E264C43C8157026D7F98385F549598'; // mf config stage final 

    const SECRET_KEY = '42E9C9F0F7A11242D88D524FFF7986'; // mf config stage final 

    const OA_ID      = '1307991396108552028'; // mf config stage final 
    
    const FORM_DATA = [
       
        "ESMS"          => [
            "esms_api_key",
            "esms_secret_key", 
            "oa_id",
        ]
    ];

     /**
     * @var EsmsClient The Esms client service.
     */
    protected $client;

     /**
     * Instantiates a new Zalo super-class object.
     *
     * @param array $config
     *
     * @throws ZaloSDKException
     */
    public function __construct(FuncConfService $funcConfService)
    {
        $this->funcConfService = $funcConfService;
        $result = [];
        $list   = self::FORM_DATA["ESMS"];

        foreach ($list as $key) {
            $type  = "txt_val";
            $value = $this->funcConfService->selectByKey($key, $type);
            if (isset($value)) {
                $result[$key] = $value;
            } else {
                $result[$key] = null;
            }
        }

        $this->esms_api_key     = $result["esms_api_key"];
        $this->esms_secret_key  = $result["esms_secret_key"];
        $this->oa_id            = $result["oa_id"];
    }



    public function http_request($data){
        $ch = curl_init(EsmsEndpoint::API_ESMS_SEND_MESSAGE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data,true));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    
    /**
     * Sends a POST request to Graph and returns the result.
     *
     * @param string                  $url
     * @param AccessToken|string|null $accessToken
     * @param array                   $params
     * @param string|null             $eTag
     *
     * @return ZaloResponse
     *
     * @throws ZaloSDKException
     */
    public function post($temp_id, $phone, $store_id, $params)
    {
       
        $data = $this->build($temp_id, $phone, $params);
        // $data = $this->build1();
        Log::debug("-----check ESMS ---------");
        Log::debug($data);
       
        $response = $this->http_request($data);

        Log::debug("-----check ESMS ---------");
        Log::debug(json_decode($response,true));
        $this->recordESMS($temp_id, $store_id, "1", $phone, $params, $response);
    
        return json_decode($response, true);
    }

    public function recordESMS($temp_id, $ref_id, $type, $phone, $params, $response){
        $response                   = json_decode($response,true);

        $entity                     = new TrnEsmsRecord();
        $entity->param              = implode("; ",$params);
        $entity->ref_id             = $ref_id;
        $entity->temp_id            = $temp_id;
        $entity->type               = $type;
        $entity->phone              = $phone;
        $entity->code_result        = $response["CodeResult"];
       
        if ($response["CodeResult"] != "100"){
            $entity->notes          = $response["ErrorMessage"];
        } else {
            $entity->SMSID          = $response["SMSID"];
        }
        
        DB::transaction(function () use ($entity) {
            $entity->save();
        });
        return $entity->id;
    }

    public function build1() {
        // Root data
        $data = array(
            'ApiKey'        =>  $this->esms_api_key ,
            'SecretKey'     =>  $this->esms_secret_key,
            'OAID'          =>  $this->oa_id,
            'TemplateID'    =>  "217316",
            'FromTime'      => "01/12/2021",
            'ToTime'        => "14/12/2021",
            "Offset"        => 1,
            "Limit"         => 50
        );

        return $data;

    }

    public function build($temp_id, $phone, $params) {
        // Root data
        $data = array(
            'ApiKey'        =>  $this->esms_api_key ,
            'SecretKey'     =>  $this->esms_secret_key,
            'OAID'          =>  $this->oa_id,
            'Phone'         =>  $phone, 
            'CallbackUrl'   =>  'https://www.phankhangco.com'
        );

        $temp = $this->buildTemp($temp_id, $phone, $params);
        if (count($temp)==0){
            return 0;
        } 
        $data = $data + $temp;

        return $data;

    }

    public function buildTemp($temp_id, $phone, $params) {
        switch ($temp_id) { 
            case EsmsTempId::TEMP_ID_APPENDIX_REGISTRATION:

                // 5 param <customer_name>,<address>,<registration_id>,<registration_status>,<registration_deadline>
                if (count($params)!= 5 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Thông báo đăng ký phụ lục"
                );
                return $data;    
            case EsmsTempId::TEMP_ID_ORDER_INFORM:
                // 7 param <customer_name>,<address>,<order_date>,<order_id>,<order_name> ,<payments>,<status>
                if (count($params)!= 8 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Xác nhận trạng thái đơn hàng"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_PAYMENT_CONFIRM:
                // 5 params <customer_name>,<address>,<payments>,<date>,<payment_debt>
                if (count($params)!= 6 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Xác nhận thanh toán"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_PAYMENT_DEADLINE:
                // 6 param <customer_name>,<address>,<order_date>,<contracts_id>,<payments>,<payment term>
                if (count($params)!= 6 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Thông báo kỳ hạn thanh toán"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_CUSTOMER_THANK:
                // 3 param customer_name,order_id,order_date
                if (count($params)!= 3 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Cảm ơn khách hàng đã mua hàng"
                );
                return $data;
            case EsmsTempId::TEMP_ID_LOYALTY_POINT:
                // 5 param customer_name,customer_name,agent_id,number,time
                if (count($params)!= 5 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Thông báo điểm tích lũy"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_CONGRAT_STAFF:
                // 3 param <employee_id>,<part>,<prize>
                if (count($params)!= 3 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Thông báo điểm tích lũy"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_CONGRAT_COMPETITION:
                // 6 param <customer_name>,<employee_id>,<part>,<prize>,<prize_period>,<won_prize>
                if (count($params)!= 6 ){
                    return array();
                }
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Thông báo đạt giải"
                );
                return $data;   
            case EsmsTempId::TEMP_ID_RATING:
                // 0 param <customer_name>,<employee_id>,<part>,<prize>,<prize_period>,<won_prize>
                
                $data = array(
                    'TempID' => $temp_id,
                    "Params" => $params,
                    "campaignid" => "Đánh giá của khách hàng"
                );
                return $data;   
            default:
            break;
        }
    }


}
