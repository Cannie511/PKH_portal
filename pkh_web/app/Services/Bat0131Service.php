<?php

namespace App\Services;

use DB;
use Log;

class Bat0131Service extends BaseService
{
    /**
     * @var mixed
     */
    private $ipService;

    /**
     * @param IpService $ipService
     */
    public function __construct(IpService $ipService)
    {
        $this->ipService = $ipService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * Update ip information
     *
     * @param [type] $total
     * @return void
     */
    public function updateIp($total)
    {

        $listIp = $this->getIpList($total);
        Log::info($listIp);

        if (count($listIp) == 0) {
            return;
        }

        foreach ($listIp as $ip) {
            $this->updateIpInfo($ip->ip);
            sleep(1);
        }

    }

    /**
     * @param $limit
     */
    private function getIpList($limit)
    {
        $sql = "
        select distinct
          ip
        from
          trn_audit_log
        where
          ip not in ('0.0.0.0', '127.0.0.1')
          and ip_lat is null
          and event_name NOT IN ('LOGIN-SP')
        limit
          ?
        ";

        $sqlParam = [$limit];

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $ip
     * @return null
     */
    private function updateIpInfo($ip)
    {
        $ipInfo = $this->ipService->getIpInfo($ip);

        if (!isset($ipInfo)) {
            return;
        }

        $sql = "
        update trn_audit_log
        set
          ip_as = ?
          , ip_city = ?
          , ip_country = ?
          , ip_country_code = ?
          , ip_isp = ?
          , ip_lat = ?
          , ip_lon = ?
          , ip_org = ?
          , ip_region = ?
          , ip_region_name = ?
          , ip_timezone = ?
          , ip_zip = ?
        where
          ip = ?
          and ip_lat is null
          and event_name NOT IN ('LOGIN-SP')
        ";
        $sqlParam = [
            $ipInfo->as,
            $ipInfo->city,
            $ipInfo->country,
            $ipInfo->countryCode,
            $ipInfo->isp,
            $ipInfo->lat,
            $ipInfo->lon,
            $ipInfo->org,
            $ipInfo->region,
            $ipInfo->regionName,
            $ipInfo->timezone,
            $ipInfo->zip,
            $ip,
        ];

        return DB::update(DB::raw($sql), $sqlParam);
    }

}
