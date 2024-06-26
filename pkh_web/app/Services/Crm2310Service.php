<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\MstProduct;
use App\Services\ImageService;
use App\Models\TrnWarehouseExim;
use App\Services\GenCodeService;
use App\Models\TrnWarehouseEximDetail;

/**
 * Crm2310Service class
 */
class Crm2310Service extends BaseService
{
    /**
     * @param GenCodeService $genCodeService
     */
    public function __construct(
        GenCodeService $genCodeService,
        ImageService $imageService
    ) {

        $this->genCodeService = $genCodeService;
        $this->imageService   = $imageService;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectOneExim($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.warehouse_exim_code,
                a.warehouse_exim_id,
                a.to_warehouse_id,
                a.total,
                a.exim_sts,
                a.notes_cancel,
                a.cancel_time,
                a.created_at,
                c.name as created_by,
                a.updated_at,
                d.name as updated_by,
                a.notes,
                a.from_warehouse_id,
                b.name as warehouse_name,
                a.volume,
                a.carton
            from
                trn_warehouse_exim a
                left join mst_warehouse b
                    on a.from_warehouse_id = b.warehouse_id
                left join users c
                    on a.created_by = c.id
                left join users d
                    on a.updated_by = d.id
            where
                a.active_flg = '1'
        ";
        $sql .= $this->andWhereInt($param, 'warehouse_exim_id', 'a.warehouse_exim_id', $sqlParam);

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return array();
        }

        Log::debug('check warehouse 2-----');
        Log::debug($result);
        Log::debug($param);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectEximDetail($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                a.warehouse_exim_id
                , a.product_id
                , a.amount
                , a.unit_price
                , a.version_no
                , b.product_code
                , b.name product_name
                , b.standard_packing
                , b.stock_code
                , b.name_origin stock_name
                , c.length*c.width*c.height/1000000000 as volume
        from
            trn_warehouse_exim_detail a
            left join mst_product b
                on a.product_id = b.product_id
            left join mst_packaging c
                on c.packaging_id = b.packaging_id
        where
             a.active_flg = '1' ";

        $sql .= $this->andWhereInt($param, 'warehouse_exim_id', 'a.warehouse_exim_id', $sqlParam);
        $sql .= "     order by a.seq_no ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $user
     * @param $warehouse
     * @param $warehouseDetail
     * @return mixed
     */
    private function getListWarehouseDetail(
        $user,
        $warehouse,
        $warehouseDetail
    ) {
        $listWarehouseDetail = array();
        $detailSeqNo         = 1;
        $total               = 0;
        $msg                 = '';

        foreach ($warehouseDetail as $item) {

            $product = MstProduct::find($item['product_id']);
            // DAm bao gia cu khong thay doi khi he thong chuyen sang bang gia moi
            $tempSellingPrice = $item["unit_price"];
            $amount           = intval($item['amount']);

            if ($amount < 0) {
                $amount = -$amount;
            }

            $total += $tempSellingPrice * intval($amount);

            $warehouseDetail = new TrnWarehouseEximDetail();

            $warehouseDetail->product_id = $product->product_id;
            $warehouseDetail->seq_no     = $detailSeqNo++;
            $warehouseDetail->amount     = $amount;
            $warehouseDetail->unit_price = $tempSellingPrice;
            $this->updateRecordHeader($warehouseDetail, $user, true);
            $listWarehouseDetail[] = $warehouseDetail;
        }

        $result = [
            'listWarehouseDetail' => $listWarehouseDetail,
            'total'               => $total,
        ];

        return $result;
    }

    /**
     * @param $param
     * @param $user
     * @return mixed
     */
    public function saveExim(
        $param,
        $user
    ) {
        $entityOrder     = null;
        $isUpdateMode    = false;
        $paramCode       = [];
        $warehouse       = $param['warehouse'];
        $warehouseDetail = $param['warehouseDetail'];

        // Prepare list of warehouse detail and total
        $resultDetail        = $this->getListWarehouseDetail($user, $warehouse, $warehouseDetail);
        $listWarehouseDetail = $resultDetail['listWarehouseDetail'];
        $total               = $resultDetail['total'];
        Log::debug('-----------warehouse----------');
        Log::debug($warehouse);
        Log::debug($listWarehouseDetail);

        if (isset($warehouse['warehouse_exim_id']) && $warehouse['warehouse_exim_id'] > 0) {
            // Update
            $isUpdateMode    = true;
            $entityWarehouse = TrnWarehouseExim::find($warehouse['warehouse_exim_id']);
            $this->updateRecordHeader($entityWarehouse, $user, false);
        } else {
            // Create
            $isUpdateMode                         = false;
            $entityWarehouse                      = new TrnWarehouseExim();
            $entityWarehouse->warehouse_exim_code = $this->genCodeService->genCodeForExchangeWarehouse($paramCode);

            $entityWarehouse->exim_sts = 0;

            $this->updateRecordHeader($entityWarehouse, $user, true);
        }

        $entityWarehouse->from_warehouse_id = $warehouse['from_warehouse_id'];
        $entityWarehouse->to_warehouse_id   = $warehouse['to_warehouse_id'];
        $entityWarehouse->total             = $total;

        if (isset($warehouse['notes'])) {
            $entityWarehouse->notes = $warehouse['notes'];
        }

        $entityWarehouse->carton = $warehouse['carton'];
        $entityWarehouse->volume = $warehouse['volume'];
        DB::transaction(function () use ($entityWarehouse, $warehouse, $listWarehouseDetail, $isUpdateMode) {

            $entityWarehouse->save();

            TrnWarehouseEximDetail::where('warehouse_exim_id', $warehouse['warehouse_exim_id'])->delete();

            foreach ($listWarehouseDetail as $detail) {
                $detail->warehouse_exim_id = $entityWarehouse->warehouse_exim_id;
                $detail->save();
            }

        });

        $resultWarehouse = [
            'warehouse_exim_id' => $entityWarehouse->warehouse_exim_id,
            'error'             => 0,
        ];

        return $resultWarehouse;
    }

    /**
     * @param $user
     * @param $param
     */
    public function updateStatusToExport(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        TrnWarehouseExim::where('warehouse_exim_id', $param['warehouse_exim_id'])
            ->update(['exim_sts' => 1
                , 'updated_at' => $today1
                , 'updated_by' => $user->id]);

        return true;
    }

    /**
     * @param $user
     * @param $param
     */
    public function updateStatusToImport(
        $user,
        $param
    ) {
        $today1 = Carbon::now();
        TrnWarehouseExim::where('warehouse_exim_id', $param['warehouse_exim_id'])
            ->update(['exim_sts' => 2
                , 'updated_at' => $today1
                , 'updated_by' => $user->id]);

        return true;
    }

    /**
     * @param $param
     */
    public function upload($param)
    {
        $newsId       = $param["id"];
        $base64Img    = $param["file"];
        $locationName = "crm2310";
        $fileName     = $this->imageService->uploadImage($newsId, $base64Img, $locationName);

        return [
            "rtnCd"    => true,
            "fileName" => $fileName,
        ];
    }

    /**
     * @param $param
     */
    public function loadImages($param)
    {
        $locationName = "crm2310";
        $listFile     = $this->imageService->listImageFile($param['id'], $locationName);

        return [
            "rtnCd" => true,
            "list"  => $listFile,
        ];
    }

}
