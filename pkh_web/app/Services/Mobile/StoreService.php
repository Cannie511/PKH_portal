<?php

namespace App\Services\Mobile;

use DB;
use File;
use Image;
use Carbon\Carbon;
use App\Models\MstStore;
use App\Services\IpService;
use App\Models\TrnAttendance;
use App\Services\BaseService;
use App\Services\ImageService;
use App\Models\TrnStoreCheckIn;
use App\Models\TrnStoreCheckInImages;

class StoreService extends BaseService
{
    /**
     * @var mixed
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(
        ImageService $imageService,
        IpService $ipService
    ) {
        $this->imageService = $imageService;
        $this->ipService    = $ipService;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {

        $sqlParam = [];
        $sql      = "
			select
			  a.store_id
			  , a.name
			  , a.address
			  , a.area1
			  , b.name area1_name
			  , a.area2
			  , c.name area2_name
			  , a.gps_lat
			  , a.gps_long
			  , a.img_path
			  , a.new_store_id
			  , a.dealer_id
			  , d.name dealer_name
			  , a.first_order
			  , a.store_sts
			  , a.contact_name
			  , a.contact_email
			  , a.contact_tel
			  , a.contact_fax
			  , a.contact_mobile1
			  , a.contact_mobile2
			  , a.active_flg
			  , a.created_at
			  , a.created_by
			  , a.updated_at
			  , a.updated_by
			  , a.version_no
              , e.id as salesman_id
			  , e.name as salesman_name
			  , f.name area_group_name
			from
			  mst_store a
			  left join mst_area b on b.area_id = a.area1
			  left join mst_area c on c.area_id = a.area2
			  left join mst_dealer d on d.dealer_id = a.dealer_id
			  left join mst_area_group f on b.area_group_id = f.area_group_id
		";

        $sql .= ' left join users e on e.id = a.salesman_id  ';

        $sql .= "
			where
			  a.active_flg = '1'
			 ";

        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'areaGroup', 'f.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'a.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'a.area2', $sqlParam);

        $sql .= "
			order by
			  a.first_order desc, a.name
        ";

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function selectById($storeId)
    {

        $param    = ["store_id" => intval($storeId)];
        $sqlParam = [];
        $sql      = "
			select
			  a.store_id
			  , a.name
			  , a.address
			  , a.area1
			  , b.name area1_name
			  , a.area2
			  , c.name area2_name
			  , a.gps_lat
			  , a.gps_long
			  , a.img_path
			  , a.new_store_id
			  , a.dealer_id
			  , d.name dealer_name
			  , a.first_order
			  , a.store_sts
			  , a.contact_name
			  , a.contact_email
			  , a.contact_tel
			  , a.contact_fax
			  , a.contact_mobile1
			  , a.contact_mobile2
			  , a.active_flg
			  , a.created_at
			  , a.created_by
			  , a.updated_at
			  , a.updated_by
			  , a.version_no
              , e.id as salesman_id
			  , e.name as salesman_name
			  , f.name area_group_name
			from
			  mst_store a
			  left join mst_area b on b.area_id = a.area1
			  left join mst_area c on c.area_id = a.area2
			  left join mst_dealer d on d.dealer_id = a.dealer_id
			  left join mst_area_group f on b.area_group_id = f.area_group_id
		";

        $sql .= ' left join users e on e.id = a.salesman_id  ';

        $sql .= "
			where
			  a.active_flg = '1'
			 ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);

        $sql .= "
			limit 1
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param $params
     */
    public function checkin($params)
    {
        $logonUser = $this->logonUser();

        $store = MstStore::find($params["store_id"]);

        if (!isset($store)) {
            return [];
        }

        $entity               = new TrnStoreCheckIn();
        $entity->working_time = Carbon::now();
        $entity->store_id     = $params["store_id"];
        $entity->salesman_id  = $logonUser->id;
        $entity->notes        = $params["notes"];
        $entity->gps_lat      = $params["gps_lat"];
        $entity->gps_long     = $params["gps_long"];

        $this->updateRecordHeader($entity, $logonUser, true);

        $entity->save();

        // Also checkin on web
        $attendance = new TrnAttendance();
        $user       = $this->logonUser();

        $attendance->working_time = $entity->working_time;
        $attendance->user_id      = $logonUser->id;
        $attendance->agent        = $params["agent"];
        $attendance->ip           = $params["ip"];
        $attendance->event_name   = "CHECKIN";
        $attendance->gps_lat      = $params["gps_lat"];
        $attendance->gps_long     = $params["gps_long"];

        try {
            $ipInfo = $this->ipService->getIpInfo($attendance->ip);
            // $ipInfo = $this->ipService->getIpInfo('162.158.178.49');
            $this->ipService->setIpInfoToObject($attendance, $ipInfo);
        } catch (\Throwable $e) {
            Log::warning($e);
        }

        $this->updateRecordHeader($attendance, $logonUser, true);
        $attendance->save();

        return [
            "id" => $entity->id,
        ];
    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $logonUser = $this->logonUser();

        if (!isset($param["image"])) {
            return [];
        }

        $store = MstStore::find($param["store_id"]);

        if (!isset($store)) {
            return [];
        }

        $checkIn = TrnStoreCheckIn::find($param["checkin_id"]);

        if (!isset($checkIn)) {
            return [];
        }

        $fileName  = "store_checkin_" . $store->store_id . '-' . $checkIn->id . '-' . substr(md5($store->store_id . '-' . $checkIn->id . '-' . time()), 0, 15);
        $imagePath = $this->uploadFile($param["image"], $fileName);

        if ("" != $imagePath) {
            $imageEntity              = new TrnStoreCheckInImages();
            $imageEntity->check_in_id = $checkIn->id;
            $imageEntity->img_path    = $imagePath;
            $this->updateRecordHeader($imageEntity, $logonUser, true);
            $imageEntity->save();

            return [
                "id" => $imageEntity->id,
            ];
        }

        return [];
    }

    /**
     * @param $file
     * @param $imageFileName
     * @return mixed
     */
    private function uploadFile(
        $file,
        $imageFileName
    ) {
        $imagePath = "";

        if (isset($file)) {
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/store_checkin", 640, 240);
        }

        return $imagePath;
    }

}
