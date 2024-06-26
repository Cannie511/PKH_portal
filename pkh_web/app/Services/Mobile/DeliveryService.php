<?php

namespace App\Services\Mobile;

use Image;
use App\Services\BaseService;
use App\Services\ImageService;
use App\Models\TrnStoreDelivery;
use App\Models\TrnStoreDeliverySign;
use App\Models\TrnStoreDeliveryDetail;

class DeliveryService extends BaseService
{
    /**
     * @var mixed
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function selectList($params)
    {

        $sqlParam = array();
        $sql      = "
            select
                a.store_delivery_id
                , a.delivery_time as delivery_date
                , a.delivery_sts
                , a.store_order_id
                , b.store_order_code
                , a.store_delivery_code
                , b.store_id
                , c.name store_name
                , c.address
                , a.discount_1
                , a.discount_2
                , b.order_date
                , e.promotion_name
                , a.total
                , a.total_with_discount
                , a.salesman_id
                , d.name as salesman_name
                , cc.name as current_salesman_name
                , a.order_type
                , a.updated_at
                , f.name as updated_by
                , g.branch_name
                , c.area1
                , c.area2
                , h.name as area1_name
                , k.name as area2_name
            from
                trn_store_delivery a
                left join trn_store_order b
                    on a.store_order_id = b.store_order_id
                left join mst_store c
                    on b.store_id = c.store_id
                left join users d
                    on a.salesman_id = d.id
                left join mst_promotion e
                    on b.promotion_id = e.promotion_id
                left join users f
                    on f.id = a.updated_by
                left join mst_branch g
                    on g.branch_id = a.branch_id
                left join users cc
                   on c.salesman_id = cc.id
                join mst_area h
                    on h.area_id = c.area1
                join mst_area k
                    on k.area_id = c.area2
            where
                a.active_flg = '1' ";

        $sql .= $this->andWhereInt($params, 'promotion_id', 'b.promotion_id', $sqlParam);
        $sql .= $this->andWhereInt($params, 'salesman_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereInt($params, 'order_type', 'a.order_type', $sqlParam);
        $sql .= $this->andWhereInt($params, 'branch_id', 'a.branch_id', $sqlParam);
        $sql .= $this->andWhereString($params, 'store_delivery_code', 'a.store_delivery_code', $sqlParam);
        $sql .= $this->andWhereString($params, 'store_name', 'c.name', $sqlParam);
        $sql .= $this->andWhereString($params, 'delivery_sts', 'a.delivery_sts', $sqlParam, true);
        $sql .= $this->andWhereDateInMonthOfDate($params, 'delivery_date', 'a.delivery_date', $sqlParam);
        $sql .= $this->andWhereInt($params, 'sale_id', 'c.salesman_id', $sqlParam);

        return $this->pagination($sql, $sqlParam, $params);
    }

    /**
     * @param $id
     */
    public function getDetail($id)
    {

        $delivery = TrnStoreDelivery::find($id);
        $details  = TrnStoreDeliveryDetail::where('store_delivery_id', $id)
            ->select(["store_delivery_id", "product_id", "seq_no", "amount", "unit_price"])
            ->orderBy("seq_no")
            ->get();

        return [
            "delivery" => $delivery,
            "details"  => $details,
        ];
    }

    /**
     * @param $param
     */
    public function sign($param)
    {

        $logonUser = $this->logonUser();

        if (!isset($param["image"])) {
            return ["msg" => "Image can't empty"];
        }

        $delivery = TrnStoreDelivery::find($param["store_delivery_id"]);

        if (!isset($delivery)) {
            return ["msg" => "Store working is not exists"];
        }

        $entity                    = new TrnStoreDeliverySign();
        $entity->store_delivery_id = $delivery->store_delivery_id;

        if (isset($param["description"])) {
            $entity->description = $param["description"];
        }

        $img_path = $this->uploadFile($param["image"], "delivery_sign_" . $entity->store_delivery_id . substr(md5($entity->store_delivery_id . '-' . time()), 0, 15));

        if ("" != $img_path) {
            $entity->img_path = $img_path;
            $entity->save();

            return ["store_delivery_sign_id" => $entity->store_delivery_sign_id];
        }

        return [];
    }

    /**
     * @param $file
     * @param $imageFileName
     * @return mixed
     */
    private function uploadFile(
        $file,
        $imageFileName
    ) {
        $imagePath = "";

        if (isset($file)) {
            $imagePath = $this->imageService->saveFromBase64($file, $imageFileName, "/image/delivery_sign", 640, 240);
        }

        return $imagePath;
    }

}
