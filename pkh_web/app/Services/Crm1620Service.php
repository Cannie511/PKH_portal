<?php

namespace App\Services;

/**
 * Crm1620Service class
 */
class Crm1620Service extends BaseService
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
                a.supplier_delivery_id
                , a.supplier_order_id
                , a.supplier_id
                , a.pi_no
                , a.delivery_date
                , a.payment_1_date
                , a.finish_cont_date
                , a.deliver_cont_date
                , a.arrive_port_date
                , a.comming_pkh_date
                , a.payment_2_date
                , a.payment_1_percent
                , a.payment_2_duration
                , a.finish_cont_expected_date
                , a.deliver_cont_expected_date
                , a.arrive_port_expected_date
                , a.comming_pkh_expected_date
                , a.payment_2_expected_date
                , a.delivery_sts
                , a.notes
                , b.send_po_date
                , c.supplier_code
            from
                trn_supplier_delivery a
                left join trn_supplier_order b
                    on a.supplier_order_id = b.supplier_order_id
                left join mst_supplier c
                    on a.supplier_id = c.supplier_id
            where
                a.active_flg = 1
        ";

        $result = array();
        //$sql .= $this->andWhereDateBetween($param, 'order_start_date','order_end_date', 'a.order_date', $sqlParam );
        $sql .= $this->andWhereString($param, 'pi_no', 'a.pi_no', $sqlParam);
        $sql .= $this->andWhereInt($param, 'supplier_id', 'a.supplier_id', $sqlParam);

        $sql .= "order by   a.created_at desc ";

        return $this->pagination($sql, $sqlParam, $param);
    }
}
