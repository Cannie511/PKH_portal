<?php

namespace App\Services;

use DB;
use Log;
use App\Models\MstPromotion;

/**
 * Crm1710Service class
 */
class Crm1710Service extends BaseService
{
    /**
     * @param $param
     */
    public function selectPromotion($param)
    {
        $sqlParam = array();
        $sql      = "
           Select
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
                a.active_flg = 1
        ";

        $sql .= $this->andWhereInt($param, 'promotion_id', 'a.promotion_id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function savePromotion(
        $user,
        $param
    ) {

        $promotion = null;

        if (isset($param['promotion_id']) && ($param['promotion_id'] > 0)) {

            $promotion = MstPromotion::find($param['promotion_id']);
            $this->updateRecordHeader($promotion, $user, false);
        } else {
            $promotion = new MstPromotion();

            $this->updateRecordHeader($promotion, $user, true);
        }

        if (null != $promotion) {
            $promotion->promotion_name = $param['promotion_name'];
            $promotion->from_date      = $param['from_date'];
            $promotion->to_date        = $param['to_date'];
            $promotion->promotion_type = $param['promotion_type'];
            $promotion->promotion_sts  = $param['promotion_sts'];
            $promotion->meta_data      = $param['meta_data'];
            $promotion->description    = $param['description'];
            // chưa gán giá trị cho bank account

            DB::transaction(function () use ($promotion) {
                $promotion->save();
            });
        }

        Log::debug('ahihihih');
        Log::debug($promotion);

        return $promotion->promotion_id;
    }

}
