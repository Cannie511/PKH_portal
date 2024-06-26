<?php

namespace App\Services;

use DB;
use App\Models\TrnProductMarketHis;

/**
 * Crm2540Service class
 */
class Crm2540Service extends BaseService
{
    /**
     * @param $id
     * @return mixed
     */
    public function loadProductMarketHis($id)
    {
        $sqlParam = array($id);
        $sql      = "
        select
        a.product_market_his_id
        , a.warehouse_change_type
        , a.product_market_id
        , a.changed_date
        , a.store_id
        , a.price
        , a.amount
        , a.status
        , a.description
        , a.description_approve
        , b.type
      from
        trn_product_market_his a
        left join mst_product_market b
          on a.product_market_id = b.product_market_id
      where
        a.product_market_his_id = ?
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * Load list product market for dropdownlist
     *
     * @return void
     */
    public function loadListProductMarket()
    {

        $sqlParam = array();
        $sql      = "
        select
          a.product_market_id
          , a.type
          , a.name
          , a.img_path
        from
          mst_product_market a
        order by
          a.type
          , a.name
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;

    }

    /**
     * Create product market
     *
     * @param [type] $params
     * @return void
     */
    public function create($params)
    {
        $entity = new TrnProductMarketHis();

        $this->editEntity($entity, $params);

        return [
            'rtnCd' => true,
            'msg'   => "Đã thêm sản phẩm $entity->name",
        ];
    }

    /**
     * Update product market
     *
     * @param [type] $params
     * @return void
     */
    public function update($params)
    {
        $entity = TrnProductMarketHis::find($params["product_market_his_id"]);

        if (1 != $entity->status) {
            return [
                'rtnCd' => false,
                'msg'   => "Không thể cập nhật khi đã xác nhận. Vui lòng tạo mới.",
            ];
        }

        $this->editEntity($entity, $params);

        return [
            'rtnCd' => true,
            'msg'   => "Đã cập nhật sản phẩm $entity->name",
        ];
    }

    /**
     * @param $entity
     * @param $params
     */
    private function editEntity(
        $entity,
        $params
    ) {
        $logonUser = $this->logonUser();

        $entity->warehouse_change_type = $params["warehouse_change_type"];
        $entity->product_market_id     = $params["product_market_id"];
        $entity->changed_date          = $params["changed_date"];
        $entity->price                 = $params["price"];
        $entity->amount                = $params["amount"];
        $entity->store_id              = $params["store_id"];

        if (isset($params["description"])) {
            $entity->description = $params["description"];
        }

        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();
    }

    /**
     * Update status
     *
     * @param [type] $params
     * @return void
     */
    public function updateStatus($params)
    {
        $logonUser = $this->logonUser();
        $entity    = TrnProductMarketHis::find($params["product_market_his_id"]);

        $entity->status = $params["status"];

        if (isset($params["description_approve"])) {
            $entity->description_approve = $params["description_approve"];
        }

        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();

        return [
            'rtnCd' => true,
            'msg'   => "Đã cập nhật sản phẩm $entity->name",
        ];
    }

}
