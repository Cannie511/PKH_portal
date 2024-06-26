<?php

namespace App\Services;

use DB;
use App\Services\FuncConfService;

/**
 * Product Service
 */
class ProductService extends BaseService
{
    /**
     * @var mixed
     */
    private $funcConfService;

    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(FuncConfService $funcConfService)
    {
        $this->funcConfService = $funcConfService;
    }

    /**
     * Get product list for sales
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function selectProductListForSales($param)
    {

        $sqlParam = array();
        $sql      = "
      select
        a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.stock_code
        , a.name
        , a.name_origin
        , a.color
        , a.packing
        , a.moq
        , a.standard_packing
        , a.warning_qty
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
        , c.supplier_code
        , c.name supplier_name
      from
        mst_product a
        left join mst_product_cat b
          on a.product_cat_id = b.product_cat_id
        left join mst_supplier c
          on a.supplier_id = c.supplier_id
      where
        a.active_flg = '1' ";

        if (isset($param['product_code'])) {
            $sql .= " and  lower(a.product_code) like ? ";
            $sqlParam[] = '%' . strtolower($param["product_code"]) . '%';
        }

        if (isset($param['name'])) {
            $sql .= " and  lower(a.name) like ? ";
            $sqlParam[] = '%' . strtolower($param["name"]) . '%';
        }

        if (isset($param['stock_code'])) {
            $sql .= " and  lower(a.stock_code) like ? ";
            $sqlParam[] = '%' . strtolower($param["stock_code"]) . '%';
        }

        $sql .= "
      order by
        c.supplier_code
        , b.product_cat_code
        , a.product_code
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Get product list for sales
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function selectSellingProduct($param)
    {

        $sqlParam = array();
        $sql      = "
      select
        a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.stock_code
        , a.name
        , a.name_origin
        , a.color
        , a.packing
        , a.moq
        , a.standard_packing
        , a.warning_qty
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
        , c.supplier_code
        , c.name supplier_name
      from
        mst_product a
        left join mst_product_cat b
          on a.product_cat_id = b.product_cat_id
        left join mst_supplier c
          on a.supplier_id = c.supplier_id
      where
        a.active_flg = '1'
        and a.selling_price > 0
        and a.allow_order_flg = '1'
        ";

        if (isset($param['product_code'])) {
            $sql .= " and  lower(a.product_code) like ? ";
            $sqlParam[] = '%' . strtolower($param["product_code"]) . '%';
        }

        if (isset($param['name'])) {
            $sql .= " and  lower(a.name) like ? ";
            $sqlParam[] = '%' . strtolower($param["name"]) . '%';
        }

        if (isset($param['stock_code'])) {
            $sql .= " and  lower(a.stock_code) like ? ";
            $sqlParam[] = '%' . strtolower($param["stock_code"]) . '%';
        }

        $sql .= "
        order by
            c.supplier_code
            , b.product_cat_code
            , a.product_code
        ";

        $list = DB::select(DB::raw($sql), $sqlParam);

        foreach ($list as $item) {
            //$item->imgUrl = "/img/product/".$item->product_code.".png";
            //$code = $item->supplier_id == 1 ? substr($item->product_code, 0, 6) : $item->product_code;
            $code = substr($item->product_code, 0, 6);
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
        }

        return $list;
    }

    /**
     * Get product list show in frontend
     * @return [type] [description]
     */
    public function selectAllProductForFrontend()
    {
        $sql = "
      select
        a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.stock_code
        , a.name
        , a.name_origin
        , a.color
        , a.packing
        , a.moq
        , a.standard_packing
        , a.warning_qty
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
      from
        mst_product a
        left join mst_product_cat b
          on a.product_cat_id = b.product_cat_id
      where
        a.active_flg = '1'
        AND a.supplier_id  = 1
      order by
        b.name, a.name
      ";
        /*
        and a.product_code not in ('WT001Z-16005', 'WT002I-1600A', 'WT001F-1600A', 'WT001D-1600A', 'WT0027-16009', 'WT0029-16009', 'WT001B-16009', 'WT0028-16009', 'WT002A-16009', 'WT001C-16009', 'WT002X-1600D', 'WT002Y-1600D', 'WT0024-1600D', 'WT0025-1600D', 'WT002P-1600C', 'WT0013-16006', 'WT0010-16006', 'WT0012-16006', 'WT0011-16006', 'WT002S-16006', 'WT0010-16006', 'WT0012-16006', 'WT0011-16006', 'WT0016-16008', 'WT001A-16008', 'WT002V-160030', 'WT002B-16003', 'WT002U-16003', 'WT002W-16003', 'WT002V-16003', 'WT002J-1600A', 'WT0008-16002', 'WT001J-16002')
         */

        return DB::select(DB::raw($sql));
    }

