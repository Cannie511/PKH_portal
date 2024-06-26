<?php

namespace App\Services;

use DB;
use File;
use Cache;
use Excel;
use Carbon\Carbon;
use App\Models\MstProduct;
use App\Models\TrnProductPriceHis;

class Crm0100Service extends BaseService
{
    /**
     * Undocumented function
     *
     * @param [type] $param
     * @return List product
     */
    public function selectListProduct($param)
    {

        $sqlParam = array();
        $sql      = "
            select
         
                a.updated_at
                , a.product_id
                , a.color
                , a.pakaging
                , a.product_cat1_id
                , a.product_cat2_id
                , a.describes
                , a.product_code
                , a.product_name
                , a.selling_price
                , a.import_price
                , a.supplier_id
                , b.name as typename1
                , c.name as typename2
                , d.supplier_code as supplier_code
                , d.name as supplier_name
                , a.pakagingType
               
            from
                mst_product a
            left join
                mst_product_cat1 b ON
                a.product_cat1_id = b.product_cat1_id
            left join
                mst_product_cat2 c ON
                a.product_cat2_id = c.product_cat2_id
            left join
                mst_supplier d on
                a.supplier_id = d.supplier_id
            where
                a.active_flg = '1'
			";

        if (isset($param['download']) && 1 == $param['download']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        
        $sql .= $this->andWhereInt($param, 'product_cat1_id', 'a.product_cat1_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'product_cat2_id', 'a.product_cat2_id', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'color_id', 'a.color_id', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'packing_id', 'a.packing_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'product_name', 'a.product_name', $sqlParam);
       

        $sql .= $this->getOrderBy($param);

        $result = $this->pagination($sql, $sqlParam, $param);
        // $list = DB::select(DB::raw($sql), $sqlParam);
        $list = $result->items();

        if (isset($list) && !empty($list)) {

            foreach ($list as $item) {
                // $item->imgUrl = "/img/product/".$item->product_code.".png";
                // Special code for Watertec;
                //$code = $item->supplier_id == 1 ? substr($item->product_code, 0, 6) : $item->product_code;
                $code = substr($item->product_code, 0, 6);
                $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
            }

        }

        return $result;
    }

    /**
     * Update price product
     *
     * @param [type] $params
     *  + product_id
     *  + selling_price
     *  + selling_price_sample
     *  + selling_price_tax
     * @return Object result
     */
    public function updatePrice($params)
    {
        $logonUser = $this->logonUser();

        // Change price
        MstProduct::where('product_id', $params['product_id'])
            ->update([
                'import_price'       => $params['import_price'],
                'selling_price'        => $params['selling_price'],
                
                'updated_at'           => Carbon::now(),
                'updated_by'           => $logonUser->id,
            ]);

        // TODO: Add to history
       
       
        return [
            "rtnCd" => true,
            "msg"   => "Đã cập nhật thành công",
        ];
    }

    /**
     * @return mixed
     */
    public function download()
    {

        $param = [
            'download' => 1,
        ];

        $data = $this->selectListProduct($param);

        // Create path if not exist
        $path = config('constants.DOWNLOAD_DIR');
        $path = storage_path($path);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "ProductList_" . date('ymdhis');
        $ext      = "xlsx";

        Excel::create($fileName, function ($excel) use ($data) {
            $excel->sheet('ProductList', function ($sheet) use ($data) {
                $sheet->loadView('admin.excels.crm0100-list')
                    ->with('data', $data);
            });
        })->store($ext, $path);

        $fullPath = $path . '/' . $fileName . '.' . $ext;
        $key      = $fileName . '.' . $ext;
        Cache::put($key, $fullPath, config('constants.DOWNLOAD_EXPIRE_MIN'));

        $result = [
            'rtnCd' => 0,
            'file'  => $key,
            'test'  => Cache::get($key),
        ];

        return $result;
    }

    public function selectTopSaleProduct()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.product_id
                , sum(a.amount) as amount
            from
                trn_store_delivery_detail a
                left join mst_product b
                    on a.product_id = b.product_id
            group by
                a.product_id
            order by
                sum(a.amount) desc
			";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectAllProduct()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.product_id
            from
                mst_product a
			";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function makePriority()
    {
        $topSaleProduct = $this->selectTopSaleProduct();
        $allProduct     = $this->selectAllProduct();
        $product        = [];
        $rank           = 1000;

        foreach ($allProduct as $item) {
            $product[$item->product_id]["rank"] = $rank;
            $product[$item->product_id]["id"]   = $item->product_id;
        }

        $rank = 1;

        foreach ($topSaleProduct as $item) {
            $product[$item->product_id]["rank"] = $rank;
            $product[$item->product_id]["id"]   = $item->product_id;
            $rank += 1;
        }

//Log::debug('------------check rank------------');
        foreach ($product as $pro) {
            //og::debug($pro);
            MstProduct::where('product_id', $pro["id"])
                ->update([
                    'priority_degree' => $pro["rank"],
                ]);
        }

    }

}
