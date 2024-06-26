<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\TrnWarehouseChange;
use App\Models\TrnCheckWarehouseDetail;

class Crm0913Service extends BaseService
{
    /**
     * @param $check_date
     * @return mixed
     */
    public function selectList($check_date)
    {

// $sqlParam[] = $param['productActive'];

// $sqlParam = array();
        // Log::debug('*************baobao***************');
        Log::debug(print_r($check_date, true));
        $date       = Carbon::createFromFormat('Y-m-d', $check_date);
        $next_date  = Carbon::createFromFormat('Y-m-d', $check_date);
        $date_check = $date;
        //$next_date->addDay();
        Log::debug(print_r($date, true));
        Log::debug(print_r($next_date, true));
        $sqlParam = [
            $date_check->format('Y-m-d'),
            $date->format('Y-m-d'),
            $next_date->format('Y-m-d'),
        ];
        $sql = "
            select
                product_id
                , product_code
                , stock_code
                , name
                , product_cat_name
                , sum(case type when 1 then num else 0 end) start_num
                , sum(case type when 2 then in_num else 0 end) in_num
                , sum(case type when 2 then in_num_edit else 0 end) in_num_edit
                , sum(case type when 2 then out_num else 0 end) out_num
                , sum(case type when 2 then out_num_edit else 0 end) out_num_edit
              from
                (
                  select
                    1 type
                    , a.product_id
                    , a.product_code
                    , a.stock_code
                    , a.name
                    , b.name product_cat_name
                    , d.in_num
                    , d.out_num
                    , d.in_num_edit
                    , d.out_num_edit
                    , (
                      d.in_num + d.in_num_edit - d.out_num - d.out_num_edit
                    ) num
                  from
                    mst_product a
                    left join mst_product_cat b
                      on a.product_cat_id = b.product_cat_id
                    left join mst_supplier c
                      on a.supplier_id = c.supplier_id join (
                        select
                          a.product_id
                          , sum(
                            case
                              when a.warehouse_change_type in (1,5,6)
                                then amount
                              else 0
                              end
                          ) in_num
                          , sum(
                            case
                              when a.warehouse_change_type = 2
                                then amount
                              else 0
                              end
                          ) out_num
                          , sum(
                            case
                              when a.warehouse_change_type = 3
                                then amount
                              else 0
                              end
                          ) in_num_edit
                          , sum(
                            case
                              when a.warehouse_change_type = 4
                                then amount
                              else 0
                              end
                          ) out_num_edit
                        from
                          trn_warehouse_change a
                        where
                          a.changed_date < ?
                        group by
                          a.product_id
                      ) d
                      on a.product_id = d.product_id
                  where
                    a.active_flg = '1'
                  union
                  select
                    2 type
                    , a.product_id
                    , a.product_code
                    , a.stock_code
                    , a.name
                    , b.name product_cat_name
                    , d.in_num
                    , d.out_num
                    , d.in_num_edit
                    , d.out_num_edit
                    , (
                      d.in_num + d.in_num_edit - d.out_num - d.out_num_edit
                    ) num
                  from
                    mst_product a
                    left join mst_product_cat b
                      on a.product_cat_id = b.product_cat_id
                    left join mst_supplier c
                      on a.supplier_id = c.supplier_id join (
                        select
                          a.product_id
                          , sum(
                            case
                              when a.warehouse_change_type in (1,5,6)
                                then amount
                              else 0
                              end
                          ) in_num
                          , sum(
                            case
                              when a.warehouse_change_type = 2
                                then amount
                              else 0
                              end
                          ) out_num
                          , sum(
                            case
                              when a.warehouse_change_type = 3
                                then amount
                              else 0
                              end
                          ) in_num_edit
                          , sum(
                            case
                              when a.warehouse_change_type = 4
                                then amount
                              else 0
                              end
                          ) out_num_edit
                        from
                          trn_warehouse_change a
                          left join trn_store_delivery b
                            on a.store_delivery_id = b.store_delivery_id
                        where
                          a.changed_date between ? and ?
                          and (
                            b.delivery_sts is null
                            or b.delivery_sts in ('0', '1', '2', '4')
                          )
                        group by
                          a.product_id
                      ) d
                      on a.product_id = d.product_id
                  where
                    a.active_flg = '1'
                ) temp
              group by
                (product_id)
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);
        // $result = null;

