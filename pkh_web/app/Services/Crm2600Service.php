<?php

namespace App\Services;

use DB;
use Log;
use Carbon\Carbon;

use App\Models\MstStore;
use App\Services\CommentService;

/**
 * Crm2600Service class
 */
class Crm2600Service extends BaseService
{

    /**
     * Constructor
     *
     * @param CommentService $commentService
     */
    public function __construct(
        CommentService $commentService
    ) {

        $this->commentService = $commentService;
    }

    /**
     * Select store
     *
     * @param [type] $params
     * @return void
     */
    public function selectStore($param)
    {
        $sqlParam = array();
        $sql      = "
        select
          a.store_id
          , a.name
          , a.address
          , a.discount
          , a.level
          , a.area1
          , a.area2
          , a.gps_lat
          , a.gps_long
          , a.img_path
          , a.new_store_id
          , a.dealer_id
          , a.store_sts
          , a.tax_code
          , a.notes
          , a.chanh_id
          , a.address_chanh
          , a.gps_lat_chanh
          , a.gps_long_chanh
          , a.contact_name
          , a.contact_email
          , a.contact_tel
          , a.contact_fax
          , a.contact_mobile1
          , a.contact_mobile2
          , a.bank_name
          , a.bank_branch
          , a.bank_account_no
          , a.bank_account_name
          , a.salesman_id
          , a.inner_flg
          , a.first_order
          , a.accountant_store_id
          , b.name as area1_name
          , c.name as area2_name
          , d.name as area_group_name
          , e.name as chanh_name
          , e.address as chanh_address
          , e.contact_name as chanh_contact_name
          , e.contact_email as chanh_contact_email
          , e.contact_tel as chanh_contact_tel
          , e.contact_fax as chanh_contact_fax
          , e.contact_mobile1 as chanh_contact_mobile1
          , e.contact_mobile2 as chanh_contact_mobile2
          , e.contact_tel as chanh_contact_tel
          , f.name as chanh_area1_name
          , g.name as chanh_area2_name
          , h.name as salesman_name
        from
            mst_store a
          left join mst_area b
            on a.area1 = b.area_id
          left join mst_area c
            on a.area2 = c.area_id
          left join mst_area_group d
            on b.area_group_id = d.area_group_id
          left join mst_chanh e
            on e.chanh_id = a.chanh_id
          left join mst_area f
            on e.area1 = f.area_id
          left join mst_area g
            on e.area2 = g.area_id
          left join users h
            on a.salesman_id = h.id
        where
          a.store_id = ?
        limit 1
        ";

// $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        // $sql .= " limit 1";
        $sqlParam = [$param["store_id"]];

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * Select store in by id
     * @return [type] [description]
     */
    public function selectStoreSign($id)
    {
        Log::info('selectStoreSign:' . $id);
        $sqlParam = array();
        $sql      = "
			select
                a.store_signature_id,
                a.store_id,
                a.img_path,
                a.description
			from
                trn_store_signatures a
			where
			  a.store_id = ?
			  and a.active_flg = '1'
        ";
        Log::info('selectStoreSign:' . $sql);
        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

    /**
     * Review store
     *
     * @param Array $params
     * @return Object
     */
    public function reviewStore($params) {
      Log::info(print_r($params, true));

      $store = MstStore::find($params["store_id"]);
      if(!isset($store)) {
        return array(
          "rtnCd" => false,
          "rtnMsg" => "Không tồn tại store"
        );
      }

      // change type
      $user   = $this->logonUser();
      $type = $params["type"];
      $text = "Ghi chú";
      if ($type == 1) {
        $store->review_sts = "VERIFIED";
        $store->review_user_id = $user->id;
        $store->review_expired_date = $params["review_expired_date"];
        $text = "Duyệt (" . $params["review_expired_date"] . ")";
      } else if ($type == 2) {
        $store->review_sts = "BLACKLIST";
        $store->review_user_id = $user->id;
        $store->review_expired_date = null;
        $text = "Không Duyệt";
      }
      $store->review_date = Carbon::now();
      
      $store->save();

      // add comment
      $commentParam = array();
      $commentParam["group"] = CommentService::STORE_VERIFY;
      $commentParam["user_id"] = $user->id;
      $commentParam["id1"] = $params["store_id"];
      $commentParam["content"] = $text . " - " . (isset($params["content"]) ? $params["content"] : "");
      $this->commentService->addComment($commentParam, $user);

      return array(
        "rtnCd" => true
      );
    }


}
