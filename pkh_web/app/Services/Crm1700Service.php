<?php

namespace App\Services;

/**
 * Crm1700Service class
 */
class Crm1700Service extends BaseService
{
    /**
     * @param $param
     * @return mixed
     */
    public function selectPromotionList($param)
    {
        $sqlParam = array();
        $sql      = "
            select
                a.promotion_id
                , a.from_date
                , a.to_date
                , a.promotion_name
                , a.promotion_type
                , a.promotion_sts
                , a.description
                , a.meta_data
                , a.active_flg
                , a.created_at
                , a.created_by
                , a.updated_at
                , a.updated_by
                , a.version_no
            from
                mst_promotion a
            where
                a.active_flg =1
      ";

        $sql .= $this->andWhereString($param, 'promotion_name', 'a.promotion_name', $sqlParam);
        $sql .= $this->andWhereInt($param, 'promotion_sts', 'a.promotion_sts', $sqlParam);
        //$sql .= $this->andWhereInt($param,'bank_account_no','a.bank_account_no',$sqlParam);
        //$sql .= $this->andWhereDateBetween($param, 'from_date','to_date', 'a.payment_date', $sqlParam );
        $sql .= "
            order by a.created_at desc,a.updated_at desc
          ";

        return $this->pagination($sql, $sqlParam, $param);
    }

}
