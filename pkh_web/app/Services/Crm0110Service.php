<?php

namespace App\Services;

use DB;
use Image;
use App\Models\MstProduct;
use App\Models\MstSupplier;

class Crm0110Service extends BaseService
{
    /**
     * Load product
     */
    public function loadProduct($productId)
    {
        $sqlParam = array();
        $sql      = "
            select
               a.product_id
               ,a.product_cat1_id
               ,a.product_cat2_id
               ,a.supplier_id
               ,a.product_name as name
               ,a.product_code
               ,a.describes
               ,a.color
               ,a.pakaging
               ,a.import_price
               ,a.selling_price
               ,a.pakagingType
               ,a.warranty
               from
                mst_product a
            where
                a.product_id = ?
        ";
        $sqlParam[] = $productId;

        $list    = DB::select(DB::raw($sql), $sqlParam);
        $product = null;

        if (isset($list) && !empty($list)) {
            $product         = $list[0];
            $product->imgUrl = "/img/product/" . $product->product_code . ".png";
        }

        return $product;
    }

    /**
     * Save product
     */
    public function save($params)
    {

        if (0 == $params['product_id']) {
            return $this->create($params);
        } else {
            return $this->update($params);
        }

    }

    /**
     * @param $img
     * @return mixed
     */
    public function uploadFile($img)
    {

// Log::debug('*************upload***************');
        // Log::debug(print_r($img, true));
        $imagePath = "";

        if (isset($img['file'])) {
            // TODO: change it for your logic
            $imageFileName = $img['title'] . ".png";
            $imagePath     = public_path() . "/img/product/" . $imageFileName;
            //$imagePathThumb         = public_path() . "/frontend/img/news/thumb/" . $imageFileName;
            $image = Image::make($img['file']);

//$thumb                  = Image::make($img['file'])

//->resize(null, 100, function ($constraint) {

//    $constraint->aspectRatio();
            //});
            $image->save($imagePath);
            //$thumb->save($imagePathThumb);
        }

        return $imagePath;
    }

    /**
     * @param $params
     */
    public function create($params)
    {
        $logonUser = $this->logonUser();

        $entity                 = new MstProduct();
        $entity->supplier_id    = $params['supplier_id'];
        $entity->product_cat1_id = $params['product_cat1_id'];
        $entity->product_cat2_id = $params['product_cat2_id'];
        $entity->product_code = $params['product_code'];
        $entity->product_name          = $params['name'];
        $entity->color           = $params['color'];
        $entity->pakaging    = $params['pakaging'];
        $entity->pakagingType    = $params['pakagingType'];
        $entity->warranty    = $params['warranty'];
        

       
      

        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();

        // // Select count product by Supplier
        // $countProduction = MstProduct::where('supplier_id', $params['supplier_id'])->count();
        // // count next product index
        // $countProduction++;

        // Update code for Watertec
       
   

        return [
            'rtnCd' => true,
            'msg'   => "Đã thêm sản phẩm $entity->product_code",
        ];
    }

    /**
     * @param $params
     */
    public function update($params)
    {
        $logonUser = $this->logonUser();

        $entity = MstProduct::find($params['product_id']);

        if (!isset($entity)) {
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy sản phẩm.',
            ];
        }

        $entity->supplier_id    = $params['supplier_id'];
        $entity->product_cat1_id = $params['product_cat1_id'];
        $entity->product_cat2_id = $params['product_cat2_id'];
        $entity->product_code = $params['product_code'];
        $entity->product_name          = $params['name'];
        $entity->color           = $params['color'];
        $entity->pakaging    = $params['pakaging'];
        $entity->pakagingType    = $params['pakagingType'];
        $entity->warranty    = $params['warranty'];
        

        $this->updateRecordHeader($entity, $logonUser, false);
        $entity->save();

        return [
            'rtnCd' => true,
            'msg'   => "Đã cập nhật sản phẩm $entity->product_code",
        ];
    }

    public function loadInit()
    {
        // Load list supplier
        $listSupplier = $this->loadListSupplier();

        // Load list product cat
        $listCat1 = $this->selectListProductCat1();
        $listCat2 = $this->selectListProductCat2();

        // Load list packing
        $listPacking = $this->loadListPacking();

        return [
            "listSupplier"   => $listSupplier,
            "listCat1" => $listCat1,
            "listCat2" => $listCat2,
        
        ];
    }

    private function loadListPacking()
    {
        $sqlParam = [];
        $sql      = "
            select
                a.packaging_id
                , a.name
            from
                mst_packaging a
            where
                a.active_flg = 1
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    private function loadListSupplier()
    {
        $sqlParam = [];
        $sql      = "
            select
              a.supplier_id
              , a.name
              , a.supplier_code
            from
              mst_supplier a
            where
              a.active_flg = '1'
        ";

        return DB::select(DB::raw($sql), $sqlParam);
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
       
       
        "
       
        ;

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
