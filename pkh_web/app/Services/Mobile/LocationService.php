<?php

namespace App\Services\Mobile;

use Log;
use Carbon\Carbon;
use App\Models\TrnUserPosHis;
use App\Services\BaseService;
use App\Models\TrnUserLastPos;
use Illuminate\Database\QueryException;

class LocationService extends BaseService
{
    /**
     * @param $locations
     * @return mixed
     */
    public function createLocations($locations)
    {

        if (!isset($locations) || count($locations) == 0) {
            return;
        }

        $logonUser = $this->logonUser();
        $listId    = [];

        $lastPos = null;

        foreach ($locations as $location) {
            $entity = new TrnUserPosHis();

            $entity->user_id = $logonUser->id;

            $location["track_time"] = floor(intval($location["track_time"]) / 1000);
            $entity->track_time     = Carbon::createFromTimestamp($location["track_time"]);
            $entity->gps_lat        = $location["gps_lat"];
            $entity->gps_long       = $location["gps_long"];

            $this->updateRecordHeader($entity, $logonUser, true);

            try {
                $entity->save();
                $listId[$location["track_time"]] = $entity->id;

                if (null == $lastPos) {
                    $lastPos = $entity;
                } elseif (Carbon::instance($lastPos["track_time"])->lt(Carbon::instance($entity->track_time))) {
                    $lastPos = $entity;
                }

            } catch (QueryException $e) {
                Log::warning($e);
            }

        }

        $this->updateCurrentPos($lastPos, $logonUser->id);

        return $listId;
    }

    /**
     * @param $location
     * @param $userId
     * @return null
     */
    private function updateCurrentPos(
        $location,
        $userId
    ) {

        if (!isset($location)) {
            return;
        }

        $lastPos = $this->selectLastPosOfUser($userId);

        if ($lastPos->track_time < $location->track_time) {
            $lastPos->track_time = $location->track_time;
            $lastPos->gps_lat    = $location->gps_lat;
            $lastPos->gps_long   = $location->gps_long;
            $this->updateRecordHeader($lastPos, $userId, false);
            $lastPos->save();
        }

    }

    /**
     * @param $userId
     * @return mixed
     */
    private function selectLastPosOfUser($userId)
    {
        $entity = TrnUserLastPos::where('user_id', $userId)->first();

        if (null == $entity) {
            $entity             = new TrnUserLastPos();
            $entity->user_id    = $userId;
            $entity->track_time = Carbon::createFromTimestamp(0);
            $entity->gps_lat    = 0;
            $entity->gps_long   = 0;
            $this->updateRecordHeader($entity, $userId, true);
        }

        return $entity;
    }

}
