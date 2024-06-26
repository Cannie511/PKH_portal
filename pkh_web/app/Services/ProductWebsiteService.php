<?php

namespace App\Services;

use DB;
use App\Services\ProductService;
use App\Services\FuncConfService;

/**
 * Product Service for website
 */
class ProductWebsiteService extends BaseService
{
    /**
     * @var mixed
     */
    private $funcConfService;

    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(
        FuncConfService $funcConfService,
        ProductService $productService
    ) {
        $this->funcConfService = $funcConfService;
        $this->productService  = $productService;
    }

    /**
     * Get product list show in frontend
     * @return [type] [description]
     */
    public function selectListProductCat()
    {
        $sql = "
        SELECT product_cat_id,
                product_cat_code,
                name,
                short_content
        FROM mst_product_cat
        WHERE allow_order_flg = 1
        and active_flg = 1
        AND supplier_id = 1
        ORDER BY  priority
        ";

        return DB::select(DB::raw($sql));
    }

    /**
     * @param $cat_id
     * @return mixed
     */
    public function selectListProductionInCat($cat_id)
    {
        $sql = "
        select
            a.product_id,
            a.supplier_id,
            a.product_type,
            a.product_cat_id,
            a.product_code,
            a.name,
            a.short_content,
            a.color,
            a.selling_price
        from mst_product a
        where a.product_cat_id = ?
        and a.supplier_id = 1
        and a.selling_price > 0
        order by a.product_id
        ";

        $sqlParam[] = $cat_id;

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $cat_id
     * @param $product_id
     * @return mixed
     */
    public function selectListProductionRelated(
        $cat_id,
        $product_id
    ) {
        $sql = "
        select
            a.product_id,
            a.supplier_id,
            a.product_type,
            a.product_cat_id,
            a.product_code,
            a.name,
            a.short_content,
            a.color,
            a.selling_price
        from mst_product a
        where a.product_cat_id = ? and a.product_id != ?
        and a.allow_order_flg = '1'
        order by a.product_id
        ";

        $sqlParam[] = $cat_id;
        $sqlParam[] = $product_id;

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function selectTopProductOnHome($key = FuncConfService::CMS_HOME_TOP_PRODUCT)
    {
        // $txtProduct = $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_TOP_PRODUCT, 'txt_val');
        $txtProduct = $this->funcConfService->selectByKey($key, 'txt_val');

        if (empty($txtProduct) || strlen($txtProduct) == 0) {
            return [];
        }

        $arr         = explode(',', $txtProduct);
        $listProduct = $this->productService->selectProductByIds($arr);

        return $listProduct;
    }

}
