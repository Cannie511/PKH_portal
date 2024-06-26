<?php

namespace App\Services;

use DB;
use Log;
use Image;
use Carbon\Carbon;
use App\Models\TrnWorkingImg;
use App\Models\TrnStoreWorking;

/**
 * Crm0331Service class
 */
class Crm0331Service extends BaseService
{
    /**
     * @var mixed
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $workingId
     */
    public function loadStoreWorking($workingId)
    {
        $sqlParam = array();
        $sql      = "
            select
            a.id
            , a.notes
            , a.working_time
            , b.name as salesman
            , c.name as store
            from
            trn_store_working a
            left join users b
                on a.salesman_id = b.id
                left join mst_store c
                on a.store_id = c.store_id
            where
            a.id = ?
			";
        $sqlParam[] = $workingId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $storeWorkingId
     */
    public function loadImage($storeWorkingId)
    {
        $sqlParam = array();
        $sql      = "
            select
            a.img_path
            from
            trn_working_img a
            where
            a.working_id = ?
			";
        $sqlParam[] = $storeWorkingId;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $storeWorking
     * @return mixed
     */
    public function createStoreWorking(
        $user,
        $storeWorking
    ) {
        Log::debug(print_r($storeWorking, true));
        $isUpdateMode = false;

        if (isset($storeWorking['storeWorkingId']) && $storeWorking['storeWorkingId'] > 0) {
            $isUpdateMode = true;
        }

        if (true == $isUpdateMode) {
            // Update
            $entityStoreWorking           = TrnStoreWorking::find($storeWorking['storeWorkingId']);
            $entityStoreWorking->store_id = $storeWorking['storeId'];
            $entityStoreWorking->notes    = $storeWorking['notes'];
            // $entityStoreWorking->working_time  = Carbon::today();
            $this->updateRecordHeader($entityStoreWorking, $user, false);
        } else {
            // Create
            $entityStoreWorking               = new TrnStoreWorking();
            $entityStoreWorking->salesman_id  = $user->id;
            $entityStoreWorking->store_id     = $storeWorking['storeId'];
            $entityStoreWorking->notes        = $storeWorking['notes'];
            $entityStoreWorking->working_time = Carbon::now();
            $this->updateRecordHeader($entityStoreWorking, $user, true);
        }

        $entityStoreWorking->save();

        if (isset($storeWorking['file'])) {
            $imgPath = $this->uploadFile($storeWorking['file'], "store_note_" . $storeWorking['storeId'] . "_" . $entityStoreWorking->id);
            // Create
            $entityWorkingImg             = new TrnWorkingImg();
            $entityWorkingImg->working_id = $entityStoreWorking->id;
            $entityWorkingImg->img_path   = $imgPath;
            $this->updateRecordHeader($entityWorkingImg, $user, true);
            $entityWorkingImg->save();
        }

        return $entityStoreWorking->id;
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
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/store_note", 640);
        }

        return $imagePath;
    }

}
