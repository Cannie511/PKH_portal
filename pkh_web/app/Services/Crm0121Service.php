<?php

namespace App\Services;

use DB;
use App\Models\MstProductCat1;

use App\Models\MstProductCat2;

/**
 * Crm0121Service class
 */
class Crm0121Service extends BaseService
{
    // public function selectSupplier()
    // {
    //     $sqlParam = array();
    //     $sql      = "
    //         select
    //             a.supplier_id
    //             , a.name
    //             , a.supplier_code
    //             , a.contact_name
    //             , a.contact_email
    //             , a.contact_tel
    //             , a.contact_fax
    //             , a.contact_mobile1
    //             , a.contact_mobile2
    //         from
    //             mst_supplier a
    //     ";

    //     $result = array();

    //     return DB::select(DB::raw($sql), $sqlParam);
    // }

    /**
     * @param $productCatId
     * @return mixed
     */
    public function loadProductCat($productCatId)
    {
        $sqlParam = array();
        $sql      = "
         select
            a.product_cat1_id
            , a.supplier_id
            
            , a.name
           
        from
            mst_product_cat1 a
        where
            a.active_flg = 1
            and a.product_cat1_id = ?

        ";
        $sqlParam[] = $productCatId;

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

    /**
     * @param $params
     */
    public function create($params)
    {
        $logonUser = $this->logonUser();

        $entity                   = new MstProductCat1();
     
        $entity->supplier_id      = $params['supplier_id'];
        $entity->name             = $params['name'];
       
        $this->updateRecordHeader($entity, $logonUser, true);
        $entity->save();

        return [
            'rtnCd' => true,
            'msg'   => "Đã thêm loại sản phẩm ",
        ];
    }

    /**
     * @param $params
     */
    public function update($params)
    {
        $logonUser = $this->logonUser();

        $entity = MstProductCat1::find($params['product_cat1_id']);

        if (!isset($entity)) {
            return [
                'rtnCd' => false,
                'msg'   => 'Không tìm thấy loại sản phẩm.',
            ];
        }

        $entity->supplier_id      = $params['supplier_id'];
        $entity->name             = $params['name'];
       
        $this->updateRecordHeader($entity, $logonUser, false);
        $entity->save();


        $entity2 = new MstProductCat2();
        $entity2->product_cat1_id =  $params['product_cat1_id'];
        $entity2->supplier_id      = $params['supplier_id'];
        $entity2->name             = $params['name1'];
        $this->updateRecordHeader($entity2, $logonUser, false);
        $entity2->save();

        return [
            'rtnCd' => true,
            'msg'   => "Đã cập nhật loại sản phẩm",
        ];
    }

}
