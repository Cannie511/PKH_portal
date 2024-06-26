<?php

/**
 * Application helper
 * Prefix: ah_
 * Author: Nguyen Phu Cuong
 */

if (!function_exists('ah_gen_order_code')) {
    /**
     * [ah_gen_order_code Generate order code]
     * @param  [type] $storeId [description]
     * @param  [type] $orderId [description]
     * @return [type]          [description]
     */
    function ah_gen_order_code(
        $storeId,
        $orderId
    ) {

        $result = 'ORD' . date('ym') . '-'
        . str_pad(sh_num2Str($storeId), 4, '0', STR_PAD_LEFT)
        . '-'
        . str_pad(sh_num2Str($orderId), 6, '0', STR_PAD_LEFT);

        return $result;
    }

}

if (!function_exists('ah_gen_product_code')) {
    /**
     * [ah_gen_product_code get product id]
     * @param  [type] $productId [description]
     * @return [type]            [description]
     */
    function ah_gen_product_code($productId)
    {

        $result = str_pad(sh_num2Str($productId + 100), 4, '0', STR_PAD_LEFT);

        return $result;
    }

}

if (!function_exists('ah_get_discount_order')) {
    /**
     * [ah_get_discount_order Get Discount order]
     *         1,000,000    9,999,000    15%
     *         10,000,000    49,999,000    20%
     *         50,000,000    99,999,000    25%
     *         100,000,000    10,000,000,000    35%
     * @param  [type] $total [description]
     * @return [type]        [description]
     */
    function ah_get_discount_order($total)
    {

        $result = 0;

        if ($total >= 100000000) {
            $result = 35;
        } elseif ($total >= 50000000) {
            $result = 25;
        } elseif ($total >= 10000000) {
            $result = 20;
        } elseif ($total >= 1000000) {
            $result = 15;
        }

        return $result;
    }

}

if (!function_exists('ah_js_version')) {
    /**
     * Get JS version
     * @return [type] [description]
     */
    function ah_js_version()
    {

        if (env("APP_DEBUG", false) == true) {
            return time();
        }

        return env("JS_VERSION", date('Ymd')) . '_' . config('constants.VERSION');
    }

}

/**
 * @param $limit
 * @return mixed
 */
function ah_news_list($limit = 0)
{
    $newsService = App::make(\App\Services\NewsService::class);
    $listNews    = $newsService->selectList($limit);

    return $listNews;
}

/**
 * @param $id
 * @return mixed
 */
function ah_news_next($id)
{
    $newsService = App::make(\App\Services\NewsService::class);
    $listNews    = $newsService->selectNextNews($id);

    return $listNews;
}

/**
 * @param $id
 * @return mixed
 */
function ah_news_prev($id)
{
    $newsService = App::make(\App\Services\NewsService::class);
    $listNews    = $newsService->selectPrevNews($id);

    return $listNews;
}

/**
 * @param $id
 * @return mixed
 */
function ah_categories_list()
{
    $listCats = [
        [
            "product_cat_id" => 3,
            "product_cat_code" => "WT003",
            "name" => "Vòi xịt vệ sinh",
            "description"=> "GIỚI THIỆU VỀ DÒNG XỊT VỆ SINH"
        ],
        [
            "product_cat_id" => 7,
            "product_cat_code" => "WT007",
            "name" => "Vòi nóng lạnh",
            "description"=> "GIỚI THIỆU VỀ Vòi nóng lạnh"
        ],
        [
            "product_cat_id" => 13,
            "product_cat_code" => "WT00D",
            "name" => "Dòng cao cấp Katana",
            "description"=> "GIỚI THIỆU VỀ Dòng cao cấp Katana"
        ]
    ];

    return $listCats;
}

if (!function_exists('ah_top_product')) {
    /**
     * Get JS version
     * @return [type] [description]
     */
    function ah_top_product()
    {
        $productService = App::make(\App\Services\ProductWebsiteService::class);
        $txtProducts    = $productService->selectTopProductOnHome();

        return $txtProducts;
    }

}