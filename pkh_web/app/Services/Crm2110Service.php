<?php

namespace App\Services;

use DB;
use App\Models\MstArea;

/**
 * Crm2110Service class
 */
class Crm2110Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectArea($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            a.area_id
            , a.name as area_name
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
        where
            a.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'area_id', 'a.area_id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveArea(
        $user,
        $param
    ) {
        $area   = null;
        $status = false;

        if (isset($param['area_id']) && ($param['area_id'] > 0)) {
            $area = MstArea::find($param['area_id']);
            $this->updateRecordHeader($area, $user, false);
        } else {
            $area = new MstArea();
            $this->updateRecordHeader($area, $user, true);
        }

        if (null != $area) {
            $area->name          = $param['area_name'];
            $area->area_group_id = $param['area_group_id'];
            $area->salesman_id   = $param['salesman_id'];
            DB::transaction(function () use ($area) {
                $area->save();
            });
            $status = true;
        }

        $res = [
            "status"  => $status,
            "area_id" => $area,
        ];

        return $res;
    }

}
