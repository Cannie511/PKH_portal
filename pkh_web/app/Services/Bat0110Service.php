<?php

namespace App\Services;

use DB;
use Log;

class Bat0110Service extends BaseService
{
    /**
     * Update timeline
     *
     * @param [type] $fromDate
     * @return void
     */
    public function updateProductTimeline($fromDate)
    {
        // set_time_limit(0);
        Log::info('updateProductTimeline: ' . $fromDate);

        // Truncate
        DB::table('trn_wh_product_time')->truncate();

        // Insert import
        $this->insertImport();

        // Add edit
        $this->addVirtualImport();

        // Select list id
        $listProductId = $this->selectProductIdList();

        $countProduct = count($listProductId);
        echo "Number of product: $countProduct \n";

        $index = 0;

        foreach ($listProductId as $productIdEntity) {
            $index++;
            $productId = $productIdEntity->product_id;

            $listIOProduct = $this->selectExportProductList($productId);
            echo " - Export product $productId ... ($index / $countProduct) Items: " . count($listIOProduct) . "\n";

            if (!empty($listIOProduct)) {

                foreach ($listIOProduct as $ioProduct) {

                    if (2 == $ioProduct->warehouse_change_type || 4 == $ioProduct->warehouse_change_type) {
                        $this->exportProduct($productId, $ioProduct);
                    }
                    /*elseif (6 == $ioProduct->warehouse_change_type) {
                $this->importRevertProduct($productId, $ioProduct);
                }*/

                }

            }

        }

    }

    private function insertImport()
    {
        echo "Import product... \n";
        $sql = "
            insert
            into trn_wh_product_time(
              in_date
              , product_id
              , supplier_delivery_id
              , amount
              , remain
              , active_flg
              , created_at
              , created_by
              , updated_at
              , updated_by
              , version_no
            )
            select
              a.changed_date
              , a.product_id
              , COALESCE(a.supplier_delivery_id, b.supplier_id)
              , sum(a.amount)
              , sum(a.amount) remain
              , '1'
              , now()
              , 1
              , now()
              , 1
              , 1
            from
              trn_warehouse_change a
            left join trn_import_wh_factory b
                on a.import_wh_factory_id = b.import_wh_factory_id
            where
              a.warehouse_change_type = 1 and
              a.active_flg = '1'
            group by
              a.changed_date
              , a.product_id
              , COALESCE(a.supplier_delivery_id, b.supplier_id)
        ";

        return DB::insert(DB::raw($sql));
    }

    /**
     * @return null
     */
    private function addVirtualImport()
    {
        echo "Import virtual product... \n";
        $listImport = $this->selectVirtualImport();

        if (empty($listImport)) {
            return;
        }

        foreach ($listImport as $import) {
            $nearestImport = $this->selectNearestImport($import->product_id, $import->changed_date);

            if (!empty($nearestImport)) {
                $amount = $nearestImport->amount + $import->amount;
                $this->updateNearestImport($import->product_id, $nearestImport->in_date, $amount, $nearestImport->supplier_delivery_id);
            } else {
                $nearestImport = $this->selectNearestImportFuture($import->product_id, $import->changed_date);

                if (!empty($nearestImport)) {
                    $amount = $nearestImport->amount + $import->amount;
                    $this->updateNearestImport($import->product_id, $nearestImport->in_date, $amount, $nearestImport->supplier_delivery_id);
                }

            }

        }

    }

    private function selectVirtualImport()
    {
        $sql = "
            select
              a.product_id,
              a.changed_date,
              a.amount
            from
              trn_warehouse_change a
            where
              a.warehouse_change_type in (3, 5, 6)
              and  a.active_flg = '1'
            order by a.changed_date
        ";

        return DB::select(DB::raw($sql));
    }

    /**
     * @param $productId
     * @param $inDate
     * @return mixed
     */
    private function selectNearestImport(
        $productId,
        $inDate
    ) {
        $sql = "
            select
                in_date
                , product_id
                , amount
                , remain
                , supplier_delivery_id
            from
              trn_wh_product_time
            where
              product_id = ?
              and in_date <= ?
              and active_flg = '1'
            order by
              in_date desc
            limit 1
        ";
        $result = DB::select(DB::raw($sql), [$productId, $inDate]);

        if (count($result) == 1) {
            return $result[0];
        }

        return null;
    }

    /**
     * @param $productId
     * @param $inDate
     * @return mixed
     */
    private function selectNearestImportFuture(
        $productId,
        $inDate
    ) {
        $sql = "
            select
                in_date
                , product_id
                , amount
                , remain
                , supplier_delivery_id
            from
              trn_wh_product_time
            where
              product_id = ?
              and in_date >= ?
              and active_flg = '1'
            order by
              in_date desc
            limit 1
        ";
        $result = DB::select(DB::raw($sql), [$productId, $inDate]);

        if (count($result) == 1) {
            return $result[0];
        }

        return null;
    }

