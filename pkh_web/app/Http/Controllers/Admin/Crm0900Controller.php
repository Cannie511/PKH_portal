<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm0900Service;
use App\Http\Controllers\Controller;

class Crm0900Controller extends Controller
{
    /**
     * @var mixed
     */
    protected $crm0900Service;

    /**
     * @param Crm0900Service $crm0900Service
     */
    public function __construct(Crm0900Service $crm0900Service)
    {
        $this->crm0900Service = $crm0900Service;
        // $this->middleware( 'role.sale' );
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        $list  = $this->crm0900Service->selectListProduct($param);

        return response()->success($list);
    }
}
