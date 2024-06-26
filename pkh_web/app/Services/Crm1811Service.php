<?php

namespace App\Services;

use DB;
use App\Models\MstCostCat;

/**
 * Crm1811Service class
 */
class Crm1811Service extends BaseService
{
    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectCostCat($param)
    {
        $result = null;

        if (isset($param["cost_cat_id"])) {
            $result = MstCostCat::find($param["cost_cat_id"]);
        }

        return $result;
    }

    /**
     * @param $user
     * @param $param
     * @return mixed
     */
    public function saveCostCat(
        $user,
        $param
    ) {

        $costCat = null;

        if (isset($param['cost_cat_id']) && ($param['cost_cat_id'] > 0)) {
            $costCat = MstCostCat::find($param['cost_cat_id']);
            $this->updateRecordHeader($costCat, $user, false);
            $msg = "cập nhật " . $costCat["name"] . " thành Công";
        } else {
            $costCat = new MstCostCat();
            $this->updateRecordHeader($costCat, $user, true);
            $msg = "Lưu thành Công";
        }

        if (null != $costCat) {
            $costCat->name        = $param['name'];
            $costCat->description = $param['description'];

            DB::transaction(function () use ($costCat) {
                $costCat->save();
            });
        }

        return $msg;
    }

}
