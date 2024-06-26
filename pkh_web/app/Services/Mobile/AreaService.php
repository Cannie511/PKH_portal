<?php

namespace App\Services\Mobile;

use App\Services\BaseService;

class AreaService extends BaseService
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
			a.area_id
			, a.name
			, a.parent_area_id
			, a.area_group_id
			, a.salesman_id
			, a.active_flg
			, a.created_at
			, a.created_by
			, a.updated_at
			, a.updated_by
			, a.version_no
		  from
			mst_area a
		  order by area_group_id, parent_area_id, area_id
        ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
