<?php

namespace App\Services;

/**
 * Crm0120Service class
 */
class Crm0120Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListCat($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.product_cat1_id as id
                , a.name  
                , b.name as supplier_name
                , c.name as type2_name
                
            from
                mst_product_cat1 a
            left join mst_supplier b on a.supplier_id = b.supplier_id
            left join mst_product_cat2 c on a.product_cat1_id = c.product_cat1_id

            where
                a.active_flg = 1
        ";
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
      
        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

}
