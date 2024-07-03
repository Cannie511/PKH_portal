<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Crm3010Service;

class Crm3010Controller extends AdminBaseController
{
   
    /**
     * @var mixed
     */
    private $crm3010Service;
    /**
     * @var mixed
     */
    protected $storeService;
    /**
     * @param crm3010Service $crm3010Service
     * 
     */
    public function __construct(Crm3010Service $crm3010Service){
        $this->crm3010Service = $crm3010Service;
    }
    /**
     * @param Request $request
     */
    public function postSearch(Request $request){
        $param = $request->all();
        $data = $this->crm3010Service->selectList($param);
        $result = $data;
        return response()->success($result);
    }
}   
