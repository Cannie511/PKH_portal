<?php

namespace App\Services;

use Log;
use Image;
use App\Models\MstProductMarket;

/**
 * Crm2510Service class
 */
class Crm2510Service extends BaseService
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
     * @param $id
     * @return mixed
     */
    public function load($id)
    {
        $entity = MstProductMarket::find($id);

        return $entity;
    }

    /**
     * Create product market
     *
     * @param [type] $params
     * @return void
     */
    public function create($params)
    {
        // $logonUser = $this->logonUser();
        $entity = new MstProductMarket();

        $this->editEntity($entity, $params);

        return [
            'rtnCd' => true,
            'msg'   => "Đã thêm sản phẩm $entity->name",
        ];
    }

    /**
     * Update product market
     *
     * @param [type] $params
     * @return void
     */
    public function update($params)
    {
        $entity = MstProductMarket::find($params["product_market_id"]);

        $this->editEntity($entity, $params);

        return [
            'rtnCd' => true,
            'msg'   => "Đã thêm sản phẩm $entity->name",
        ];
    }

    /**
     * @param $entity
     * @param $params
     */
    private function editEntity(
        $entity,
        $params
    ) {
        $logonUser    = $this->logonUser();
        $entity->type = $params["type"];
        $entity->name = $params["name"];
        $entity->code = $params["code"];

        if (isset($params["description"])) {
            $entity->description = $params["description"];
        }

        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();

        if (isset($params['file'])) {
            $imgPath = $this->uploadFile($params['file'], $entity->product_market_id);

            if (isset($imgPath) && "" != $imgPath) {
                $entity->img_path = $imgPath;
                $entity->save();
            }

        }

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
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/product_market", 240);
        }

        return $imagePath;
    }

    /**
     * @param $base64
     * @return mixed
     */
    private function getExt($base64)
    {
        Log::info($base64);
        preg_match("/^data:image\/(.*);base64/i", $base64, $match);
        $ext = $match[1];

        return $ext;
    }

}
