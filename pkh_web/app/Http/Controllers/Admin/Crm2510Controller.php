<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm2510Service;

/**
 * Crm2510Controller
 */
class Crm2510Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2510Service;

    /**
     * @param Crm2510Service $crm2510Service
     */
    public function __construct(Crm2510Service $crm2510Service)
    {
        $this->crm2510Service = $crm2510Service;
        $this->middleware('permission:screen.crm2510');
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $product = $this->crm2510Service->load($request->get('product_market_id'));

        return response()->success([
            'product' => $product,
        ]);
    }

    /**
     * @param Request $request
     */
    public function postCreate(Request $request)
    {
        $param = $request->all();

        $this->validate($request, [
            'type' => 'required|numeric',
            'name' => 'required',
        ]);

        $result = $this->crm2510Service->create($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'product_market_id' => 'required',
            'type'              => 'required|numeric',
            'name'              => 'required',
        ]);

        $param  = $request->all();
        $result = $this->crm2510Service->update($param);

        return response()->success($result);
    }

}
