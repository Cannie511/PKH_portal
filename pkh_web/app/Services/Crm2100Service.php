<?php

namespace App\Services;

use DB;
use App\Models\MstStore;

/**
 * Crm2100Service class
 */
class Crm2100Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectAreaList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.area_id
                , a.name as area_name
                , a.parent_area_id
                , b.name as area_group_name
                , c.name as salesman_name
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , d.name as updated_by
                , a.version_no
            from
                mst_area a
                left join mst_area_group b
                    on a.area_group_id = b.area_group_id
                left join users c
                    on a.salesman_id = c.id
                left join users d
                    on a.updated_by = d.id
            where
                a.active_flg = '1'
        ";
        $sql .= $this->andWhereInt($param, 'area_group_id', 'b.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'area_name', 'a.name', $sqlParam);
        $result = $this->pagination($sql, $sqlParam, $param);

        return $result;
    }

    /**
     * @return mixed
     */
    public function selectGroupList()
    {
        $sqlParam = array();
        $sql      = "
          select
            a.area_group_id
            , a.name
            from
            mst_area_group a
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectAreaList2($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.area_id
               ,a.salesman_id
            from
                mst_area a
            where
                a.active_flg = '1'
        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $area1
     * @param $salemanId
     * @return mixed
     */
    public function updateSalesmanIdWithArea1(
        $area1,
        $salemanId
    ) {
        $count1 = MstStore::where('area1', $area1)->count();
        MstStore::where('area1', $area1)
            ->update(['salesman_id' => $salemanId]);

        return $count1;
    }

    /**
     * @param $area2
     * @param $salemanId
     * @return mixed
     */
    public function updateSalesmanIdWithArea2(
        $area2,
        $salemanId
    ) {
        $count2 = MstStore::where('area2', $area2)->count();
        MstStore::where('area2', $area2)
            ->update(['salesman_id' => $salemanId]);

        return $count2;
    }

    /**
     * @return mixed
     */
    public function implementAssigmentForSale()
    {
        $param    = [];
        $areaList = $this->selectAreaList2($param);
        $count    = 0;

        foreach ($areaList as $area) {

            if ($area->area_id < 64 && $area->area_id > 1) {
                $count += $this->updateSalesmanIdWithArea1($area->area_id, $area->salesman_id);
            } elseif ($area->area_id >= 64) {
                $count += $this->updateSalesmanIdWithArea2($area->area_id, $area->salesman_id);
            }

        }

        $result = [
            'count'  => $count,
            'status' => 1,
        ];

        return $result;
    }

}
