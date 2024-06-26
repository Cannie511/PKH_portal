<?php

namespace App\Services;

use DB;
use Carbon\Carbon;

// use App\Models\TrnStoreDeliveryDetail;

/**
 * Crm0321Service.
 * Phân cấp cửa hàng
 */
class Crm0321Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectListStore($param)
    {
        $sqlParam = [];
        $sql      = "
             select
               a.store_id
               , a.year
               , a.month
               , a.store_rank
               , a.order_total
               , a.order_total_with_discount
               , a.delivery_total
               , a.delivery_total_with_discount
               , a.payment
               , b.name store_name
               , b.address
               , e.name area_group_name
               , c.name area1_name
               , d.name area2_name
               , f.name salesman_name
             from
               trn_store_rank a
               join mst_store b
                 on a.store_id = b.store_id
               left join mst_area c
                 on b.area1 = c.area_id
               left join mst_area d
                 on d.area_id = b.area2
               left join mst_area_group e
                 on e.area_group_id = c.area_group_id
               left join users f
                 on f.id = b.salesman_id
             where
               a.active_flg = '1'
			 ";

        // Search on year
        $param["month"] = date('Y-m');
        $numOfMonth     = 6;

        $date       = Carbon::parse($param["month"] . "-01");
        $oneYearAgo = $date->subMonth($numOfMonth);

        $oneYearAgoInt = $oneYearAgo->year + $oneYearAgo->month / 100;

        $sql .= ' and (a.year + a.month / 100) >= ?';
        $sqlParam[] = $oneYearAgoInt;

        // Seart other
        $sql .= $this->andWhereInt($param, 'sale_id', 'b.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'b.name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'areaGroup', 'e.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'b.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'b.area2', $sqlParam);
        $sql .= $this->andWhereInt($param, 'salesman', 'b.salesman_id', $sqlParam);

        $sql .= "
            order by
                c.area_group_id
                , b.area1
                , b.area2
                , b.name
                , a.year
                , a.month
                , a.store_rank
        ";

        $resultSet = DB::select(DB::raw($sql), $sqlParam);
        // return $this->pagination($sql, $sqlParam, $param);

        $listStore = array();

        foreach ($resultSet as $record) {

            if (!isset($listStore[$record->store_id])) {
                $listStore[$record->store_id] = [
                    "store_id"        => $record->store_id,
                    "store_name"      => $record->store_name,
                    "address"         => $record->address,
                    "area_group_name" => $record->area_group_name,
                    "area1_name"      => $record->area1_name,
                    "area2_name"      => $record->area2_name,
                    "salesman_name"   => $record->salesman_name,
                    "items"           => [],
                ];

                $runMonth = Carbon::create($oneYearAgo->year, $oneYearAgo->month, 1);

                for ($i = 0; $i < $numOfMonth; $i++) {
                    $runMonth                                = $runMonth->addMonth(1);
                    $listStore[$record->store_id]["items"][] = [
                        'date'                         => $runMonth->format('Y-m-d'),
                        "order_total"                  => 0,
                        "order_total_with_discount"    => 0,
                        "delivery_total"               => 0,
                        "delivery_total_with_discount" => 0,
                        "payment"                      => 0,
                        "store_rank"                   => 6,
                    ];
                }

            }

            $store      = $listStore[$record->store_id];
            $recoreDate = Carbon::create($record->year, $record->month, 1);
            $dateString = $recoreDate->format('Y-m-d');

            for ($i = 0; $i < $numOfMonth; $i++) {

                if ($store["items"][$i]["date"] == $dateString) {
                    $listStore[$record->store_id]["items"][$i]["order_total"]                  = $record->order_total;
                    $listStore[$record->store_id]["items"][$i]["order_total_with_discount"]    = $record->order_total_with_discount;
                    $listStore[$record->store_id]["items"][$i]["delivery_total"]               = $record->delivery_total;
                    $listStore[$record->store_id]["items"][$i]["delivery_total_with_discount"] = $record->delivery_total_with_discount;
                    $listStore[$record->store_id]["items"][$i]["payment"]                      = $record->payment;

                    if (0 == $record->store_rank) {
                        $listStore[$record->store_id]["items"][$i]["store_rank"] = 6;
                    } else {
                        $listStore[$record->store_id]["items"][$i]["store_rank"] = $record->store_rank;
                    }

                    break;
                }

            }

        }

        $listStore2 = [];

        foreach ($listStore as $store) {
            $listStore2[] = $store;
        }

        return $listStore2;

    }

}
