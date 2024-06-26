<?php

namespace App\Services;

use Log;
use File;
use Image;

/**
 * ImageService class
 */
class ImageService extends BaseService
{
    /**
     * Check image exist or not & return path
     * Use: return response()->file($fullPath);
     *
     * @param [type] $path
     * @return void
     */
    public function loadImage(
        $locationName,
        $path
    ) {
        $rootPath = $this->getLocation($locationName);
        $fullPath = $rootPath . "/" . $path;

        if (file_exists($fullPath)) {
            return $fullPath;
        }

        return null;
    }

    /**
     * Check image exist or not & return path
     * Use: return response()->file($fullPath);
     *
     * @param [type] $path
     * @return void
     */
    public function loadImageWeb($path)
    {
        $rootPath = env('FILE_ROOT_DIR_IMG_WEB');
        $fullPath = $rootPath . "/" . $path;

        if (strpos($path, '..') === false && file_exists($fullPath)) {
            return $fullPath;
        }

        return null;
    }

    /**
     * Save image form base64 string
     *
     * @param [type] $base64Image
     * @param [type] $fileName
     * @param [type] $folder
     * @param [type] $resize
     * @return void
     */
    public function saveFromBase64(
        $base64Image,
        $fileName,
        $folder,
        $resize,
        $thumbSize = 0
    ) {
        $rootPath = env('FILE_ROOT_DIR');
        Log::info('$rootPath: ' . $rootPath);
        $ext = $this->getExt($base64Image);
        Log::info('$ext: ' . $ext);

        if (isset($folder) && strlen($folder) > 0) {

            if (substr($folder, -1) != "/") {
                $folder = $folder . "/";
            }

        }

        $imagePath = null;
        // Remove NEWLINE character from some android
        $base64Image = str_replace(PHP_EOL, "", $base64Image);
        $image       = Image::make($base64Image);

        if (isset($resize) && $resize > 0) {
            $image = $image->resize(null, 240, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $newFolder = $rootPath . $folder;
        Log::info('$newFolder: ' . $newFolder);

        if (!File::exists($newFolder)) {
            File::makeDirectory($newFolder, 0755, true, true);
        }

        $imagePath = $folder . $fileName . "." . $ext;
        $image->save($rootPath . $imagePath);

        if ($thumbSize > 0) {
            $this->saveFromBase64($base64Image, $fileName, $folder . "/thumb", $thumbSize);
        }

        return $imagePath;
    }

    /**
     * @param $base64
     * @return mixed
     */
    private function getExt($base64)
    {
        $ext = "";

        $index = strpos($base64, ";");
        // data:image/ => 11
        Log::info($index);

        if ($index > 11) {
            $ext = substr($base64, 11, $index - 11);
        }

        return $ext;
    }

    /**
     * Save image feature thumb
     *
     * @param [type] $newsId
     * @param [type] $imgFile
     * @param [type] $width
     * @param [type] $height
     * @return void
     */
    public function saveNewsFeatureThumb(
        $newsId,
        $base64Image,
        $width,
        $height
    ) {
        $newsRootPath = env("FILE_ROOT_DIR_IMG_WEB");
        Log::info("newsRootPath:" . $newsRootPath);
        $newsFolderPath = $newsRootPath . "/" . $newsId;
        Log::info($newsFolderPath);
        $newsThumbFolderPath = $newsFolderPath . "/thumb";
        Log::info($newsThumbFolderPath);

        if (!File::exists($newsThumbFolderPath)) {
            File::makeDirectory($newsThumbFolderPath, 0755, true, true);
        }

        $ext               = $this->getExt($base64Image);
        $imgFile           = $this->resizeImageWithAspectRatio($base64Image, $width, $height);
        $thumbFileName     = "/" . $newsId . "/thumb/thumb-" . $newsId . "_" . $width . "x" . $height . "." . $ext;
        $thumbFileNameFull = $newsRootPath . $thumbFileName;
        $imgFile->save($thumbFileNameFull);

        return $thumbFileName;
    }

    /**
     * @param $base64Image
     * @param $width
     * @param $height
     * @return mixed
     */
    public function resizeImageWithAspectRatio(
        $base64Image,
        $width,
        $height
    ) {
        $image = Image::make($base64Image);

        if ($image->width() < $image->height()) {
            $temp   = $width;
            $width  = $height;
            $height = $temp;
        }

        $ratioW = $width / $image->width();
        $ratioH = $height / $image->height();

        if ($ratioW > $ratioH) {
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return $image;
    }

    /**
     * Return absolute path
     * @param $locationName
     * @return mixed
     */
    protected function getLocation($locationName)
    {

// $locationLists = [

//     "news"    => "FILE_ROOT_DIR_IMG_WEB",

//     "image"   => "FILE_ROOT_DIR_IMG",

//     "crm0210" => "FILE_ROOT_DIR_IMG_CRM0210",

//     "crm0410" => "FILE_ROOT_DIR_IMG_CRM0410",

//     "crm0810" => "FILE_ROOT_DIR_IMG_CRM0810",

//     "crm1630" => "FILE_ROOT_DIR_IMG_CRM1630",

//     "crm2310" => "FILE_ROOT_DIR_IMG_CRM2310",

// ];

// return $locationLists[$locationName];
        Log::debug("Location name : ");
        Log::debug($locationName);
        if ('news' == $locationName) {
            return env("FILE_ROOT_DIR_IMG_WEB");
        }

        if ('image' == $locationName) {
            return env("FILE_ROOT_DIR_IMG");
        }

        $rootImg = env("FILE_ROOT_DIR_IMG");

        return $rootImg . "/" . $locationName;
    }

    /**
     * @param $entityId
     * @param $base64Image
     * @param $defaultWidth
     * @param $defaultHeight
     * @return mixed
     */
    public function uploadImage(
        $entityId,
        $base64Image,
        $locationName,
        $defaultWidth = 640,
        $defaultHeight = 480
    ) {
        $location = $this->getLocation($locationName);
        $this->createFolder($entityId, $location);
        
        $ext = $this->getExt($base64Image);

        $fileName = $entityId . "_" . date("YmdHis") . "_" . rand(1, 100) . "." . $ext;
        $filePath = "/" . $entityId . "/" . $fileName;
        Log::debug("print location ");
        Log::debug($location . $filePath);
        $imgFile = $this->resizeImageWithAspectRatio($base64Image, $defaultWidth, $defaultHeight);
        $imgFile->save($location . $filePath);
       
        return $location . $filePath;
    }

    /**
     * @param $entityId
     * @return mixed
     */
    public function listImageFile(
        $entityId,
        $locationName
    ) {
        $newsRootPath = $this->getLocation($locationName);

        $files_img_tmp = array_filter(glob($newsRootPath . '/' . $entityId . '/*'), 'is_file');
        $files_img     = [];

        foreach ($files_img_tmp as &$item) {
            $files_img[] = $item;
        }

        foreach ($files_img as &$item) {
            $php_pot2 = strripos($item, '/');
            $item     = "/" . $entityId . "/" . substr($item, $php_pot2 + 1);
        }

        return $files_img;
    }

    /**
     * @param $newsId
     * @param $file
     */
    public function removeNewsImage(
        $newsId,
        $file
    ) {
        $checkPos = strpos($file, '..');

        if (false === $checkPos) {
            $newsRootPath = env("FILE_ROOT_DIR_IMG_WEB");
            $fullFilePath = $newsRootPath . "/" . $newsId . "/" . $file;
            Log::info("fullFilePath:" . $fullFilePath);

            if (file_exists($fullFilePath)) {
                unlink($fullFilePath);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $entityId
     */
    protected function createFolder(
        $entityId,
        $newsRootPath = ""
    ) {
        $newsFolderPath      = $newsRootPath . "/" . $entityId;
        $newsThumbFolderPath = $newsFolderPath . "/thumb";

        if (!File::exists($newsThumbFolderPath)) {
            File::makeDirectory($newsThumbFolderPath, 0755, true, true);
        }

    }

}
