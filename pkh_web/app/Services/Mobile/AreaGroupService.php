<?php

namespace App\Services\Mobile;

use App\Services\BaseService;

class AreaGroupService extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {

        $sqlParam = [];
        $sql      = "
		select
	    	a.area_group_id
	    	, a.name
	    	, a.payment_day
	    	, a.active_flg
	    	, a.created_at
	    	, a.created_by
	    	, a.updated_at
	    	, a.updated_by
	    	, a.version_no
	    from
	    	mst_area_group a
		where
			  a.active_flg = '1'
		order by
			a.area_group_id
        ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
