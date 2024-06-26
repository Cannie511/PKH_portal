<?php

namespace App\Services;

use DB;

class SalesmanService extends BaseService
{
    public function selectDropdown()
    {
        $sqlParam = array();
        $sql      = "select
                a.id
                , a.name
                from
                users a join role_user b
                    on a.id = b.user_id join roles c
                    on c.id = b.role_id
                    and (c.slug = 'sales' or c.id =3)
                order by
                a.id";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    public function select4SalemanDropdown()
    {
        $sqlParam = array();
        $sql      = "select
                a.id
                , a.name
                from
                users a join role_user b
                    on a.id = b.user_id join roles c
                    on c.id = b.role_id
                    and (c.slug = 'sales' or c.id =3)
                where
                    a.id in (30,31,32,33)
                order by
                a.id";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @return mixed
     */
    public function selectDropdownWithAllAndNone()
    {
        $sqlParam = array();
        $sql      = "select
            a.id
            , a.name
            from
            users a join role_user b
                on a.id = b.user_id join roles c
                on c.id = b.role_id
                and (c.slug = 'sales' or c.id =3)
            order by
            a.id";

        $list1 = [
            ['id' => -1, 'name' => 'Tất cả'],
            ['id' => 0, 'name' => 'Chưa có'],
        ];

        $list2 = DB::select(DB::raw($sql), $sqlParam);

        $result = array_merge($list1, $list2);

        return $result;
    }

    // public function selectListProduct($param) {
    //     $sqlParam = array();
    //     $sql = "
    //         select
    //         a.product_id
    //         , a.supplier_id
    //         , a.product_cat_id
    //         , a.product_code
    //         , a.stock_code
    //         , a.name
    //         , a.name_origin
    //         , a.color
    //         , a.packing
    //         , a.moq
    //         , a.standard_packing
    //         , a.warning_qty
    //         , a.selling_price
    //         , a.active_flg
    //         , b.product_cat_code
    //         , b.name product_cat_name
    //         , c.supplier_code
    //         , c.name supplier_name
    //         , d.in_num
    //         , d.out_num
    //         from
    //         mst_product a
    //         left join mst_product_cat b
    //             on a.product_cat_id = b.product_cat_id
    //         left join mst_supplier c
    //             on a.supplier_id = c.supplier_id join (
    //             select
    //                 a.product_id
    //                 , sum(
    //                 case
    //                     when a.warehouse_change_type = 1
    //                     then amount
    //                     else 0
    //                     end
    //                 ) in_num
    //                 , sum(
    //                 case
    //                     when a.warehouse_change_type = 2
    //                     then amount
    //                     else 0
    //                     end
    //                 ) out_num
    //             from
    //                 trn_warehouse_change a
    //             group by
    //                 a.product_id
    //             ) d
    //             on a.product_id = d.product_id
    //         where
    //         a.active_flg = '1'
    //         ";

    //     $sql .= "
    //         order by a.product_code
    //       ";

    //     //return $this->pagination($sql, $sqlParam, $param);
    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

}
