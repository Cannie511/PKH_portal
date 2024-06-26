<?php

namespace App\Services\Mobile;

use DB;
use App\Services\BaseService;

/**
 * UserService class
 */
class UserService extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
        select
          a.id
          , a.name
          , a.email
          , a.last_login_at
          , a.store_id
          , a.supplier_id
          , a.branch_id
          , a.active_flg
          , a.created_at
          , a.created_by
          , a.updated_at
          , a.updated_by
          , a.version_no
        from
          users a join role_user b
            on a.id = b.user_id
            and b.role_id in (1, 2, 3, 4, 5, 6, 7, 10)
            ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectById($param)
    {
        $sqlParam = array();
        $sql      = "
        select
          a.id
          , a.name
          , a.email
          , a.last_login_at
          , a.store_id
          , a.supplier_id
          , a.branch_id
          , a.active_flg
          , a.created_at
          , a.created_by
          , a.updated_at
          , a.updated_by
          , a.version_no
        from
          users a join role_user b
            on a.id = b.user_id
            and b.role_id in (1, 2, 3, 4, 5, 6, 7, 10)
            ";

        $sql .= $this->andWhereInt($param, 'id', 'a.id', $sqlParam);

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

}
