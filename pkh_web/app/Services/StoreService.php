<?php namespace App\Services;

use DB;

/**
 * Store Service
 */
class StoreService extends BaseService
{
    /**
     * Search store for sales
     * @param  [type] $param [description]
     * @return [type]        list product
     */
    public function selectStoreList($param)
    {

        $sqlParam = [];
        $sql      = "
			select
			  a.store_id
			  , a.name
			  , a.address
			  , a.area1
			  , b.name area1_name
			  , a.area2
			  , c.name area2_name
			  , a.gps_lat
			  , a.gps_long
			  , a.img_path
			  , a.new_store_id
			  , a.dealer_id
			  , d.name dealer_name
			  , a.first_order
			  , a.store_sts
			  , a.contact_name
			  , a.contact_email
			  , a.contact_tel
			  , a.contact_fax
			  , a.contact_mobile1
			  , a.contact_mobile2
			  , a.active_flg
			  , a.created_at
			  , a.created_by
			  , a.updated_at
			  , a.updated_by
			  , a.version_no
			  , e.name as salesman_name
			  , a.salesman_id
              , a.review_sts
			from
			  mst_store a
			  left join mst_area b on b.area_id = a.area1
			  left join mst_area c on c.area_id = a.area2
			  left join mst_dealer d on d.dealer_id = a.dealer_id
			  left join users e on e.id = a.salesman_id
			where
			  a.active_flg = '1'
			 ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);
        $sql .= $this->andWhereString($param, 'dealer_name', 'd.name', $sqlParam);

        if (isset($param['contact']) && strlen($param['contact']) > 0) {
            $paramContact = '%' . strtolower($param['contact']) . '%';
            $sql .= $this->andWhere(
                $param,
                'contact',
                " (a.contact_tel like ?  or a.contact_fax like ? or a.contact_mobile1 like ? or a.contact_mobile2 like ? ) ",
                $sqlParam,
                [$paramContact, $paramContact, $paramContact, $paramContact]
            );
        }

        $sql .= "
			order by
			  a.name
        ";
        // d.name, a.name

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * Select store in by id
     * @return [type] [description]
     */
    public function selectStoreById($id)
    {
        $sql = "
			select
			  a.store_id
			  , a.name
			  , a.salesman_id
			  , a.address
			  , a.discount
			  , a.level
			  , a.notes
			  , a.area1
			  , b.name area1_name
			  , a.area2
			  , c.name area2_name
			  , a.gps_lat
			  , a.gps_long
			  , a.img_path
			  , a.new_store_id
			  , a.dealer_id
			  , d.name dealer_name
			  , a.store_sts
			  , a.contact_name
			  , a.contact_email
			  , a.contact_tel
			  , a.contact_fax
			  , a.contact_mobile1
			  , a.contact_mobile2
			  , a.tax_code
              , a.review_sts
              , a.review_expired_date
			 , CONCAT(
				g.name
				, '_'
				, g.address
				, '_'
				, ifnull( g.contact_name,'')
				, '_'
				, ifnull(g.contact_tel,'')
				, '_'
				, ifnull(g.contact_mobile1,'')
			) as address_chanh
			  , a.active_flg
			  , a.created_at
			  , a.created_by
			  , a.updated_at
			  , a.updated_by
			  , a.version_no
			  , e.name as salesman_name
			from
			  mst_store a
			  left join mst_area b on b.area_id = a.area1
			  left join mst_area c on c.area_id = a.area2
			  left join mst_dealer d on d.dealer_id = a.dealer_id
			  left join users e on e.id = a.salesman_id
			  left join mst_chanh g on a.chanh_id = g.chanh_id
			where
			  a.active_flg = '1'
			  and a.store_id = :store_id ";

        $sqlParam = [
            'store_id' => $id,
        ];

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return $result;
    }

    /**
     * Select store in by id
     * @return [type] [description]
     */
    public function selectStoreSign($id)
    {
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

        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

}
