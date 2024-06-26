<?php

namespace App\Services;

use DB;
use Log;
use Auth;
use App\Models\TrnWarehouseChange;

class Bat0912Service extends BaseService
{
    /**
     * @param $id
     */
    private function selectWarehouseEximDetailList($id)
    {
        $sqlParam = array();
        $sql      = "
        select
                a.warehouse_exim_id
                , a.product_id
                , a.amount
                , a.unit_price
        from
            trn_warehouse_exim_detail a
        where
            a.active_flg = '1' and a.warehouse_exim_id = ?
        ";
        $sqlParam[] = $id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    private function selectWarehouseEximList()
    {
        $sqlParam = array();
        $sql      = "
        select
        d.warehouse_exim_id
        , d.from_warehouse_id
        , d.to_warehouse_id
       ,  d.changed_date
    from
        (
          select
                    a.product_id
                    , a.warehouse_exim_id
                    , b.from_warehouse_id
                    , b.to_warehouse_id
                    , a.changed_date
                    , count(*)
                from
                    trn_warehouse_change a left join trn_warehouse_exim b
                    on a.warehouse_exim_id = b.warehouse_exim_id
                where
                    a.warehouse_change_type in ('7','8')
                group by
                    a.product_id
                    , a.warehouse_exim_id
                having
                    count(*) > 2
        )
        d
    group by
        d.warehouse_exim_id
        , d.from_warehouse_id
        , d.to_warehouse_id
        ,  d.changed_date
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function fixDuplicate()
    {
        $list = $this->selectWarehouseEximList();
        $flag = 1;
        $user = Auth::user();

        foreach ($list as $item) {
            #Delete all records which have duplicate warehouse exim id
            TrnWarehouseChange::where('warehouse_exim_id', $item->warehouse_exim_id)->delete();

            #Set up parameter for create new records
            $param                 = [];
            $param['branch_id']    = 1;
            $param['id']           = $item->warehouse_exim_id;
            $param['warehouse_id'] = $item->from_warehouse_id;
            $param['changed_date'] = $item->changed_date;
            $type                  = 8;

// Export type
            #Create records exporting from warehouse A
            $this->saveDataInWarehouseChange($flag, $user, $param, $type);
            $type                  = 7; // Import type
            $param['warehouse_id'] = $item->to_warehouse_id;
            #Create records importing to warehouse B
            $this->saveDataInWarehouseChange($flag, $user, $param, $type);
        }

    }

    /**
     * @param $user
     * @param $param
     * @param $type
     * @return mixed
     */
    private function makeDataForWarehouseChange(

        $user
        ,
        $param
        ,
        $type

    ) {

// $today1           = ;
        // $today            = date('Y-m-d', strtotime(Carbon::now()));
        $details    = $this->selectWarehouseEximDetailList($param['id']);
        $listDetail = array();

        foreach ($details as $item) {
            $object                        = new TrnWarehouseChange();
            $object->product_id            = $item->product_id;
            $object->changed_date          = $param['changed_date'];
            $object->warehouse_change_type = $type;
            $object->warehouse_id          = $param['warehouse_id'];
            $object->branch_id             = $param['branch_id'];
            $object->amount                = intval($item->amount);
            $this->updateRecordHeader($object, $user, true);
            $listDetail[] = $object;
        }

        return $listDetail;
    }

/*
$flag: to determine which reference_id the system choose to assign value ex: warehouse_exim_id, store_delivery_id, ..
$user: get name, user_id and branch_id
$param: get list of products (product_id, amount, name)
$warehouse_id: decide which warehouse to add or remove product.
$ref_id: value of reference_id
 */
    /**
     * @param $flag
     * @param $user
     * @param $param
     * @param $type
     * @return int
     */
    public function saveDataInWarehouseChange(
        $flag,
        $user,
        $param,
        $type
    ) {
        $listDetail = $this->makeDataForWarehouseChange($user, $param, $type);
        Log::debug('----------- check saveDataInWarehouseChange--------');
        Log::debug($listDetail);

        if (!$listDetail) {
            return 0;
        }

        $ref_id = $param['id'];
        DB::transaction(function () use ($listDetail, $ref_id, $flag) {

// Create detail
            foreach ($listDetail as $detail) {
                switch ($flag) {
                    case 1:
                        Log::debug($detail);
                        $detail->warehouse_exim_id = $ref_id;
                        break;
                }

                $detail->save();
            }

        });
    }

    /**
     * @param $checkedDate
     */
    public function findDuplicate()
    {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id
            , a.warehouse_exim_id
            , count(*)
        from
            trn_warehouse_change a
        where
            a.warehouse_change_type in ('7','8')
        group by
            a.product_id
            , a.warehouse_exim_id
        having
            count(*) > 2
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function findDuplicate2()
    {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id
            , a.store_delivery_id
            , count(*)
        from
            trn_warehouse_change a
        where
            a.warehouse_change_type in ('2') and  a.store_delivery_id is not null
        group by
            a.product_id
            , a.store_delivery_id
        having
            count(*) > 1
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function findDuplicate3()
    {
        $sqlParam = array();
        $sql      = "
        select
            a.product_id
            , a.import_wh_factory_id
            , count(*)
        from
            trn_warehouse_change a
        where
            a.warehouse_change_type in ('1') and  a.import_wh_factory_id is not null
        group by
            a.product_id
            , a.import_wh_factory_id
        having
            count(*) > 1
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