    /**
     * @param $productId
     * @param $inDate
     * @param $amount
     */
    private function updateNearestImport(
        $productId,
        $inDate,
        $amount,
        $supplier_delivery_id
    ) {
        $sql = "
            update trn_wh_product_time
            set amount = ? , remain = ?
            where
              product_id = ?
              and in_date = ?
              and supplier_delivery_id = ?
              and active_flg = '1'
        ";

        return DB::update(DB::raw($sql), [$amount, $amount, $productId, $inDate, $supplier_delivery_id]);
    }

    /**
     * @param $productId
     * @param $inDate
     * @param $amount
     */
    private function updateRemain(
        $productId,
        $inDate,
        $amount,
        $soldOutDate,
        $supplier_delivery_id
    ) {
        $sql = "
            update trn_wh_product_time
            set remain = ?,
            soldout_date = ?
            where
              product_id = ?
              and in_date = ?
              and supplier_delivery_id = ?
        ";

        return DB::update(DB::raw($sql), [$amount, $soldOutDate, $productId, $inDate, $supplier_delivery_id]);
    }

    private function selectProductIdList()
    {
        $sql = "
            select
              distinct a.product_id
            from
              trn_warehouse_change a
            where
              a.warehouse_change_type in (2, 4)
              and active_flg = '1'
        ";

        return DB::select(DB::raw($sql));
    }

    /**
     * Select export product including revert (tra lai)
     *
     * @param [type] $productId
     * @return void
     */
    private function selectExportProductList($productId)
    {
        $sql = "
            select
              a.changed_date
              , a.product_id
              , a.amount
              , a.warehouse_change_type
              , b.store_delivery_id
              , b.delivery_sts
            from
              trn_warehouse_change a
              left join trn_store_delivery b on a.store_delivery_id = b.store_delivery_id
            where
              a.warehouse_change_type in (2, 4)
              and a.product_id = ?
              and a.active_flg = 1
            order by
              a.changed_date
        ";

        return DB::select(DB::raw($sql), [$productId]);
    }

    /**
     * @param $productId
     */
    private function selectProductLot($productId)
    {
        $sql = "
            select
              *
            from
              trn_wh_product_time
            where
              product_id = ?
              and remain > 0
            order by in_date
        ";

        return DB::select(DB::raw($sql), [$productId]);
    }

    /**
     * @param $productId
     */
    private function selectProductLotToReturn($productId)
    {
        $sql = "
            select
              *
            from
              trn_wh_product_time
            where
              product_id = ?
              and remain = 0
            order by in_date desc
        ";

        return DB::select(DB::raw($sql), [$productId]);
    }

    /**
     * @param $productId
     * @param $ioProduct
     */
    private function exportProduct(
        $productId,
        $ioProduct
    ) {
        $listProductLot = $this->selectProductLot($productId);

        if (!empty($listProductLot)) {
            $amount = $ioProduct->amount;

            foreach ($listProductLot as $productLot) {

                if ($amount <= 0) {
                    break;
                }

                $remain = $productLot->remain;

                if ($remain >= $amount) {
                    $remain -= $amount;
                    $this->updateRemain($productLot->product_id, $productLot->in_date, $remain, $ioProduct->changed_date, $productLot->supplier_delivery_id);
                    $amount = 0;
                } else {
                    $this->updateRemain($productLot->product_id, $productLot->in_date, 0, $ioProduct->changed_date, $productLot->supplier_delivery_id);
                    $amount -= $remain;
                }

            }

        }

    }

    /**
     * @param $productId
     * @param $ioProduct
     */
    private function importRevertProduct(
        $productId,
        $ioProduct
    ) {

        $listProductLot = $this->selectProductLot($productId);

        $amount = $ioProduct->amount;

        if (!empty($listProductLot)) {

            $productLot = $listProductLot[0];

            if ($amount + $productLot->remain <= $productLot->amount) {
                $remain = $amount + $productLot->remain;
                $this->updateRemain($productLot->product_id, $productLot->in_date, $remain, $ioProduct->changed_date, $productLot->supplier_delivery_id);
            } else {
                $amount -= $productLot->amount - $productLot->remain;

                $this->updateRemain($productLot->product_id, $productLot->in_date, $productLot->amount, $ioProduct->changed_date, $productLot->supplier_delivery_id);
                $this->returnProduct($productId, $amount);
            }

        }

    }

    /**
     * @param $productId
     * @param $amount
     */
    private function returnProduct(
        $productId,
        $amount
    ) {

        while ($amount > 0) {
            $listProductToReturn = $this->selectProductLotToReturn($productId);

            if (count($listProductToReturn) > 0) {
                $productLot = $listProductToReturn[0];

                if ($amount + $productLot->remain <= $productLot->amount) {

                    $remain = $amount + $productLot->remain;
                    $amount = 0;
                    $this->updateRemain($productLot->product_id, $productLot->in_date, $remain, null);
                } else {
                    $amount -= $productLot->amount - $productLot->remain;
                    $this->updateRemain($productLot->product_id, $productLot->in_date, $productLot->amount, null);
                }

            } else {
                break;
            }

        }

    }

}
