<?php
namespace App\Services;

use DB;

/**
 * Crm1640Service class
 */
class Crm1640Service extends BaseService
{
    /**
     * @param $filter
     * @return mixed
     */
    public function searchForFactory($filter)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.import_wh_factory_id
                , a.supplier_id
                , a.import_date
                , b.name
                , c.pi_no
                , a.notes
                ,a.active_flg
                , d.name as warehouse_name
            from
                trn_import_wh_factory a
                left join trn_supplier_delivery c
                    on a.supplier_id = c.supplier_delivery_id
                left join mst_supplier b
                    on c.supplier_id = b.supplier_id
                left join mst_warehouse d
                    on a.warehouse_id = d.warehouse_id
            where
                a.active_flg >= 0
        ";
        $sql .= $this->andWhereDateBetween($filter, 'from_date', 'to_date', 'a.import_date', $sqlParam);
        $sql .= $this->andWhereInt($filter, 'warehouse_id', 'a.warehouse_id', $sqlParam);
        $sql .= $this->andWhereInt($filter, 'supplier_id', 'b.supplier_id', $sqlParam);

        $sql .= "
            order by a.created_at desc
        ";
        $result = array();
        $result = $this->pagination($sql, $sqlParam, $filter);

        return $result;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function searchForStore($filter)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.import_wh_store_id
                , a.import_type
                , a.import_sts
                , a.store_id
                , a.import_date
                , a.total
                , a.notes
                , a.salesman_id
                , c.name as store_name
                , c.address as store_address
                , b.name as salesman_name
                , a.updated_at
                , d.name updated_by
                , e.name as warehouse_name
            from
                trn_import_wh_store a
                left join users b
                    on a.salesman_id = b.id
                left join mst_store c
                    on a.store_id = c.store_id
                left join users d
                    on a.updated_by = d.id
                left join mst_warehouse e
                    on a.warehouse_id = e.warehouse_id
            where
                a.active_flg = 1
        ";
        $sql .= $this->andWhereDateBetween($filter, 'from_date', 'to_date', 'a.import_date', $sqlParam);
        $sql .= $this->andWhereInt($filter, 'warehouse_id', 'a.warehouse_id', $sqlParam);

        $sql .= $this->andWhereString($filter, 'salesman_name', 'b.name', $sqlParam);
        $sql .= $this->andWhereString($filter, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($filter, 'import_type', 'a.import_type', $sqlParam);
        $sql .= $this->andWhereString($filter, 'import_sts', 'a.import_sts', $sqlParam);
        $sql .= "
            order by a.created_at desc
        ";

        $result = array();
        $result = $this->pagination($sql, $sqlParam, $filter);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectForDownload($param)
    {
        $sqlParam = array();
        $sql      = "
           select
                a.import_wh_store_id
                , a.product_id
                , c.product_code
                , a.amount
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
                , b.import_type
                , b.import_date
                , d.name as store_name
                , d.address as store_address
                , e.name as salesman_name
                , b.notes
                , f.name as warehouse_name
            from
                trn_import_wh_store_detail a
                left join trn_import_wh_store b
                    on a.import_wh_store_id = b.import_wh_store_id
                left join mst_product c
                    on a.product_id = c.product_id
                left join mst_store d
                    on b.store_id = d.store_id
                left join users e
                    on b.salesman_id = e.id
                left join mst_warehouse f
                    on b.warehouse_id = f.warehouse_id
            where
                a.active_flg = 1
        ";
        $sql .= $this->andWhereDateBetween($param, 'from_date', 'to_date', 'b.import_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'salesman_name', 'e.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'store_name', 'd.name', $sqlParam);

        $sql .= "
            order by a.created_at desc
        ";
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
