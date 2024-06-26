<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Input;
use Carbon\Carbon;
use App\Models\MstChanh;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0351Service;

/**
 * Crm0351Controller
 */
class Crm0351Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0351Service;
    /**
     * @var mixed
     */
    private $areaService;

    /**
     * @param Crm0351Service $crm0351Service
     * @param AreaService $areaService
     */
    public function __construct(
        Crm0351Service $crm0351Service,
        AreaService $areaService
    ) {
        $this->crm0351Service = $crm0351Service;
        $this->areaService    = $areaService;
        //$this->middleware( 'permission:screen.crm0351' );
    }

    /**
     * @param Request $request
     */
    public function postIndex(Request $request)
    {

        $result = [];

        $user = Auth::user();

        $id = Input::get("chanh_id");

        if ($id > 0) {
            // Edit
            $entity = MstChanh::find($id);

            if (null != $entity) {
                $entity->name            = strtoupper(Input::get('name'));
                $entity->address         = Input::get('address');
                $entity->contact_name    = Input::get('contact_name');
                $entity->contact_email   = Input::get('contact_email');
                $entity->contact_tel     = Input::get('contact_tel');
                $entity->contact_fax     = Input::get('contact_fax');
                $entity->contact_mobile1 = Input::get('contact_mobile1');
                $entity->contact_mobile2 = Input::get('contact_mobile2');
                $entity->area1           = Input::get('area1');
                $entity->area2           = Input::get('area2');
                $entity->gps_lat         = Input::get('gps_lat');
                $entity->gps_long        = Input::get('gps_long');
                $entity->updated_by      = $user->id;
                $entity->updated_at      = Carbon::now();

                $entity->save();
                $result['item'] = $entity;
            }

        } else {

            // Create
            $entity = MstChanh::create([
                'name'            => strtoupper(Input::get('name')),
                'address'         => Input::get('address'),
                'contact_name'    => Input::get('contact_name'),
                'contact_email'   => Input::get('contact_email'),
                'contact_tel'     => Input::get('contact_tel'),
                'contact_fax'     => Input::get('contact_fax'),
                'contact_mobile1' => Input::get('contact_mobile1'),
                'contact_mobile2' => Input::get('contact_mobile2'),
                'area1'           => Input::get('area1'),
                'area2'           => Input::get('area2'),
                'gps_lat'         => Input::get('gps_lat'),
                'gps_long'        => Input::get('gps_long'),
                'created_by'      => $user->id,
                'updated_by'      => $user->id,
                'updated_at'      => Carbon::now(),

                'store_sts' => '1',
            ]);

            $result['item'] = $entity;
        }

        return response()->success($result);
    }

    public function postInitData()
    {
        $result              = [];
        $result["area1List"] = $this->areaService->selectListArea1();
        $result["area2List"] = $this->areaService->selectListArea2();

        return response()->success($result);
    }

    public function postLoad()
    {

        $id    = Input::get('chanh_id');
        $chanh = MstChanh::find($id);

        $result              = [];
        $result["item"]      = $chanh;
        $result["area1List"] = $this->areaService->selectListArea1();
        $result["area2List"] = $this->areaService->selectListArea2();
        Log::debug('------------check init ------------');
        Log::debug($result);

        return response()->success($result);
    }

}
