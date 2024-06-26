<?php

namespace App\Http\Controllers\Admin;

use Log;
use Auth;
use Input;
use Carbon\Carbon;
use App\Models\MstStore;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\Crm0350Service;
use App\Services\SalesmanService;

/**
 * Crm0110Controller
 * Danh muc san pham danh cho nhan vien ban hang
 */
class Crm0310Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $areaService;
    /**
     * @var mixed
     */
    private $salesmanService;
    /**
     * @var mixed
     */
    private $crm0350Service;

    /**
     * @param AreaService $areaService
     * @param SalesmanService $salesmanService
     * @param Crm0350Service $crm0350Service
     */
    public function __construct(
        AreaService $areaService
        ,
        SalesmanService $salesmanService
        ,
        Crm0350Service $crm0350Service
    ) {
        //$this->middleware( 'role.sale' );
        $this->areaService     = $areaService;
        $this->salesmanService = $salesmanService;
        $this->crm0350Service  = $crm0350Service;
    }

    /**
     * @param Request $request
     */
    public function postIndex(Request $request)
    {

        /*
        $this->validate($request, [
        'data.entity.id' => 'required|integer',
        'data.entity.short_name' => 'required|min:3|unique:mst_supplier,short_name,'.$id
        ],
        [],
        [
        'data.entity.short_name' => 'Short Name'
        ]
        );

        $data = [
        'name' => $form['data.entity.name'],
        'short_name' => $form['data.entity.short_name'],
        ];

         */
        $result = [];

        $user = Auth::user();

        $id = Input::get("store_id");


        if ($id > 0) {
            // Edit
            $entity = MstStore::find($id);
            //Edit có điều kiện
            $this->middleware( 'permission:screen.crm0310' );

            if (null != $entity) {
                $entity->name                = strtoupper(Input::get('name'));
                $entity->address             = Input::get('address');
                $entity->chanh_id            = Input::get('chanh_id');
                $entity->tax_code            = Input::get('tax_code');
                $entity->contact_name        = Input::get('contact_name');
                $entity->contact_email       = Input::get('contact_email');
                $entity->contact_tel         = Input::get('contact_tel');
                $entity->contact_fax         = Input::get('contact_fax');
                $entity->contact_mobile1     = Input::get('contact_mobile1');
                $entity->contact_mobile2     = Input::get('contact_mobile2');
                $entity->area1               = Input::get('area1');
                $entity->area2               = Input::get('area2');
                $entity->accountant_store_id = Input::get('accountant_store_id');
                $entity->discount            = empty(Input::get('discount')) ? 0 : Input::get('discount');
                $entity->level               = Input::get('level');
                $entity->notes               = Input::get('notes');
                $entity->gps_lat             = empty(Input::get('gps_lat')) ? 0 : Input::get('gps_lat');
                $entity->gps_long            = empty(Input::get('gps_long')) ? 0 : Input::get('gps_long');
                $entity->updated_by          = $user->id;
                $entity->updated_at          = Carbon::now();
                $entity->salesman_id         = $this->areaService->getSalemanIdByArea(Input::get('area1'), Input::get('area2'));
                $entity->save();
                $result['item'] = $entity;

            }

        } else {
            $salesman_id = $this->areaService->getSalemanIdByArea(Input::get('area1'), Input::get('area2'));
            // Create
            $entity = MstStore::create([
                'name'                => strtoupper(Input::get('name')),
                'address'             => Input::get('address'),
                'chanh_id'            => Input::get('chanh_id'),
                'tax_code'            => Input::get('tax_code'),
                'contact_name'        => Input::get('contact_name'),
                'contact_email'       => Input::get('contact_email'),
                'contact_tel'         => Input::get('contact_tel'),
                'contact_fax'         => Input::get('contact_fax'),
                'contact_mobile1'     => Input::get('contact_mobile1'),
                'contact_mobile2'     => Input::get('contact_mobile2'),
                'area1'               => Input::get('area1'),
                'area2'               => Input::get('area2'),
                'accountant_store_id' => Input::get('accountant_store_id'),
                'gps_lat'             => empty(Input::get('gps_lat')) ? 0 : Input::get('gps_lat'),
                'gps_long'            => empty(Input::get('gps_long')) ? 0 : Input::get('gps_long'),
                'created_by'          => $user->id,
                'updated_by'          => $user->id,
                'updated_at'          => Carbon::now(),
                'salesman_id'         => $salesman_id,
                'store_sts'           => '1',
                'discount'            => empty(Input::get('discount')) ? 0 : Input::get('discount'),
                'level'               => Input::get('level'),
                'notes'               => Input::get('notes'),

            ]);

            $result['item'] = $entity;
        }

        Log::debug('entity------');
        Log::debug($entity);

        return response()->success($result);
    }

    public function postInitData()
    {
        $result              = [];
        $result["area1List"] = $this->areaService->selectListArea1();
        $result["area2List"] = $this->areaService->selectListArea2();
        $result["salesList"] = $this->salesmanService->selectDropdown();
        $result["chanhList"] = $this->crm0350Service->selectChanhListDropdown();

        return response()->success($result);
    }

    public function postLoad()
    {

        $id    = Input::get('store_id');
        $store = MstStore::find($id);

        $result              = [];
        $result["item"]      = $store;
        $result["area1List"] = $this->areaService->selectListArea1();
        $result["area2List"] = $this->areaService->selectListArea2();
        $result["chanhList"] = $this->crm0350Service->selectChanhListDropdown();

        return response()->success($result);
    }

}
