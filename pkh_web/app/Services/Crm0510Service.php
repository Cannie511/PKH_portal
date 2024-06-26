<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\TrnCsNotes;

class Crm0510Service extends BaseService
{
/**
 * @param $param
 */
    public function selectCSNotes($param)
    {
        $sqlParam = array();
        $sql      = "
        select
                b.name as store_name
                , c.name as created_by
                , f.name as salesman_name
                , a.created_at
                , a.cus_rating
                , a.status
                , a.cus_review
                , a.com_resolve
                , a.deadline
            from
                trn_cs_notes a left join mst_store b
                on a.store_id = b.store_id
                left join users c
                on a.created_by = c.id
                left join users f
                    on b.salesman_id = f.id
            where
                a.active_flg = '1'
        ";

        $sql .= $this->andWhereInt($param, 'cs_id', 'a.id', $sqlParam);

        //$result =  $this->pagination($sql, $sqlParam, $param);

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveCSNotes(
        $user,
        $param
    ) {
        $cs = null;

        if (isset($param['cs_id']) && ($param['cs_id'] > 0)) {
            $cs = TrnCsNotes::find($param['cs_id']);

            $this->updateRecordHeader($cs, $user, false);
        } else {
            $cs           = new TrnCsNotes();
            $cs->pic_id   = $param['pic_id'];
            $cs->store_id = $param['store_id'];
            $this->updateRecordHeader($cs, $user, true);
        }

        if (null != $cs) {
            $cs->cus_review = $this->getParam($param, 'cus_review');
            $cs->cus_rating = $this->getParam($param, 'cus_rating');

            $cs->status   = 0;
            $cs->deadline = $this->getParam($param, 'deadline');

            DB::transaction(function () use ($cs) {
                $cs->save();
            });
        }

        return $cs->store_id;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function updateCSNotes(
        $user,
        $param
    ) {
        $cs  = null;
        $res = false;

        if (isset($param['cs_id']) && ($param['cs_id'] > 0)) {
            $cs = TrnCsNotes::find($param['cs_id']);

            $this->updateRecordHeader($cs, $user, false);
        }

        if (null != $cs) {
            $res                = true;
            $cs->com_resolve    = $this->getParam($param, 'com_resolve');
            $cs->completed_time = Carbon::now();
            $cs->status         = 1;

            DB::transaction(function () use ($cs) {
                $cs->save();
            });
        }

        return $res;
    }

}
