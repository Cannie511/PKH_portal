<?php

namespace App\Services;

/**
 * Crm0240Service class
 */
class Crm0240Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectListForOrder($param)
    {
        $sqlParam = [];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
              , c.store_order_code
              , c.store_order_id
              , d.name store_name
              , d.address
              , d.store_id
              , e.store_delivery_id
              , e.store_order_id store_order_id_delivery
              , f.store_order_code store_order_code_delivery
              , g.name store_name_delivery
              , g.address address_delivery
              , k1.name as sale_1
              , k2.name as sale_2
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
              left join trn_store_order c
                on a.ref_id = c.store_order_id
                and a.request_type in (1, 3)
              left join users k1
                on k1.id = c.salesman_id
              left join mst_store d on c.store_id = d.store_id
              left join trn_store_delivery e
                on a.ref_id = e.store_delivery_id
                and a.request_type in (2)
              left join users k2
                on k2.id = e.salesman_id
              left join trn_store_order f
                on e.store_order_id = f.store_order_id
              left join mst_store g on e.store_id = g.store_id
            where
              a.active_flg = '1' and
              a.request_type in (1,2,3)
        ";

// $sql .= $this->andWhereString($param, 'salesman_name', 'k1.name', $sqlParam );

// $sql .= $this->orWhereString($param, 'salesman_name', 'k2.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'd.name', $sqlParam);
        //$sql .= $this->orWhereString($param, 'store_name', 'g.name', $sqlParam);
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.request_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'request_type', 'a.request_type', $sqlParam);
        $sql .= $this->andWhereString($param, 'request_sts', 'a.request_sts', $sqlParam);

        if (isset($param["salesman_name"])) {
            $sql .= " and ( (lower(k1.name) like ? ) or (lower(k2.name) like ? ) ) ";
            $sqlParam[] = '%' . $param["salesman_name"] . '%';
            $sqlParam[] = '%' . $param["salesman_name"] . '%';
        }

        if (isset($param["store_name"])) {
            $sql .= " and ( ( lower(d.name) like ? ) or ( lower(d.name) like ? ) ) ";
            $sqlParam[] = '%' . $param["store_name"] . '%';
            $sqlParam[] = '%' . $param["store_name"] . '%';
        }

        $sql .= "
            order by a.request_id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
        // return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListForImportStore($param)
    {
        $sqlParam = [];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
              , d.name store_name
              , d.address address
              , e.name as salesman_name
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
              left join trn_import_wh_store c
                on c.import_wh_store_id = a.ref_id
              left join mst_store d
                on d.store_id = c.store_id
              left join users e
                on e.id = c.salesman_id
            where
              a.active_flg = '1'
              and a.request_type in (5, 6)
        ";
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'a.request_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'request_type', 'a.request_type', $sqlParam);
        $sql .= $this->andWhereString($param, 'request_sts', 'a.request_sts', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'd.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'salesman_name', 'e.name', $sqlParam);
        $sql .= "
            order by a.request_id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
        // return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListForImportFac($param)
    {
        $sqlParam = [];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
              , e.name factory_name
              , f.name as warehouse_name
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
              left join trn_import_wh_factory c
                on a.ref_id = c.import_wh_factory_id
              left join trn_supplier_delivery d
                on c.supplier_id = d.supplier_delivery_id
              left join mst_supplier e
                on e.supplier_id = d.supplier_id
              left join mst_warehouse f
                on c.warehouse_id = f.warehouse_id
            where
              a.active_flg = '1'
              and a.request_type in (4)
        ";

        $sql .= "
            order by a.request_id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
        // return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListForWarehouse($param)
    {
        $sqlParam = [];
        $sql      = "
            select
              a.request_id
              , a.request_date
              , a.request_type
              , a.request_sts
              , a.ref_id
              , a.request_notes
              , a.response_notes
              , b.name created_user_name
              , d.name as from_warehouse_name
              , e.name as to_warehouse_name
              , c.total
            from
              trn_order_edit_request a
              left join users b
                on a.created_by = b.id
              left join trn_warehouse_exim c
                on a.ref_id = c.warehouse_exim_id
              left join mst_warehouse d
                on c.from_warehouse_id = d.warehouse_id
              left join mst_warehouse e
                on c.to_warehouse_id = e.warehouse_id
            where
              a.active_flg = '1'
              and a.request_type in (7)
        ";

        $sql .= "
            order by a.request_id desc
        ";

        return $this->pagination($sql, $sqlParam, $param);
        // return DB::select(DB::raw($sql), $sqlParam);
    }

}
