<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Illuminate\Http\Request;
use App\Services\Crm0130Service;

/**
 * Crm0130Controller
 * Danh muc san pham danh cho nhan vien ban hang
 */
class Crm0130Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0130Service;

    /**
     * @param Crm0130Service $crm0130Service
     */
    public function __construct(Crm0130Service $crm0130Service)
    {
        $this->crm0130Service = $crm0130Service;

//$this->middleware( 'role.sale' );
        //$this->middleware(config('constants.LEVEL_ALL'));
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postSearch(Request $request)
    {
        $list = $this->crm0130Service->selectListProduct($request->all());

        foreach ($list as $item) {
            //$item->imgUrl = "/img/product/".$item->product_code.".png";
            // $code = $item->supplier_id == 1 ? substr($item->product_code, 0, 6) : $item->product_code;
            $code = substr($item->product_code, 0, 6);
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
        }

        return response()->success(compact('list'));
    }

}
