<?php

namespace App\Services;

use DB;

/**
 * Crm2601Service class
 */
class Crm2601Service extends BaseService
{
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
          , a.active_flg
          , a.created_at
          , a.created_by
          , a.updated_at
          , a.updated_by
          , a.version_no
          , b.name as area1_name
          , c.name as area2_name
          , d.name as area_group_name
          , a.review_sts
          , a.review_expired_date
        from
          mst_store a
          left join mst_area b
            on a.area1 = b.area_id
          left join mst_area c
            on a.area2 = c.area_id
          left join mst_area_group d
            on b.area_group_id = d.area_group_id
        where
          a.store_id = ?
        limit 1
        ";

        $sqlParam = [$param["store_id"]];

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

}
