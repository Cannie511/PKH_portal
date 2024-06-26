<?php

namespace App\Services;

use Auth;
use Carbon\Carbon;
use App\Models\MstArea;
use App\Models\MstStore;
use App\Services\Crm2110Service;

class Bat2100Service extends BaseService
{
    /**
     * @param Crm0210Service $crm0210Service
     */
    public function __construct(Crm2110Service $crm2110Service)
    {
        $this->crm2110Service = $crm2110Service;
    }

    /**
     * @param $month
     */
    public function updateAreaSaleman(
        $area_id,
        $saleman_id
    ) {
        $user   = Auth::user();
        $today1 = Carbon::now();
        MstArea::where('area_id', $area_id)
            ->update([
                'salesman_id' => $saleman_id
                , 'updated_at' => $today1
                , 'updated_by' => $user->id]);
    }

    /**
     * @param $month
     */
    public function updateStoreSaleman(
        $store_id,
        $saleman_id
    ) {
        $user   = Auth::user();
        $today1 = Carbon::now();
        MstStore::where('store_id', $store_id)
            ->update([
                'salesman_id' => $saleman_id
                , 'updated_at' => $today1
                , 'updated_by' => $user->id]);
    }

}
