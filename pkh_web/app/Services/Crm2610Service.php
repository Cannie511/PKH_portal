<?php

namespace App\Services;

use DB;

/**
 * Crm2610Service class
 */
class Crm2610Service extends BaseService
{
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
        a.product_cat_id,
        a.product_id
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
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectSoldProduct($param)
    {
        $sqlParam = [];
        $sql      = "
			select
			    a.product_id
			    , SUM(a.amount) as amount
			    , SUM(a.amount * a.unit_price) as money
			from trn_store_delivery_detail a
			join trn_store_delivery b
				on b.store_delivery_id = a.store_delivery_id
			where
                b.delivery_sts in (0, 1, 2, 3, 4)
                and a.active_flg = 1
		";

        $sql .= $this->andWhereInt($param, 'store_id', 'b.store_id ', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'b.delivery_date', $sqlParam);

        $sql .= "
			group by
                a.product_id
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
