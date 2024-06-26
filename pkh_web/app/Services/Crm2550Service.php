<?php

namespace App\Services;

/**
 * Crm2550Service class
 */
class Crm2550Service extends BaseService
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
                a.product_market_id
                , b.type
                , b.code
                , b.name
                , b.img_path
                , sum(
                case a.warehouse_change_type
                    when '1' then a.amount
                    else 0
                    end
                ) as total_amount_in
                , sum(
                case a.warehouse_change_type
                    when '2' then a.amount
                    else 0
                    end
                ) as total_amount_out
                , sum(
                case a.warehouse_change_type
                    when '1' then a.amount * a.price
                    else 0
                    end
                ) as total_money_in
                , sum(
                case a.warehouse_change_type
                    when '2' then a.amount * a.price
                    else 0
                    end
                ) as total_money_out
            from
                trn_product_market_his a
                left join mst_product_market b
                on b.product_market_id = a.product_market_id
            where
                a.active_flg = '1'
                and a.changed_date <= '2019-11-31'
                and a.status in (1,2)
        ";

        $sql .= $this->andWhereDate($param, 'toDate', 'a.changed_date', '<', $sqlParam);

        $sql .= "
            group by
                a.product_market_id
        ";

        $result = [];

        if (isset($param['export']) && true == $param['export']) {
            $result = DB::select(DB::raw($sql), $sqlParam);
        } else {
            $result = $this->pagination($sql, $sqlParam, $param);
        }

        return $result;
    }

}
