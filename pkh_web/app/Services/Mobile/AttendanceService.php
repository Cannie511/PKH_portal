<?php

namespace App\Services\Mobile;

use App\Services\IpService;
use App\Models\TrnAttendance;
use App\Services\BaseService;

class AttendanceService extends BaseService
{
    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(IpService $ipService)
    {
        $this->ipService = $ipService;
    }

    /**
     * @param $param
     */
    public function checkin($param)
    {
        $param["event_name"] = "CHECKIN";
        $this->createRecord($param);

        return [
            "rtnCd" => true,
            "msg"   => "Checkin thành công",
        ];
    }

    /**
     * @param $param
     */
    public function checkout($param)
    {
        $param["event_name"] = "CHECKOUT";
        $this->createRecord($param);

        return [
            "rtnCd" => true,
            "msg"   => "Checkout thành công",
        ];
    }

    /**
     * Create recore
     *
     * @param [type] $type CHECKIN: 1 | CHECKOUT: 2
     * @return void
     */
    public function createRecord($param)
    {
        $entity = new TrnAttendance();

        $user = $this->logonUser();

        $entity->working_time = date('Y-m-d H:i:s');
        $entity->user_id      = $user->id;
        $entity->agent        = $param["agent"];
        $entity->ip           = $param["ip"];
        $entity->event_name   = $param["event_name"];

// $entity->notes = $param["notes"];
        if (isset($param["gps_lat"])) {
            $entity->gps_lat = $param["gps_lat"];
        }

        if (isset($param["gps_long"])) {
            $entity->gps_long = $param["gps_long"];
        }

        try {
            $ipInfo = $this->ipService->getIpInfo($entity->ip);
            //$ipInfo = $this->ipService->getIpInfo('162.158.178.49');
            $this->ipService->setIpInfoToObject($entity, $ipInfo);
        } catch (\Throwable $e) {
            Log::warning($e);
        }

        $this->updateRecordHeader($entity, $user, true);

        $entity->save();
    }

}
