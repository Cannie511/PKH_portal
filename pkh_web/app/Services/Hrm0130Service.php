<?php

namespace App\Services;

use DB;

/**
 * Hrm0130Service class
 */
class Hrm0130Service extends BaseService
{
    /**
     * @return mixed
     */
    public function selectListYear()
    {
        $sql = "
			select distinct
			  year(a.absent_date) as year
			from
			  trn_absent a
			order by
			  year(a.absent_date) desc
        ";

        $result = DB::select(DB::raw($sql));

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
            a.name as user_name
            , a.id as user_id
            , month (b.absent_date) as month
            , sum(b.amount) as amount
            from
            users a
            left join trn_absent b
                on a.id = b.user_id
            where
                a.id in ( select user_id from role_user where role_id in (1,2,3,4,5,6,7,10))
                and
                (b.user_id is null)
                or
                (b.status = 1
                and (year (b.absent_date) = ?) )

            group by
            a.id
		    , year (b.absent_date)
			, month (b.absent_date)
            order by a.id
        ";

        $sqlParam[] = $param['year'];
        // $result = array();
        // $result =  $this->pagination($sql, $sqlParam, $param);
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListForSales($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                month(a.track_time) as month,
                b.name as user_name,
                b.id as user_id ,
                count(distinct date(a.track_time)) as amount
            from
                trn_user_pos_his  a left join users b
                on a.user_id = b.id
                left join role_user c
                on b.id = c.user_id
            where
                c.role_id = 5 and year(a.track_time) = ?
            group by
                month(a.track_time),
                b.name,
                b.id
        ";

        $sqlParam[] = $param['year'];
        // $result = array();
        // $result =  $this->pagination($sql, $sqlParam, $param);
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function selectListForCheckin($param)
    {
        $sqlParam = array();
        $sql      = "
        select
            b.id as user_id
            , b.name as user_name
            , month (a.working_time) as month
            , count(distinct date (a.working_time)) as amount
        from
            trn_store_check_in a
            left join users b
            on a.salesman_id = b.id
            left join role_user c
            on b.id = c.user_id
        where
            c.role_id = 5
            and year (a.working_time) = ?
        group by
            b.id
            , b.name
            , month (a.working_time)
        ";

        $sqlParam[] = $param['year'];
        // $result = array();
        // $result =  $this->pagination($sql, $sqlParam, $param);
        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

}
