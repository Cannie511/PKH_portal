<?php

namespace App\Services;

use DB;
/**
 * Crm3020Service class
 */
class Crm3020Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql = "select * from mst_store where 1=1 ";
        $sql .= $this->andWhereInt($param, 'store_id', 'store_id', $sqlParam);
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) == 0) {
            return null;
        }

        return $list[0];  
    }
}