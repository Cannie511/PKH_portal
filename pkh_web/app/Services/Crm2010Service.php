<?php

namespace App\Services;

use DB;
use App\Models\MstBranch;

/**
 * Crm2010Service class
 */
class Crm2010Service extends BaseService
{
    /**
     * @param $param
     */
    public function selectBranch($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.branch_id
                , a.branch_name
                , a.branch_address
                , a.branch_contact
                , a.started_date
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                mst_branch a
            where
                a.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveBranch(
        $user,
        $param
    ) {
        $branch = null;
        $status = false;

        if (isset($param['branch_id']) && ($param['branch_id'] > 0)) {
            $branch = MstBranch::find($param['branch_id']);
            $this->updateRecordHeader($branch, $user, false);
        } else {
            $branch = new MstBranch();
            $this->updateRecordHeader($branch, $user, true);
        }

        if (null != $branch) {
            $branch->branch_name    = $param['branch_name'];
            $branch->branch_address = $param['branch_address'];
            $branch->branch_contact = $param['branch_contact'];
            $branch->started_date   = $param['started_date'];
            $branch_id              = $branch->branch_id;
            DB::transaction(function () use ($branch) {
                $branch->save();
            });
            $status = true;
        }

        $res = [
            "status"    => $status,
            "branch_id" => $branch_id,
        ];

        return $res;
    }

}
