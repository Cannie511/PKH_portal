<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0240Service;

/**
 * Crm0240Controller
 */
class Crm0240Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm0240Service;

    /**
     * @param Crm0240Service $crm0240Service
     */
    public function __construct(Crm0240Service $crm0240Service)
    {
        $this->crm0240Service = $crm0240Service;
        $this->middleware('permission:screen.crm0240');
    }

    /**
     * Search
     *
     * @param Request $request
     * @return void
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();

        if (1 == $param['index']) {
            $data = $this->crm0240Service->selectListForOrder($param);
        } elseif (2 == $param['index']) {
            $data = $this->crm0240Service->selectListForImportStore($param);
        } elseif (3 == $param['index']) {
            $data = $this->crm0240Service->selectListForImportFac($param);
        } else {
            $data = $this->crm0240Service->selectListForWarehouse($param);
        }

        $result = [
            'index' => $param['index'],
            'data'  => $data,
        ];

        return response()->success($result);
    }

}
