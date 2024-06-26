<?php

namespace App\Services;

use DB;
use Log;
use App\Services\LocationService;

class Bat0132Service extends BaseService
{
    /**
     * @var mixed
     */
    private $ipService;

    /**
     * @param IpService $ipService
     * @param LocationService $locationService
     */
    public function __construct(
        IpService $ipService,
        LocationService $locationService
    ) {
        $this->ipService       = $ipService;
        $this->locationService = $locationService;
    }

    /**
     * Update store location
     *
     * @param [Array] $storeIds
     * @param [Int] $limit
     * @return void
     */
    public function updateLocation(
        $storeIds,
        $limit
    ) {

        Log::info(print_r($storeIds, true));
        Log::info("Limit: $limit");

        //https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyC749EiqBRe24U8m6aagggojXCYV1BsKGs

        $listStore = $this->getListStore($storeIds, $limit);
        Log::info(print_r($listStore, true));

        foreach ($listStore as $store) {
            $findAddress = "$store->address , $store->district , $store->province";
            $location    = $this->locationService->addressToLocation($findAddress);

            if (isset($location)) {
                $this->updateStore($store->store_id, $location);
            }

            sleep(1);
        }

    }

    /**
     * @param $storeIds
     * @param $limit
     */
    private function getListStore(
        $storeIds,
        $limit
    ) {
        $sql = "
        select
          a.store_id
          , a.name
          , a.address
          , a.area1
          , a.area2
          , b.name as province
          , c.name as district
        from
        mst_store a
        left join mst_area b on a.area1 = b.area_id
        left join mst_area c on a.area2 = c.area_id
        where
          a.gps_lat = 0
          and a.active_flg = 1 ";

        if (count($storeIds) > 0) {
            $sql .= " and a.store_id in ( " . join(",", $storeIds) . ") ";
        } else {
            $sql .= " and a.first_order is not null ";
        }

        $sql .= "
        limit
          ?
        ";

        $sqlParam = [$limit];

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $storeId
     * @param $locationInfo
     */
    private function updateStore(
        $storeId,
        $locationInfo
    ) {
        $sql = "
        update mst_store
        set
          gps_lat = ?
          , gps_long = ?
        where
          store_id = ?
        limit 1
         ";

        $sqlParam = [
            $locationInfo["lat"],
            $locationInfo["lng"],
            $storeId,
        ];

        Log::info(print_r($sqlParam, true));

        return DB::update(DB::raw($sql), $sqlParam);
    }

}
