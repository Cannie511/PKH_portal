<?php

namespace App\Services;

use DB;
use App\Models\MstHoliday;

/**
 * Hrm0910Service class
 */
class Hrm0910Service extends BaseService
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
        from mst_holiday
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
     * @param $param
     */
    public function saveEntity($param)
    {

        $entity = null;

        if (0 == $param["id"]) {
            $entity = new MstHoliday();
        } else {
            $entity = MstHoliday::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Không tồn tại",
                ];
            }

        }

        $user = $this->logonUser();

        $entity->holiday_date = $param["holiday_date"];
        $entity->amount       = $param["amount"];
        $entity->reason       = $param["reason"];

        $this->updateRecordHeader($entity, $user, 0 == $param["id"]);

        $entity->save();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $id
     */
    public function deleteEntity($id)
    {
        MstHoliday::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

}