    /**
     * Get list product can order for internal sales
     * @return [type] [description]
     */
    public function selectProductListForOrder($param)
    {
        $sqlParam = [];
        $sql      = "
      select
        a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.stock_code
        , a.accountant_price
        , a.name
        , a.name_origin
        , a.color
        , a.packing
        , a.moq
        , a.standard_packing
        , a.warning_qty
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
        , c.length*c.width*c.height/1000000000 as volume
      from
        mst_product a
        left join mst_product_cat b
          on a.product_cat_id = b.product_cat_id
        left join mst_packaging c
          on c.packaging_id = a.packaging_id
      where
        a.active_flg = '1'
        and a.selling_price > 0
      ";

        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_code', 'a.stock_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'type', 'a.product_cat_id', $sqlParam);

        $sql .= "
      order by
        a.priority_degree asc
      ";

        $productList = DB::select(DB::raw($sql), $sqlParam);

        foreach ($productList as $product) {
            //$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
            $code = substr($product->product_code, 0, 6);

            if (file_exists(public_path() . '/img/product/' . $code . '.png')) {
                $product->noImage = 0;
            } else {
                $product->noImage = 1;
            }

        }

        return $productList;
    }

    /**
     * Get list product can order for internal sales
     * @return [type] [description]
     */
    public function selectProductListForOrderWithWarehouse($param)
    {
        $sqlParam = [];
        $sql      = "
        select
          a.product_id
          , a.supplier_id
          , a.product_cat_id
          , a.product_code
          , a.stock_code
          , a.accountant_price
          , a.name
          , a.name_origin
          , a.color
          , a.packing
          , a.moq
          , a.standard_packing
          , a.warning_qty
          , a.selling_price
          , a.active_flg
          , b.product_cat_code
          , b.name product_cat_name
          , c.length * c.width * c.height / 1000000000 as volume
          , coalesce(d.amount, 0) warehouse_remain
          , coalesce(e.amount, 0) in_order_amount
          , f.name supplier_name
        from
          mst_product a
          left join mst_product_cat b
            on a.product_cat_id = b.product_cat_id
          left join mst_packaging c
            on c.packaging_id = a.packaging_id
          left join v_warehouse d
            on a.product_id = d.product_id
          left join mst_supplier f on a.supplier_id = f.supplier_id
          left join (
            select
              a.product_id
              , sum(a.amount) amount
            from
              trn_store_order_detail a join trn_store_order b
                on a.store_order_id = b.store_order_id
                and b.order_sts in ('0', '1')
            group by
              a.product_id
          ) e
            on a.product_id = e.product_id
        where
          a.active_flg = '1'
          and a.selling_price > 0
      ";

        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_code', 'a.stock_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'type', 'a.product_cat_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= "
      order by
        a.priority_degree asc
      ";

        $productList = DB::select(DB::raw($sql), $sqlParam);

        foreach ($productList as $product) {
            //$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
            $code = substr($product->product_code, 0, 6);
            if (file_exists(public_path() . '/img/product/' . $code . '.png')) {
                $product->noImage = 0;
            } else {
                $product->noImage = 1;
            }
        }

        return $productList;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectProductListForOrderWeb($param)
    {
        $sqlParam = [];
        $sql      = "
      select
        a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.name
        , a.color
        , a.packing
        , a.standard_packing
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
      from
        mst_product a
        left join mst_product_cat b
          on a.product_cat_id = b.product_cat_id
      where
        a.active_flg = '1'
        and a.selling_price > 0
      ";

        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_code', 'a.stock_code', $sqlParam);
        $sql .= $this->andWhereInt($param, 'type', 'a.product_cat_id', $sqlParam);

        $sql .= "
        order by
             a.priority_degree asc
      ";

        $productList = DB::select(DB::raw($sql), $sqlParam);

        foreach ($productList as $product) {

            if (file_exists(public_path() . '/img/product/' . $product->product_code . '.png')) {
                $product->noImage = 0;
            } else {
                $product->noImage = 1;
            }

        }

        return $productList;
    }

    /**
     * Get list product can order for internal sales
     * @return [type] [description]
     */
    public function selectProduct($param)
    {
        $sqlParam = [];
        $sql      = "
        select
          a.product_id
          , a.supplier_id
          , a.product_cat_id
          , a.product_code
          , a.name
          , a.name_origin
          , a.color
          , a.packing
          , a.standard_packing
          , a.selling_price
          , a.active_flg
          , b.product_cat_code
          , b.name product_cat_name
        from
          mst_product a
          left join mst_product_cat b
            on a.product_cat_id = b.product_cat_id
        where
          a.active_flg = '1'
          and a.selling_price > 0
      ";

        $sql .= $this->andWhereInt($param, 'product_id', 'a.product_id', $sqlParam);

        $productList = DB::select(DB::raw($sql), $sqlParam);

        return $productList;
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function selectProductByIds($ids)
    {
        $sql = "
        select
          a.product_id
          , a.supplier_id
          , a.product_cat_id
          , a.product_code
          , a.name
          , a.name_origin
          , a.color
          , a.packing
          , a.standard_packing
          , a.selling_price
          , a.active_flg
          , b.product_cat_code
          , b.name product_cat_name
        from
          mst_product a
          left join mst_product_cat b
            on a.product_cat_id = b.product_cat_id
        where
          a.active_flg = '1'
          and a.selling_price > 0
      ";

        if (count($ids) > 0) {
            $sql .= " and a.product_id in(" . implode(',', $ids) . ") ";
        }

        $productList = DB::select(DB::raw($sql), []);

        return $productList;
    }

    /**
     * Get list product can order for internal sales
     * @return [type] [description]
     */
    public function selectListCatForWeb()
    {
        $sqlParam = [];
        $sql      = "
        select
            a.product_cat_id
            , a.supplier_id
            , a.product_cat_code
            , a.name
            , a.name_origin
            , a.allow_order_flg
            , a.priority
        from
            mst_product_cat a
        where
            a.active_flg = 1
            and a.allow_order_flg = 1
        order by
            a.priority asc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Get list product can order for internal sales
     * @return [type] [description]
     */
    public function selectListProductHandle()
    {
        $sqlParam = [];
        $sql      = "
        select
          a.product_handle_id as handle_id
          , a.name
        from
          mst_product_handle a
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Get private list
     *
     * @return List
     */
    public function getPriceList()
    {
        $result       = [];
        $txtPriceList = $this->funcConfService->selectByKey(FuncConfService::CRM_PRICE_LIST, 'txt_val');

        if (!isset($txtPriceList) || strlen($txtPriceList) == 0) {
            return $result;
        }

        $lines = explode("\n", $txtPriceList);

        if (count($lines) == 0) {
            return $result;
        }

        $data = [];
        $curGroup;

        foreach ($lines as $line) {
            $text   = trim($line);
            $data[] = $text;

            if (starts_with($text, "##")) {
                $childGroup = [
                    "type"  => "CAT",
                    "name"  => trim(substr($text, 2)),
                    "items" => [],
                ];
                $result[count($result) - 1]["items"][] = $childGroup;

                $curGroup = &$result[count($result) - 1]["items"][count($result[count($result) - 1]["items"]) - 1]["items"];
            } elseif (starts_with($text, "#")) {
                $childGroup = [
                    "type"  => "CAT",
                    "name"  => trim(substr($text, 1)),
                    "items" => [],
                ];
                $result[] = $childGroup;
                $curGroup = &$result[count($result) - 1]["items"];
            } elseif (starts_with($text, "-")) {
                $childGroup = [
                    "type" => "PRODUCT",
                    "name" => trim(substr($text, 1)),
                ];
                $product = $this->selectProductByCode($childGroup["name"]);

                if (isset($product)) {
                    $childGroup["product_code"]     = $product->product_code;
                    $childGroup["name"]             = $product->name;
                    $childGroup["warranty_year"]    = $product->warranty_year;
                    $childGroup["color"]            = $product->color;
                    $childGroup["standard_packing"] = $product->standard_packing;
                    $childGroup["warning_qty"]      = $product->warning_qty;
                    $childGroup["selling_price"]    = $product->selling_price;

                    //$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
                    $code = substr($product->product_code, 0, 6);
                    $childGroup["img_url"]          = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
                }

                $curGroup[] = $childGroup;
            }

        }

        return $result;
    }

    /**
     * @param $productCode
     * @return mixed
     */
    public function selectProductByCode($productCode)
    {
        $sqlParam = [];
        $sql      = "
			select
                a.product_id
                , a.product_cat_id
                , a.supplier_id
                , a.product_code
                , a.name
                , a.warranty_year
                , a.color
                , a.standard_packing
                , a.selling_price
                , a.warning_qty
                , a.shopee_url
                , b.name product_cat_name
                , b.product_cat_code
			from
        mst_product a
        left join mst_product_cat b on b.product_cat_id = a.product_cat_id
			where
        a.active_flg = '1'
        and a.selling_price > 0
			  and a.product_code like ? ";

        $sqlParam[] = $productCode . '%';

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return null;
    }

    /**
     * @param $productCode
     * @return mixed
     */
    public function selectProductCatByCode($code)
    {
        $sqlParam = [];
        $sql      = "
			select
                a.product_cat_id
                , a.product_cat_code
                , a.name
                , a.name_origin
                , a.short_content
			from
        mst_product_cat a
			where
        a.active_flg = '1'
        and a.allow_order_flg = '1'
        and a.product_cat_code = ?
      limit 1
        ";

        $sqlParam[] = $code;

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return null;
    }

    public function getColorList()
    {
        return [
            ["color_id" => 1, "en_name" => "White"],
            ["color_id" => 2, "en_name" => "White Chrome"],
            ["color_id" => 3, "en_name" => "Chrome"],
            ["color_id" => 4, "en_name" => "TIC"],
            ["color_id" => 5, "en_name" => "Titanium"],
            ["color_id" => 6, "en_name" => "M.Black Chrome"],
            ["color_id" => 7, "en_name" => "White Grey"],
            ["color_id" => 8, "en_name" => "Mix"],
            ["color_id" => 9, "en_name" => "Charcoal"],
            ["color_id" => 10, "en_name" => "Charcoal Chrome"],
            ["color_id" => 11, "en_name" => "Green"],
            ["color_id" => 12, "en_name" => "Blue"],
            ["color_id" => 13, "en_name" => "Ivory"],
            ["color_id" => 14, "en_name" => "White Ivory"],
            ["color_id" => 15, "en_name" => "White Charcoal"],
            ["color_id" => 16, "en_name" => "Dark Grey"],
            ["color_id" => 17, "en_name" => "Dark Blue"],
            ["color_id" => 18, "en_name" => "Dark Ivory"],
            ["color_id" => 19, "en_name" => "Black"],
        ];
    }

    public function getPackingList()
    {
        return [
            ["packing_id" => 1, "en_name" => "OC bag"],
            ["packing_id" => 2, "en_name" => "PE bag"],
            ["packing_id" => 3, "en_name" => "Blister"],
            ["packing_id" => 4, "en_name" => "Box"],
            ["packing_id" => 5, "en_name" => "Bulkpacked"],
        ];
    }

    /**
     * Add image url to list product
     *
     * @param [type] $listProduct must contain product_code
     * @return Array add img_url to product item
     */
    public function addImageUrl($listProduct)
    {

        foreach ($listProduct as $product) {
            //$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
            $code = substr($product->product_code, 0, 6);
            $product->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
        }

        return $listProduct;
    }


    public function selectListProductCat1()
    {
        $sqlParam = [];
        $sql      = "
        select
          a.product_cat1_id,
          a.name
        from
          mst_product_cat1 a
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectListProductCat2()
    {
        $sqlParam = [];
        $sql      = "
        select
          a.product_cat2_id,
          a.name
        from
          mst_product_cat2 a
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
