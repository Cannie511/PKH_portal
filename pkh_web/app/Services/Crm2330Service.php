<?php

namespace App\Services;

/**
 * Crm2330Service class
 */
class Crm2330Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectBranchImport($param)
    {
        $sqlParam = array();
        $sql      = "
			select
                a.branch_import_id
                , b.branch_name as branch_id_from
                , c.branch_name as branch_id_to
                , a.branch_import_code
                , a.total
                , a.total_with_discount
                , a.import_sts
                , a.notes
                , a.cancel_time
                , a.confirm_time
                , a.import_time
                , a.confirm_by
                , a.import_by
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , d.name as updated_by
                , a.version_no
            from
                trn_branch_import a
                left join mst_branch b
                    on a.branch_id_from = b.branch_id
                left join mst_branch c
                    on a.branch_id_to = c.branch_id
                left join users d
                    on a.updated_by = d.id
            where
                a.active_flg = '1'
			";

        $sql .= "
  			order by  a.created_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
