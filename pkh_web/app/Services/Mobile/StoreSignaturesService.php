<?php

namespace App\Services\Mobile;

use DB;
use Image;
use App\Models\MstStore;
use App\Services\BaseService;
use App\Services\ImageService;
use App\Models\TrnStoreSignatures;

class StoreSignaturesService extends BaseService
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
     * @param $storeId
     */
    public function getList($storeId)
    {
        $sqlParam = [$storeId];
        $sql      = "
        select
          a.store_signature_id
          , a.store_id
          , a.img_path
          , a.description
        from
          trn_store_signatures a
        where
          store_id = ?
		  order by a.store_signature_id
        ";

        return DB::select(DB::raw($sql), $sqlParam);
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

        $store = MstStore::find($param["store_id"]);

        if (!isset($store)) {
            return ["msg" => "Store working is not exists"];
        }

        $entity           = new TrnStoreSignatures();
        $entity->store_id = $store->store_id;

        if (isset($param["description"])) {
            $entity->description = $param["description"];
        }

        $img_path = $this->uploadFile($param["image"], "store_sign_" . $store->store_id . "_" . substr(md5($store->store_id . '-' . time()), 0, 15));

        if ("" != $img_path) {
            $entity->img_path = $img_path;
            $entity->save();

            return ["store_signature_id" => $entity->store_signature_id];
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
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/store_sign", 640, 240);
        }

        return $imagePath;
    }

}
