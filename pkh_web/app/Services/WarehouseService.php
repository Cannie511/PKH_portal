<?php namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnWarehouseChange;

/**
 * UserService
 */
class WarehouseService extends BaseService
{
    public function selectWarehouseList()
    {
        $sqlParam = array();
        $sql      = "
            select
                a.warehouse_id,
                concat('amount_',a.warehouse_id) as warehouse_label, 
                a.name as warehouse_name,
                a.address
            from
                mst_warehouse a
            where
                a.active_flg = '1'
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @param $type
     * @param $warehouse_id
     * @return mixed
     */
    private function makeDataForWarehouseChange(
        $user,
        $param,
        $type,
        $warehouse_id
    ) {

        if (!isset($param['detail'])) {
            return null;
        }

        // $today1           = ;
        $today      = date('Y-m-d', strtotime(Carbon::now()));
        $details    = $param['detail'];
        $listDetail = array();

        foreach ($details as $item) {
            $object                        = new TrnWarehouseChange();
            $object->product_id            = $item['product_id'];
            $object->changed_date          = $today;
            $object->warehouse_change_type = $type;
            $object->warehouse_id          = $warehouse_id;
            $object->branch_id             = $user->branch_id;
            $object->amount                = intval($item['amount']);
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
     * @param $warehouse_id
     * @param $ref_id
     * @return int
     */
    public function saveDataInWarehouseChange(
        $flag,
        $user,
        $param,
        $type,
        $warehouse_id,
        $ref_id
    ) {
        $listDetail = $this->makeDataForWarehouseChange($user, $param, $type, $warehouse_id);

        if (!$listDetail) {
            return 0;
        }

        DB::transaction(function () use ($listDetail, $ref_id, $flag) {

// Create detail
            foreach ($listDetail as $detail) {
                switch ($flag) {
                    case 1:
                        $detail->warehouse_exim_id = $ref_id;
                        break;
                }

                $detail->save();
            }

        });
    }

    /**
     * @param $param
     * @param $before_date
     * @param $start_date
     * @param $end_date
     * @return mixed
     */
    public function selectList(
        $param,
        $before_date,
        $start_date,
        $end_date
    ) {

        $sql_1 = "
        select
        1 type
        , a.product_id
        , a.supplier_id
        , a.product_cat_id
        , a.product_code
        , a.stock_code
        , a.name
        , a.name_origin
        , a.color
        , a.packing
        , a.packing_id
        , a.moq
        , a.standard_packing
        , a.warning_qty
        , a.selling_price
        , a.active_flg
        , b.product_cat_code
        , b.name product_cat_name
        , c.supplier_code
        , c.name supplier_name
        , d.in_num
        , d.out_num
        , d.in_num_edit
        , d.out_num_edit
        , d.in_num_warehouse
        , d.in_num_warranty
        , d.in_num_return
        , d.out_num_warehouse
        , (
          d.in_num + d.in_num_edit + d.in_num_warranty + d.in_num_return + d.in_num_warehouse  - d.out_num - d.out_num_edit - d.out_num_warehouse
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
                  when a.warehouse_change_type = 1
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
              , sum(
                case
                  when a.warehouse_change_type = 5
                  then amount
                  else 0
                  end
              ) in_num_warranty
              , sum(
                case
                  when a.warehouse_change_type = 6
                  then amount
                  else 0
                  end
              ) in_num_return
              , sum(
                case
                  when a.warehouse_change_type = 7
                  then amount
                  else 0
                  end
              ) in_num_warehouse
              , sum(
                case
                  when a.warehouse_change_type = 8
                  then amount
                  else 0
                  end
              ) out_num_warehouse
            from
              trn_warehouse_change a
            where
              a.changed_date < ?  and a.active_flg = '1' ";
        $sqlParam[] = $before_date; //

        $sql_1 .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);
        $sql_1 .= "
            group by
              a.product_id
          ) d
          on a.product_id = d.product_id
      where
        a.active_flg = '1'
        ";

        $sql_2 = "
        select
            2 type
            , a.product_id
            , a.supplier_id
            , a.product_cat_id
            , a.product_code
            , a.stock_code
            , a.name
            , a.name_origin
            , a.color
            , a.packing
            , a.packing_id
            , a.moq
            , a.standard_packing
            , a.warning_qty
            , a.selling_price
            , a.active_flg
            , b.product_cat_code
            , b.name product_cat_name
            , c.supplier_code
            , c.name supplier_name
            , d.in_num
            , d.out_num
            , d.in_num_edit
            , d.out_num_edit
            , d.in_num_warehouse
            , d.in_num_warranty
            , d.in_num_return
            , d.out_num_warehouse
            , (
              d.in_num + d.in_num_edit + d.in_num_warranty + d.in_num_return + d.in_num_warehouse  - d.out_num - d.out_num_edit - d.out_num_warehouse
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
                      when a.warehouse_change_type = 1
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
                  , sum(
                    case
                      when a.warehouse_change_type = 5
                      then amount
                      else 0
                      end
                  ) in_num_warranty
                  , sum(
                    case
                      when a.warehouse_change_type = 6
                      then amount
                      else 0
                      end
                  ) in_num_return
                  , sum(
                    case
                      when a.warehouse_change_type = 7
                      then amount
                      else 0
                      end
                  ) in_num_warehouse
                  , sum(
                    case
                      when a.warehouse_change_type = 8
                      then amount
                      else 0
                      end
                  ) out_num_warehouse
                from
                  trn_warehouse_change a

                where
                  a.changed_date between ? and ?  and a.active_flg = '1'
                  ";
        $sqlParam[] = $start_date; //$date->startOfMonth()->format('Y-m-d');
        $sqlParam[] = $end_date;   //  $date->endOfMonth()->format('Y-m-d');
        $sql_2 .= $this->andWhereInt($param, 'warehouse_id', 'warehouse_id', $sqlParam);
        $sql_2 .= "
              group by
                  a.product_id
              ) d
              on a.product_id = d.product_id
          where
            a.active_flg = '1'
        ";

        $sql = "
            select
              product_id
              , supplier_id
              , product_cat_id
              , product_code
              , stock_code
              , name
              , name_origin
              , color
              , packing
              , packing_id
              , moq
              , standard_packing
              , warning_qty
              , selling_price
              , active_flg
              , product_cat_code
              , product_cat_name
              , supplier_code
              , supplier_name
              , sum(case type when 1 then num else 0 end) start_num
              , sum(case type when 2 then in_num else 0 end) in_num
              , sum(case type when 2 then in_num_edit else 0 end) in_num_edit
              , sum(case type when 2 then out_num else 0 end) out_num
              , sum(case type when 2 then out_num_edit else 0 end) out_num_edit
              , sum(case type when 2 then in_num_warehouse else 0 end) in_num_warehouse
              , sum(case type when 2 then in_num_warranty  else 0 end) in_num_warranty
              , sum(case type when 2 then in_num_return else 0 end) in_num_return
              , sum(case type when 2 then out_num_warehouse else 0 end) out_num_warehouse
            from
              ( ";
        $sql .= $sql_1;
        $sql .= "  union ";
        $sql .= $sql_2;
        $sql .= " ) temp
            where
             active_flg = '1'

            ";

        $sql .= $this->andWhereString($param, 'product_code', 'product_code', $sqlParam);
        // $sql .= $this->andWhereInt($param, 'warehouse_id', 'warehouse_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'product_cat_id', 'product_cat_id', $sqlParam);

        $sql .= "
          group by
              (product_id)
        ";

        $sql_official = "
        select
        o.product_id
        , o.supplier_id
        , o.supplier_code
        , o.product_cat_id
        , o.product_code
        , o.stock_code
        , o.name
        , o.name_origin
        , o.color
        , o.packing
        , o.selling_price
        , o.moq
        , o.standard_packing
        , o.active_flg
        , o.product_cat_code
        , o.product_cat_name
        , o.start_num
        ,  o.in_num
        ,  o.in_num_edit
        ,  o.out_num
        ,  o.out_num_edit
        ,  o.in_num_warehouse
        ,  o.in_num_warranty
        ,  o.in_num_return
        ,  o.out_num_warehouse
        , w.length*w.width*w.height/1000000000 as volume
        , (
          o.start_num + o.in_num + o.in_num_edit + o.in_num_warranty + o.in_num_return + o.in_num_warehouse  - o.out_num - o.out_num_edit - o.out_num_warehouse
        ) as  end_num
        from
        ";
        $sql_official .= "( " . $sql . " ) o  
                          left join mst_packaging w
                          on w.packaging_id = o.packing_id";
        $sql_official .= "
          where o.active_flg = '1' 
        ";
        $sql_official .= $this->andWhereInt($param, 'supplier_id', 'o.supplier_id', $sqlParam);


        $sql_official .= "
            order by
            end_num desc

        ";
        $result = DB::select(DB::raw($sql_official), $sqlParam);
        // $result = $this->pagination($sql_official, $sqlParam, $param);

        return $result;
    }

}
