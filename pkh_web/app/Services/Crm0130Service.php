<?php

namespace App\Services;

use DB;

class Crm0130Service extends BaseService
{
    /**
     * @param $param
     */
    public function selectListProduct($param)
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
                , a.selling_price_sample
                , a.active_flg
                , b.product_cat_code
                , b.name product_cat_name
                , c.supplier_code
                , c.name supplier_name
                , d.in_num
                , d.out_num
                , d.in_num_edit
			    , d.out_num_edit
                , (d.in_num + d.in_num_edit - d.in_num_edit - d.out_num_edit ) as amount_remain
                , e.in_order
            from
                mst_product a
            left join mst_product_cat b
                on a.product_cat_id = b.product_cat_id
            left join mst_supplier c
                on a.supplier_id = c.supplier_id 
            join (
                select
                    a.product_id
                    , sum(
                    case
                        when a.warehouse_change_type = 1
                        then amount
                        else 0
                        end
                    ) in_num
                    , sum(
                    case
                        when a.warehouse_change_type = 2
                        then amount
                        else 0
                        end
                    ) out_num
                    , sum(
					  case
						when a.warehouse_change_type = 3
						then amount
						else 0
						end
					) in_num_edit
					, sum(
					  case
						when a.warehouse_change_type = 4
						then amount
						else 0
						end
					) out_num_edit
                from
                    trn_warehouse_change a
                group by
                    a.product_id
                ) d
                on a.product_id = d.product_id
            left join (
                select
                a.product_id
                , sum(a.amount) in_order
                from
                trn_store_order_detail a join trn_store_order b
                    on a.store_order_id = b.store_order_id
                    and b.order_sts in ('0', '1')
                group by
                a.product_id
            ) e
                on e.product_id = a.product_id
            where
                a.active_flg = '1'
                and a.selling_price > 0
			";

        $sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'stock_code', 'a.stock_code', $sqlParam);

        $sql .= "
  			order by a.product_code
          ";

        //return $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
