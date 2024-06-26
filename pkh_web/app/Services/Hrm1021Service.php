<?php

namespace App\Services;

use DB;
use Log;
use App\Models\TrnInternalNewsViewed;

/**
 * Hrm1021Service class
 */
class Hrm1021Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectById($id)
    {
        $sqlParam = array();
        $sql      = "
        select *
        from trn_internal_news
        where id = ?
        limit 1
        ";

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);
        // $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

        $sqlParam[] = $id;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param $id
     */
    public function updateRead($id)
    {
        $user = $this->logonUser();
        try {

            $oldData = TrnInternalNewsViewed::where('news_id', $id)
                ->where('user_id', $user->id)->get();

            Log::info(print_r($oldData, true));

            if (count($oldData) == 0) {
                $entity          = new TrnInternalNewsViewed();
                $entity->news_id = $id;
                $entity->user_id = $user->id;
                $this->updateRecordHeader($entity, $user, true);
                $entity->save();
            }

        } catch (PDOException $e) {
            Log::info($e->getMessage());
        }

    }

}
