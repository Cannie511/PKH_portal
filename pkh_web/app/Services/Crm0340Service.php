<?php

namespace App\Services;

use DB;
use App\Models\MstArea;
use App\Models\MstStore;
use App\Models\TrnPayment;
use App\Models\TrnStoreOrder;
use App\Models\TrnStoreDelivery;

/**
 * Crm0340Service class
 */
class Crm0340Service extends BaseService
{
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
     * @param $param
     * @param $user
     * @return mixed
     */
    public function assignCase1(
        $param,
        $user
    ) {
        $salemanId = $param['saleman_id'];
        $cart      = $param['cart'];
        $group1    = []; //areaID< 64
        $group2    = []; //areaID>=64 (quận huyện TP)
        $count     = 0;

        foreach ($cart as $item) {
            MstArea::where('area_id', $item["area_id"])
                ->update(['salesman_id' => $salemanId]);

            if ($item["area_id"] < 64 && $item["area_id"] > 1) {
                $count += $this->updateSalesmanIdWithArea1($item["area_id"], $salemanId);
            } elseif ($item["area_id"] >= 64) {
                $count += $this->updateSalesmanIdWithArea2($item["area_id"], $salemanId);
            }

        }

        // status : 1 = success, 0 = fail
        $result = [
            'count'  => $count,
            'status' => 1,
        ];

        return $result;
    }

    /**
     * @param $param
     * @param $user
     */
    public function assignCase2(
        $param,
        $user
    ) {}

    /**
     * @param $param
     * @param $user
     * @return mixed
     */
    public function assignStore2User(
        $param,
        $user
    ) {
        $result = null;

        if (isset($param['openTable1']) && -1 == $param['openTable1']) {
            $result = $this->assignCase1($param, $user);
        } elseif (isset($param['openTable2']) && -1 == $param['openTable2']) {
            $result = $this->assignCase2($param, $user);
        }

        return $result;
    }

    public function selectListArea()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.name
                , a.area_id
            from
                mst_area a
                left join mst_area_group b
                    on a.area_group_id = b.area_group_id
            where
                a.area_id != 1
            order by
                b.area_group_id asc
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function mergeStore($param)
    {
        $validID = intval($param["store_valid"]);
        $fakeID  = intval($param["store_fake"]);
        $result  = [];

        if (0 == $validID || 0 == $fakeID) {
            $result = [
                'status' => 0,
            ];

            return $result;
        }

        TrnStoreOrder::where('store_id', $fakeID)
            ->update(['store_id' => $validID]);
        TrnStoreDelivery::where('store_id', $fakeID)
            ->update(['store_id' => $validID]);
        TrnPayment::where('store_id', $fakeID)
            ->update(['store_id' => $validID]);
        MstStore::where('store_id', $fakeID)
            ->update(['active_flg' => 0]);
        $result = [
            'status' => 1,
        ];

        return $result;
    }

}