        return $result;
    }

    /**
     * @param $check_date
     */
    public function selectListProduct(
        $check_date,
        $warehouse_id
    ) {
        $sqlParam = array();
        $sql      = "
                select
                  a.product_id
                  , a.product_code
                  , a.name
                  , a.selling_price
                  , b.amount
                  , b.notes_2
                  , b.check_warehouse_id
                from
                  mst_product a
                  left join trn_check_warehouse_detail b
                    on a.product_id = b.product_id
                  left join trn_check_warehouse c
                    on b.check_warehouse_id = c.id
                where
                  a.active_flg = '1'
                  and c.check_date = ?
                  and c.warehouse_id = ?
			          ";
        $sql .= "
                  order by a.product_code
                  , b.updated_at asc
                ";
        $sqlParam[] = $check_date;
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $data1
     * @param $data2
     * @return mixed
     */
    public function getList(
        $data1,
        $data2
    ) {

        foreach ($data1 as $item1) {

// Log::debug("********************DATA1:");

// Log::debug(print_r($item1->product_id, true));
            foreach ($data2 as $item2) {
                if ($item1->product_id == $item2->product_id) {
                    $item1->amount = $item2->amount;

// $item1->differrence = parseInt($item1->start_num) - parseInt($item1->amount)
                    //   + parseInt($item1->in_num) + parseInt($item1->in_num_edit) - parseInt($item1->out_num) - parseInt($item1->out_num_edit);
                    $item1->differrence = ($item1->start_num) - ($item1->amount)
                     + ($item1->in_num) + ($item1->in_num_edit) - ($item1->out_num) - ($item1->out_num_edit)
                     + $item1->in_num_warehouse - $item1->out_num_warehouse
                     + $item1->in_num_warranty + $item1->in_num_return;
                    $item1->notes    = $item2->notes_2;
                    $item1->check_id = $item2->check_warehouse_id;
                }

            }

        }

        return $data1;
    }

    /**
     * @param $param
     */
    public function updateNotes($param)
    {
        $logonUser = $this->logonUser();
        Log::debug("********************param:*******************");
        Log::debug(print_r($param, true));

        foreach ($param as $item) {

            if (isset($item['notes'])) {
                TrnCheckWarehouseDetail::where([['product_id', $item['product_id']], ['check_warehouse_id', $item['check_id']]])
                    ->update([
                        'notes_2'    => $item['notes'],
                        'updated_at' => Carbon::now(),
                        'updated_by' => $logonUser->id,
                    ]);
            }

        }

        return [
            "rtnCd" => true,
            "msg"   => "Đã cập nhật thành công",
        ];
    }

    /**
     * @param $value
     * @param $product_id
     * @param $date
     * @return null
     */
    public function createEditChangeForWareHouse(
        $warehouse_id,
        $value,
        $product_id,
        $date
    ) {

        if (0 == $value) {
            return;
        }

        $instance = new TrnWareHouseChange();

        if ($value > 0) {
            $type = 3;
        } else {
            $type  = 4;
            $value = -$value;
        }

        $instance->warehouse_id          = $warehouse_id;
        $instance->product_id            = $product_id;
        $instance->amount                = $value;
        $instance->warehouse_change_type = $type;
        $instance->changed_date          = $date;
        $instance->save();
    }

    /**
     * @param $thisDate
     */
    public function countChangeAfterThisDate(
        $warehouse_id,
        $thisDate
    ) {
        $sqlParam = array();
        $sql      = "
                select
                  count(*)  as count
                from
                  trn_warehouse_change a
                where
                  (
                    a.warehouse_change_type = 3
                    or a.warehouse_change_type = 4
                  )
                  and a.changed_date >= ?
                  and a.warehouse_id = ?
			          ";
        $sqlParam[] = $thisDate->format('Y-m-d');
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $thisDate
     */
    public function countNumberOfCheckingAtDate(
        $warehouse_id,
        $thisDate
    ) {
        $sqlParam = array();
        $sql      = "
             select
              a.id,
              a.checking_sts
            from
              trn_check_warehouse a
            where
              a.check_date = ?
              and a.warehouse_id = ?
              and a.checking_sts != '5'
			          ";
        $sqlParam[] = $thisDate->format('Y-m-d');
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $checkedDate
     */
    private function findCheckWarehouseByDate(
        $warehouse_id,
        $checkedDate
    ) {
        $sqlParam = array();
        $sql      = "
        select
            *
        from
            trn_check_warehouse a
        where
            a.check_date = ?
            and a.warehouse_id = ?
            and a.checking_sts != '5'
        ";

        $sqlParam[] = $checkedDate->format('Y-m-d');
        $sqlParam[] = $warehouse_id;

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $checkedDate
     * @return mixed
     */
    public function updateStatusForCheckWarehouse(
        $warehouse_id,
        $checkedDate
    ) {
        $check_warehouse    = $this->findCheckWarehouseByDate($warehouse_id, $checkedDate);
        $check_warehouse_id = $check_warehouse[0]->id;

        if (null == $check_warehouse_id) {
            return;
        }

        $sql      = "update trn_check_warehouse set checking_sts = '1'  where id = ? ";
        $affected = DB::update($sql, [$check_warehouse_id]);

        return $affected;
    }

}
