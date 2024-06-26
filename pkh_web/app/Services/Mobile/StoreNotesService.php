<?php

namespace App\Services\Mobile;

use Image;
use Carbon\Carbon;
use App\Models\MstStore;
use App\Services\BaseService;
use App\Services\ImageService;
use App\Models\TrnStoreWorking;
use App\Models\TrnStoreWorkingImages;

class StoreNotesService extends BaseService
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
     * @param $params
     */
    public function add($params)
    {
        $logonUser = $this->logonUser();

        $store = MstStore::find($params["store_id"]);

        if (!isset($store)) {
            return [];
        }

        $entity               = new TrnStoreWorking();
        $entity->working_time = Carbon::now();
        $entity->store_id     = $params["store_id"];
        $entity->salesman_id  = $logonUser->id;
        $entity->notes        = $params["notes"];

        $this->updateRecordHeader($entity, $logonUser, true);

        $entity->save();

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
            return ["msg" => "Image can't empty"];
        }

        $noteEntity = TrnStoreWorking::find($param["note_id"]);

        if (!isset($noteEntity)) {
            return ["msg" => "Store working is not exists"];
        }

        $entity          = new TrnStoreWorkingImages();
        $entity->note_id = $noteEntity->id;
        $img_path        = $this->uploadFile($param["image"], "store_note_" . $noteEntity->store_id . "_" . $noteEntity->id . "_" . substr(md5($noteEntity->store_id . "_" . $noteEntity->id . '-' . time()), 0, 15));

        if ("" != $img_path) {
            $entity->img_path = $img_path;
            $entity->save();

            return ["id" => $entity->id];
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
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/store_note", 640, 240);
        }

        return $imagePath;
    }

}
