<?php

namespace App\Services;

use DB;
use App\Models\MstArea;

class AreaService extends BaseService
{
    public function selectListAreaGroup()
    {
        $sql = "
			select
			  area_group_id,
  			  name
			from
			  mst_area_group
			order by
			  area_group_id
			";

        return DB::select(DB::raw($sql));
    }

    /**
     * Select list province
     * @return [type] [description]
     */
    public function selectListArea1()
    {
        $sql = "
			select
			  area_id,
  			  name,
              area_group_id
			from
			  mst_area
			where
			  parent_area_id is null
			order by
			  area_id
			";

        return DB::select(DB::raw($sql));
    }

    /**
     * Select list area 2
     * @return [type] [description]
     */
    public function selectListArea2($area1 = null)
    {

        $param = [
            'area1' => $area1,
        ];

        $sqlParam = [];
        $sql      = "
			select
			  area_id
			  , name
			  , parent_area_id
			from
			  mst_area
			where
			  parent_area_id is not null
			";

        $sql .= $this->andWhereInt($param, 'area1', 'parent_area_id', $sqlParam);

        $sql .= "
			order by
			  area_id
		";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Get salesman_id by area
     * @return [type] [description]
     */
    public function getSalemanIdByArea(
        $area1Id,
        $area2Id
    ) {

//         Set salesman for store according to area

// $salesAreaMap = config('constants.SALE_AREA');

// $result = null;

// foreach ( $salesAreaMap as $item ) {

//     if( in_array($area1, $item['areas']) ||

//           in_array($area2, $item['areas']) ) {

//         $result = $item['salesman_id'];

//     }

// }

// return $result;

// Get from db
        if (null != $area2Id) {
            $area2 = MstArea::find($area2Id);
            if (null != $area2 && null != $area2->salesman_id) {
                return $area2->salesman_id;
            }

        }

        if (null != $area1Id) {
            $area1 = MstArea::find($area1Id);
            if (null != $area1 && null != $area1->salesman_id) {
                return $area1->salesman_id;
            }

        }

        return null;
    }

}
