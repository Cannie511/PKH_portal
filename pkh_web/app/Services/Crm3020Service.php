<?php

namespace App\Services;

use DB;

/**
 * Crm3020Service class
 */
class Crm3020Service extends BaseService
{
    /**
     * @param $params
     * @return void
     */
    public function selectList($param)
    {
        $sqlParam = array();
        $sql = "
            select 
                a.*, 
                min(b.order_date) start_date 
            from 
                mst_store a 
            join 
                trn_store_order b 
            on 
                a.store_id = b.store_id
            where 
                1 = 1
        ";
        $sql .= $this->andWhereInt($param, 'store_id', 'a.store_id', $sqlParam);
        $sql .= "group by a.store_id";
        $list = DB::select(DB::raw($sql), $sqlParam);
        if (count($list) == 0) {
            return null;
        }
        return $list[0];
    }
    public function getTotalSalePerMonth($param)
    {
        $sqlParam = array();
        $list = array();
        $total_sale = 0;

        $sql = "
            SELECT 
                store_id,
                month(order_date) month, 
                year(order_date) year, 
                sum(total_with_discount) sale 
            FROM 
                trn_store_order
            WHERE 
                1 = 1 ";
        $sql .= $this->andWhereInt($param, "store_id", "store_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "year", "year(order_date)", $sqlParam);
        $sql .= "group by month(order_date), year(order_date)";
        $sql .= "order by order_date asc";
        $result = DB::select(DB::raw($sql), $sqlParam);
        foreach ($result as $v) {
            $total_sale += $v->sale;
            $temp = [
                "month" => $v->month,
                "year" => $v->year,
                "sale" => $total_sale,
                "gap_sale" => $v->sale
            ];
            array_push($list, $temp);
        }
        return $list;
    }
    public function getRetentionParam($param, $year)
    {
        $sqlParam = array();
        $sql = "
            select 
                store_id, 
                min(order_date), 
                timestampdiff
                (
                    year, min(order_date), 
                    '" . $year . "'
                ) 
                    retention 
            from 
                trn_store_order
            where 
                1=1 ";
        $sql .= $this->andWhereInt($param, 'store_id', 'store_id', $sqlParam);
        $sql .= " group by store_id";

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (count($list) === 0)
            return null;
        return $list[0]->retention;
    }
    public function getOrderFrequency($param)
    {
        $sqlParam = array();
        $list = array();
        $total_order = 0;

        $sql = "
            SELECT 
                month(a.order_date) month,
                year(a.order_date) year,
                COUNT(*) order_month 
            from 
                trn_store_order a
            join 
                mst_store b 
            on 
                a.store_id = b.store_id
            where 
                1=1 
        ";
        $sql .= $this->andWhereInt($param, "store_id", "a.store_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "year", "year(a.order_date)", $sqlParam);
        $sql .= " GROUP BY month(a.order_date), year(order_date)";
        $result = DB::select(DB::raw($sql), $sqlParam);
        foreach ($result as $v) {
            $total_order += $v->order_month;
            $temp = [
                "total_order" => round($total_order / 12, 2),
                "gap" => $v->order_month
            ];
            array_push($list, $temp);
        }
        if (count($list) === 0)
            return null;
        return $list;
    }
    function getDeliveryOrder($param)
    {
        $sqlParam = array();
        $sql = "
            select 
                month(delivery_date) month, 
                year(delivery_date) year,
                count(store_delivery_id) all_order 
            from 
                trn_store_payment_status 
            where 
                1=1 
        ";
        $sql .= $this->andWhereInt($param, "store_id", "store_id", $sqlParam);
        $sql .= $this->andWhereInt($param, "year", "year(delivery_date)", $sqlParam);
        $sql .= " GROUP BY month(delivery_date), year(delivery_date)";
        $all_order = DB::select(DB::raw($sql), $sqlParam);
        return $all_order;
    }
    public function getPaymentHistory($param)
    {
        $sqlParam = array();
        $sql = "
            select 
                month(delivery_date) month, 
                year(delivery_date) year, 
                count(timestampdiff(day,delivery_date, payment_date)) payment_history 
            from 
                trn_store_payment_status 
            where 
                timestampdiff(day,delivery_date, payment_date) < 0 ";

        $sql .= $this->andWhereInt($param, 'store_id', 'store_id', $sqlParam);
        $sql .= $this->andWhereInt($param, "year", "year(delivery_date)", $sqlParam);
        $sql .= "GROUP by month(delivery_date), year(delivery_date)";
        $result = DB::select(DB::raw($sql), $sqlParam);
        $order = $this->getDeliveryOrder($param);
        $paymentArray = array_filter($result, function ($p) use ($order) {
            foreach ($order as $o) {
                if ($p->month == $o->month && $p->payment_history === $o->all_order) {
                    return true;
                }
            }
            return false;
        });

        return $paymentArray;
    }

    public function getTotalScore($param){
        $total_score = 0;
        $sale = $this->getTotalSalePerMonth($param);
        $retention = $this->getRetentionParam($param);
        $OD = $this->getOrderFrequency($param);
        $payment = $this->getPaymentHistory($param);
        $avg_sale = $this->getAverageSalePerYear($param);
        $avg_OD = getAverageOderFrequencyPerYear($param);

        if ($sale >= $avg_sale)
            $total_score += 25;
        else
            $total_score += 10;
        if ($retention >= 3)
            $total_score += 25;
        else
            $total_score += 10;
        if ($OD >= $avg_OD)
            $total_score += 25;
        else
            $total_score += 10;
        if ($payment)
            $total_score += 25;
        else
            $total_score += 15;
        return $total_score;
    }
}
