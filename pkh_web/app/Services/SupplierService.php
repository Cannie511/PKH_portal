<?php

namespace App\Services;

use DB;
use App\Services\FuncConfService;

/**
 * Product Service
 */
class SupplierService extends BaseService
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

    public function selectSupplierDropDown()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_id
                , a.name
                , a.supplier_code
            from
                mst_supplier a
        ";

        $result = array();

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function selectSupplierById($id)
    {
		$sqlParam = [];
        $sql      = "
			select
				a.supplier_id,
                a.name
		
			from
			  mst_supplier a
			  
            where
			  a.active_flg = '1'
              and a.supplier_id = ?
			  
		";

        $sqlParam[] = $id;
        $result = DB::select(DB::raw($sql), $sqlParam);
        // Log::debug($result);
        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return $result;
    }
}
