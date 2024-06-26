<?php namespace App\Services;

use DB;

/**
 * UserService
 */
class UserService
{
    /**
     * Get list of user for dropdownlist
     *
     * @return void
     */
    public function getListUserDropDownList()
    {
        $sqlParam = array();
        $sql      = "
                select
                a.name as user_name
                , a.id as user_id
                from
                users a
                where
                a.id in (
                    select
                    user_id
                    from
                    role_user
                    where
                    role_id in (1, 2, 3, 4, 5, 6, 7, 10)
                )
                group by
                a.id
                order by
                a.id
            ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

}
