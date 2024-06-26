<?php

namespace App\Services;

/**
 * Crm0800Service class
 */
class Crm0800Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
				select
				    a.check_date
				  , a.id
				  , b.name
				  , c.branch_name
				  , e.name as warehouse_name
				  , a.checking_sts
				  , a.notes
				  , a.updated_at
					, d.name as updated_by
				from
					trn_check_warehouse a
						left join users b
						on a.check_user_id = b.id
					left join mst_branch c
						on a.branch_id = c.branch_id
					left join users d
						on a.updated_by  = d.id
					left join mst_warehouse e
						on a.warehouse_id = e.warehouse_id

				where
			        a.active_flg = '1'
        ";
        $sql .= $this->andWhereDateBetween($param, 'delivery_start_date', 'delivery_end_date', 'a.check_date', $sqlParam);
        $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam);
        $sql .= $this->andWhereInt($param, 'warehouse_id', 'a.warehouse_id', $sqlParam);

        $sql .= "
        	order by a.check_date desc
          ";
        // return DB::select(DB::raw($sql), $sqlParam);

        return $this->pagination($sql, $sqlParam, $param);
    }

}
