<?php

namespace App\Services;

use DB;

class Crm0900Service extends BaseService
{
    /*
     * warehouse_change_type:
    + 1: input from factory
    + 2: output
    + 3:
    + 4:
    + 5: warranty product
    + 6: return product
     */
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
			, a.product_code
			, a.product_name
			, t.name as type_name1
			, h.name as type_name2
			, d.in_num as tk
			, d.out_num as xuat


			
	  	from
			mst_product a
		left join
			mst_product_cat1 t
			on t.product_cat1_id = a.product_cat1_id
		left join
			mst_product_cat2 h
			on h.product_cat2_id = a.product_cat2_id
		
		left join mst_supplier c
		  on a.supplier_id = c.supplier_id join (
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
			from
			  trn_warehouse_change a
			group by
			  a.product_id
			) d
			on a.product_id = d.product_id
	 		 where
			a.active_flg = '1'"
			;

		$sql .= $this->andWhereString($param, 'product_code', 'a.product_code', $sqlParam);
		$sql .= $this->andWhereString($param, 'product_name', 'a.product_name', $sqlParam);
		
        //return $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
