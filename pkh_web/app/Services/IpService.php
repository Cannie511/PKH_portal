<?php

namespace App\Services;

use Log;

/**
 * UserService class
 */
class IpService extends BaseService
{
    /**
     * Get IP Info
     *
     * @param [type] $ip
     * @return
     * {
     *    "as": "AS7552 Viettel Group",
     *    "city": "Ho Chi Minh City",
     *    "country": "Vietnam",
     *    "countryCode": "VN",
     *    "isp": "Viettel Group",
     *    "lat": 10.8142,
     *    "lon": 106.6438,
     *    "org": "Viettel Group",
     *    "query": "115.72.19.248",
     *    "region": "SG",
     *    "regionName": "Ho Chi Minh",
     *    "status": "success",
     *    "timezone": "Asia/Ho_Chi_Minh",
     *    "zip": ""
     * }
     */
    public function getIpInfo($ip)
    {
        $defaultResult = null;

        if (null == $ip || "127.0.0.1" == $ip) {
            return $defaultResult;
        }

        try {
            $url      = "http://ip-api.com/json/" . $ip;
            $response = file_get_contents($url);
            $response = json_decode($response);

            return $response;
        } catch (\Exception $e) {
            return null;
        }

    }

    /**
     * @param $obj
     * @param $ipInfo
     * @return null
     */
    public function setIpInfoToObject(
        &$obj,
        $ipInfo
    ) {

        if (!isset($obj) || !isset($ipInfo)) {
            return;
        }

        try {
            $obj->ip_as           = $ipInfo->as;
            $obj->ip_city         = $ipInfo->city;
            $obj->ip_country      = $ipInfo->country;
            $obj->ip_country_code = $ipInfo->countryCode;
            $obj->ip_isp          = $ipInfo->isp;
            $obj->ip_lat          = $ipInfo->lat;
            $obj->ip_lon          = $ipInfo->lon;
            $obj->ip_org          = $ipInfo->org;
            $obj->ip_region       = $ipInfo->region;
            $obj->ip_region_name  = $ipInfo->regionName;
            $obj->ip_timezone     = $ipInfo->timezone;
            $obj->ip_zip          = $ipInfo->zip;
        } catch (Exception $e) {
            Log::error($e);
        }

    }

}
