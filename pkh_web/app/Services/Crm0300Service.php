<?php

namespace App\Services;

use DB;
use Log;
use App\Models\MstStore;
use App\Services\ZaloService;

class Crm0300Service extends BaseService
{
    public function __construct(ZaloService $zaloService) {
        $this->zaloService = $zaloService;
    }

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
              , a.level
              , a.discount
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
              , e.id as salesman_id
			  , e.name as salesman_name
			  , f.name area_group_name
			  , CONCAT(g.name, '_', g.address) as chanh_name
              , a.review_sts
              , a.review_expired_date
			from
			  mst_store a
			  left join mst_area b on b.area_id = a.area1
			  left join mst_area c on c.area_id = a.area2
			  left join mst_dealer d on d.dealer_id = a.dealer_id
			  left join mst_area_group f on b.area_group_id = f.area_group_id
			  left join mst_chanh g on a.chanh_id = g.chanh_id
		";

        if (0 != $param['salesman'] && '0' != $param['salesman'] && null != $param['salesman'] && -1 != $param['salesman'] && '-1' != $param['salesman']) {

            $sql .= ' join users e on e.id = a.salesman_id and e.id = ? ';
            $sqlParam[] = $param['salesman'];
        } else {
            $sql .= ' left join users e on e.id = a.salesman_id  ';
        }

        $sql .= "
			where
			  a.active_flg = '1'
			 ";

        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'level', 'a.level', $sqlParam);

        $sql .= $this->andWhereInt($param, 'sale_id', 'a.salesman_id', $sqlParam);
        $sql .= $this->andWhereString($param, 'name', 'a.name', $sqlParam);

// $sql .= $this->andWhereString($param, 'dealer_name', 'd.name', $sqlParam );

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

        if (0 == $param['salesman'] || '0' == $param['salesman']) {
            $sql .= ' and e.id is null ';
        }

        $sql .= $this->andWhereInt($param, 'areaGroup', 'f.area_group_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area1', 'a.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'a.area2', $sqlParam);
        $sql .= $this->andWhereInt($param, 'chanh_area1', 'g.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'chanh_area2', 'g.area2', $sqlParam);

        $sql .= $this->andWhereDateInMonthOfString($param, 'month', 'a.first_order', $sqlParam);

// $sql .= $this->andWhereString($param, 'inner_type', 'a.inner_flg', $sqlParam , true);
        if (isset($param['inner_type'])) {
            if ('1' == $param['inner_type']) {
                $sql .= ' and a.inner_flg = 1 ';
            } elseif ('2' == $param['inner_type']) {
                $sql .= ' and a.first_order is null ';
            } elseif ('3' == $param['inner_type']) {
                $sql .= ' and (a.contact_name is null ) ';
            } elseif ('4' == $param['inner_type']) {
                $sql .= ' and (a.gps_lat = 0 or a.gps_long = 0 ) ';
            } elseif ('5' == $param['inner_type']) {
                $sql .= '  and a.first_order is not null ';
            }

        }

        if (isset($param['review_type']) && $param['review_type'] != "") {
            // <option value='1'>Chưa duyệt</option>
            // <option value='2'>Đã duyệt</option>
            // <option value='3'>Hết hạn</optiooptioooon>
            // <option value='4'>Từ chối</option>
            if ('1' == $param['review_type']) {
                $sql .= " and a.review_sts = '' ";
            } else if ('2' == $param['review_type']) {
                $sql .= " and a.review_sts = 'VERIFIED' ";
            } else if ('3' == $param['review_type']) {
                $sql .= " and a.review_sts = 'VERIFIED' and a.review_expired_date < NOW()";
            } else if ('4' == $param['review_type']) {
                $sql .= " and a.review_sts = 'BLACKLIST' ";
            }
        }

        $sql .= "
			order by
			  a.first_order desc, a.name
        ";

// d.name, a.name
        if (isset($param['down']) && 1 == $param['down']) {
            return DB::select(DB::raw($sql), $sqlParam);
        }

        return $this->pagination($sql, $sqlParam, $param);
    }

    /**
     * @param $param
     * @return int
     */
    public function updateSaleForStore($param)
    {
        MstStore::where('store_id', $param['store_id'])
            ->update([
                'salesman_id' => $param['salesman_id'],
            ]);

        return 1;

    }

    public function updateZalo() {
        // Get list followers from db
        $listZaloId = MstStore::select('zalo_user_id')->whereNotNull('zalo_user_id')->get();

        Log::info(count($listZaloId));

        // Get list followers from zalo
        // $followers = $this->zaloService->getFollowers(0, 5);
        $followers = $this->zaloService->getAllFollowers();
        Log::info(print_r($followers, true));

        // Update user information which haven't stored in db yet

        return $followers;
    }

}
