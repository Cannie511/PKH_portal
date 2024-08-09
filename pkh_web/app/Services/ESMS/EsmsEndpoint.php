<?php
/**
 * ESMS © 2021
 *
 */

namespace App\Services\ESMS;

/**
 * Class Esms Config
 *
 * @package Esms 
 */
class EsmsEndpoint {

    /**
     * @const 
     */
    
    const API_ESMS_SEND_MESSAGE = 'http://rest.apiesms.com/MainService.svc/xml/SendZaloMessage_V4_post_json/';
    

    const API_ESMS_GET_RATING   = ' http://rest.esms.vn/MainService.svc/json/ZNS/GetRating/';
}
