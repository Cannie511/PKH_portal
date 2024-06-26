<?php

namespace App\Services;

use DB;
use App\Services\StatusService;
use App\Services\DownloadService;

class Crm0200Service extends BaseService
{
    const ORDER_STATUS_TYPE = 1;

    /**
     * @param StatusService $statusService
     * @param DownloadService $downloadService
     */
    public function __construct(
        StatusService $statusService,
        DownloadService $downloadService
    ) {
        $this->statusService = $statusService;
        $this->downloadService = $downloadService;
    }

    /**
     * Search store for sales
     * @param  [type] $param [description]
     * @return [type]        list product
     */
    public function selectOrderList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.supplier_order_id
                , b.name
                , a.supplier_id
                , a.order_date
                , a.total
                , a.notes
                , a.updated_at
                , c.name as updated_by
            from
                trn_supplier_order a join mst_supplier b
                    on a.supplier_id = b.supplier_id
                 left join users c
                    on a.updated_by = c.id
            where
                a.active_flg = 1
        ";

        $result = array();
        $sql .= $this->andWhereDateBetween($param, 'start_date', 'end_date', 'a.order_date', $sqlParam);
        $sql .= $this->andWhereString($param, 'supplier_name', 'b.name', $sqlParam);

        $sql .= " order by a.created_at desc ";

        return $this->pagination($sql, $sqlParam, $param);
    }
    /**
     * Search store for sales
     * @param  [type] $param [description]
     * @return [type]        list product
     */
    public function selectOrderDetailList($param)
    {
        $sqlParam = [];
        $sql = "
            SELECT
                g.product_id
                , g.seq_no
                , g.amount
                , g.unit_price
                , h.product_code
                , h.stock_code
                , h.name product_name
                , a.store_order_id
                , a.store_order_code
                , a.store_id
                , b.name store_name
                , a.order_date
                , a.order_sts
                , bb.name AS current_salesman_name
                , b.address
                , a.updated_at
            FROM
                trn_store_order_detail g
            JOIN trn_store_order a ON
                a.store_order_id = g.store_order_id
            LEFT JOIN mst_store b ON
                b.store_id = a.store_id
            LEFT JOIN users bb ON
                bb.id = b.salesman_id
            LEFT JOIN mst_product h ON
                h.product_id = g.product_id
            WHERE
                a.active_flg = '1'
                AND g.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'level', 'b.level', $sqlParam);
        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt( $param, 'promotion_id', 'a.promotion_id', $sqlParam );
        $sql .= $this->andWhereInt( $param, 'salesman_id', 'a.salesman_id', $sqlParam );
        $sql .= $this->andWhereInt( $param, 'order_type', 'a.order_type', $sqlParam );
        $sql .= $this->andWhereInt( $param, 'branch_id', 'a.branch_id', $sqlParam );
        $sql .= $this->andWhereString( $param, 'store_order_code', 'a.store_order_code', $sqlParam );
        $sql .= $this->andWhereString( $param, 'store_name', 'b.name', $sqlParam );
        $sql .= $this->andWhereString( $param, 'order_sts', 'a.order_sts', $sqlParam, true );
        $sql .= $this->andWhereInt( $param, 'sale_id', 'b.salesman_id', $sqlParam );
        $sql .= $this->andWhereDateBetween( $param, 'from_date', 'to_date', 'a.order_date', $sqlParam );

        if (isset($param['orderBy'])) {
            $sql .= $this->getOrderBy($param);
        } else {
            $sql .= ' ORDER BY a.updated_at DESC, a.store_order_id, g.seq_no ';
        }

        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    public function download($param)
    {
        $listOrder        = $this->selectOrderList($param);
        $listOrderDetails = $this->selectOrderDetailList($param);
        $listStatus       = $this->statusService->getStatus(
            self::ORDER_STATUS_TYPE
        );
        
        // Create list order 
        $sheets[] = [
            "name" => 'ORDERS',
            "data" => [
                'list' => $listOrder,
                'status' => $listStatus
            ],
            "view" => "crm0200-list",
        ];

        // Create list detail
        $sheets[] = [
            "name" => 'PRODUCTS',
            "data" => [
                'list' => $listOrderDetails,
                'status' => $listStatus
            ],
            "view" => "crm0200-list-product",
        ];

        $paramDownload = [
            "file_name" => "ORDER",
            "view"      => "crm0200",
            "sheets"    => $sheets,
        ];

        $result = $this->downloadService->downloadExcelFileMultiSheets($paramDownload);

        return $result;
    }
}
