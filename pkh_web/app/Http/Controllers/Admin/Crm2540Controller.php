<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2540Service;

/**
 * Crm2540Controller
 */
class Crm2540Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2540Service;

    /**
     * @param Crm2540Service $crm2540Service
     */
    public function __construct(Crm2540Service $crm2540Service)
    {
        $this->crm2540Service = $crm2540Service;
        $this->middleware('permission:screen.crm2540');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInit(Request $request)
    {

        $params = $request->all();

        $his = null;

        if (isset($params["product_market_his_id"])) {
            $his = $this->crm2540Service->loadProductMarketHis($params["product_market_his_id"]);
        }

        $listProduct = $this->crm2540Service->loadListProductMarket();

        $result = [
            "form"        => $his,
            "listProduct" => $listProduct,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postCreate(Request $request)
    {
        $param = $request->all();

        $this->validate($request, [
            'warehouse_change_type' => 'required|integer|between:1,2',
            'product_market_id'     => 'required|numeric',
            'changed_date'          => 'required|date_format:"Y-m-i"',
            'price'                 => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'amount'                => 'required|integer',
        ]);

        $result = $this->crm2540Service->create($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'warehouse_change_type' => 'required|integer|between:1,2',
            'product_market_id'     => 'required|numeric',
            'changed_date'          => 'required|date_format:"Y-m-i"',
            'price'                 => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'amount'                => 'required|integer',
        ]);

        $param  = $request->all();
        $result = $this->crm2540Service->update($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'product_market_his_id' => 'required|numeric',
            'status'                => 'required|integer|between:2,4',
        ]);

        $param  = $request->all();
        $result = $this->crm2540Service->updateStatus($param);

        return response()->success($result);
    }

}
