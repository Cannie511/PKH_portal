<?php

namespace App\Services;

use DB;

/**
 * Crm0350Service class
 */
class Crm0350Service extends BaseService
{
    public function selectChanhListDropdown()
    {
        $sqlParam = [];
        $sql      = "
                select
                    a.chanh_id
                    ,CONCAT(a.name, '_', a.address) as name
                from
                    mst_chanh a
            ";
        $sql .= "
                where
                a.active_flg = '1'
                ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectChanhList($param)
    {
        $sqlParam = [];
        $sql      = "
			select
                a.chanh_id
                , a.name
                , a.address
                , a.area1
                , a.area2
                , a.img_path
                , a.chanh_sts
                , a.contact_name
                , a.contact_email
                , a.contact_tel
                , a.contact_fax
                , a.contact_mobile1
                , a.contact_mobile2
                , a.created_at
                , a.created_by
                , a.updated_at
                , b.name as updated_by
                , a.version_no
                , c.name area1_name
                , d.name area2_name
            from
                mst_chanh a
                left join users b
                    on a.updated_by = b.id
                left join mst_area c on c.area_id = a.area1
			    left join mst_area d on d.area_id = a.area2
		";

        $sql .= "
			where
			  a.active_flg = '1'
			 ";

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

        $sql .= $this->andWhereInt($param, 'area1', 'a.area1', $sqlParam);
        $sql .= $this->andWhereInt($param, 'area2', 'a.area2', $sqlParam);

        $sql .= "
			order by
			   a.created_at
        ";
        // d.name, a.name

        return $this->pagination($sql, $sqlParam, $param);
    }

}
