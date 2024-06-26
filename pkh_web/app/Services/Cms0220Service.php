<?php

namespace App\Services;

use Log;
use Image;
use Illuminate\Pagination\LengthAwarePaginator;

class Cms0220Service extends BaseService
{
// public function paginationListImage($sql, $sqlParam, $rawParam) {

//     // Count item

//     $sqlCount = "select count(1) count from (" . $sql . ") temp";

//     $count = DB::select(DB::raw($sqlCount), $sqlParam)[0]->count;

//     // Select page

//     $currentPage = 1;

//     if( isset($rawParam['page']) ) {

//         $currentPageVal = intval($rawParam['page']);

//         if( $currentPageVal > 0) {

//             $currentPage = $currentPageVal;

//         }

//     }

//     $perPage = config('constants.PAGING_SIZE', 50);

//     $offset = ($currentPage - 1) * $perPage;

//     $sql .= " limit $perPage offset $offset ";

//     $data = DB::select(DB::raw($sql), $sqlParam);

//     $paginator = new LengthAwarePaginator($data, $count, $perPage, $currentPage);

//     return $paginator;

// }

    /**
     * @param $files_img
     * @param $rawParam
     * @return mixed
     */
    public function paginationListImage(
        $files_img,
        $rawParam
    ) {
        Log::debug('*************pagination***************');
        Log::debug(print_r($files_img, true));
        // Count item
        $count = count($files_img);
        Log::debug(print_r($count, true));
        // Select page
        $currentPage = 1;

        if (isset($rawParam['page'])) {
            $currentPageVal = intval($rawParam['page']);

            if ($currentPageVal > 0) {
                $currentPage = $currentPageVal;
            }

        }

        $perPage = config('constants.PAGING_SIZE', 10);
        $data    = [];

        for ($i = 0; $i < $perPage; $i++) {

            if (($currentPage - 1) * $perPage + $i < $count) {
                Log::debug(print_r(($currentPage - 1) * $perPage + $i, true));
                $data[$i] = $files_img[($currentPage - 1) * $perPage + $i];
                Log::debug(print_r($data[$i], true));
            }

            // $data[$i] = $files_img[($currentPage-1)*$perPage+$i];
        }

        $paginator = new LengthAwarePaginator($data, $count, $perPage, $currentPage);
        //hàm này vẫn giữ phải không?
        Log::debug(print_r($paginator, true));

        return $paginator;
    }

    /**
     * @param $param
     */
    public function selectList($param)
    {
        $files_img_tmp = array_filter(glob(public_path() . '/frontend/img/news/*'), 'is_file');
        $files_img     = [];

        foreach ($files_img_tmp as &$item) {
            $files_img[] = $item;
        }

// print_r($files_img); //Hàm debug array (mảng)

// Log::debug('*************load***************');
        foreach ($files_img as &$item) {
            // $php_pot2 = stripos($item, '/img/news/');
            $php_pot2 = strripos($item, '/');
            $item     = substr($item, $php_pot2 + 1);
            // Log::debug(print_r($item, true));
        }

        // return $files_img;

        return Cms0220Service::paginationListImage($files_img, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListAll($param)
    {
        $files_img_tmp = array_filter(glob(public_path() . '/frontend/img/news/*'), 'is_file');
        $files_img     = [];

        foreach ($files_img_tmp as &$item) {
            $files_img[] = $item;
        }

// print_r($files_img); //Hàm debug array (mảng)

// Log::debug('*************load***************');
        foreach ($files_img as &$item) {
            // $php_pot2 = stripos($item, '/img/news/');
            $php_pot2 = strripos($item, '/');
            $item     = substr($item, $php_pot2 + 1);
            // Log::debug(print_r($item, true));
        }

        return $files_img;
        // return Cms0220Service::paginationListImage($files_img, $param);
    }

    /**
     * @param $img
     * @return mixed
     */
    public function removeFile($img)
    {

// Log::debug('*************remove***************');
        // Log::debug(print_r($img, true));
        $imagePath      = public_path() . "/frontend/img/news/" . $img['file_path'];
        $imagePathThumb = public_path() . "/frontend/img/news/thumb/" . $img['file_path'];

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        if (file_exists($imagePathThumb)) {
            unlink($imagePathThumb);
        }

        $result = [];

        return $result;
    }

    /**
     * @param $img
     * @return mixed
     */
    public function uploadFile($img)
    {

// Log::debug('*************upload***************');

// Log::debug(print_r($img, true));
        if (isset($img['file'])) {
            // TODO: change it for your logic
            $imageFileName  = $img['title'] . ".jpg";
            $imagePath      = public_path() . "/frontend/img/news/" . $imageFileName;
            $imagePathThumb = public_path() . "/frontend/img/news/thumb/" . $imageFileName;
            $image          = Image::make($img['file']);
            $thumb          = Image::make($img['file'])
                ->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $image->save($imagePath);
            $thumb->save($imagePathThumb);
        }

        return $imagePath;
    }

}
