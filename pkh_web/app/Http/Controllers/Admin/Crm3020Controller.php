<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm3020Service;

class Crm3020Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm3020Service;
    /**
     * @param Crm3020Service $crm3020Service
     * 
     */
    public function __construct(Crm3020Service $crm3020Service){
        $this->crm3020Service = $crm3020Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $param = $request->all();
        
        $data = $this->crm3020Service->selectList($param);
        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }
}   
