<?php

namespace App\Services;

use DB;
use Log;
use App\Services\IpService;
use App\Models\TrnAttendance;

/**
 * Hrm0153Service class
 */
class Hrm0153Service extends BaseService
{
    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(IpService $ipService)
    {
        $this->ipService = $ipService;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {

        $user = $this->logonUser();

        $sqlParam = array();
        $sql      = "
        select id, working_time, user_id, ip, agent, event_name, notes, ip_city
        from trn_attendance
        where user_id = ?
        and working_time >= ?
        and working_time < ?
        order by working_time desc
        ";

        $sqlParam[] = $user->id;
        $sqlParam[] = date('Y-m-d') . ' 00:00:00';
        $sqlParam[] = date('Y-m-d') . ' 23:59:59';

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
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
