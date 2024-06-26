<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use App\Services\ZaloService;
use App\Services\ProductService;
use App\Services\FuncConfService;
use App\Services\ProductWebsiteService;
use App\Services\OaZaloService;
use App\Services\ESMS\Esms;
use Log;


/**
 * Cms0100Controller
 * Cấu hình frontend
 */
class Cms0100Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $funcConfService;
    /**
     * @var mixed
     */
    protected $zaloService;
    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $productWebsiteService;

    protected $oaZaloService;

    protected $esms;

    /**
     * Constructor
     *
     * @param FuncConfService $funcConfService
     * @param ZaloService $zaloService
     * @param ProductService $productService
     * @param ProductWebsiteService $productWebsiteService
     */
    public function __construct(
        FuncConfService $funcConfService,
        ZaloService $zaloService,
        ProductService $productService,
        ProductWebsiteService $productWebsiteService,
        OaZaloService $oaZaloService,
        Esms $esms
    ) {
        $this->funcConfService       = $funcConfService;
        $this->zaloService           = $zaloService;
        $this->productService        = $productService;
        $this->productWebsiteService = $productWebsiteService;
        $this->oaZaloService         = $oaZaloService;
        $this->esms                  = $esms;
        $this->middleware('permission:screen.crm0700');
    }

    public function postInitData()
    {
        $listProduct = $this->productService->selectSellingProduct([]);
        $result      = [
            'cms_home_marquee'     => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE, 'txt_val'),
            'cms_home_marquee_2'   => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_MARQUEE_2, 'txt_val'),
            'cms_home_top_product' => $this->funcConfService->selectByKey(FuncConfService::CMS_HOME_TOP_PRODUCT, 'txt_val'),
            'listProduct'          => $listProduct,
        ];

        return response()->success($result);
    }

    /**
     * @return mixed
     */
    public function postSave()
    {
        $cmsMarquee           = "";
        $cmsMarquee2          = "";
        $cms_home_top_product = "";

        $param = Input::all();

        if (isset($param['cms_home_marquee'])) {
            $cmsMarquee = $param['cms_home_marquee'];
        }

        if (isset($param['cms_home_marquee_2'])) {
            $cmsMarquee2 = $param['cms_home_marquee_2'];
        }


        $this->funcConfService->updateByKey(FuncConfService::CMS_HOME_MARQUEE, $cmsMarquee, 'txt_val');
        $this->funcConfService->updateByKey(FuncConfService::CMS_HOME_MARQUEE_2, $cmsMarquee2, 'txt_val');
        // $this->funcConfService->updateByKey(FuncConfService::CMS_HOME_TOP_PRODUCT, $cms_home_top_product, 'txt_val');

        $result = [
            'cms_home_marquee'   => $cmsMarquee,
            'cms_home_marquee_2' => $cmsMarquee2,
            // 'cms_home_top_product' => $cms_home_top_product,
        ];

        // return $this->postInitData();

        return $result;
    }

    /**
     * @param Request $request
     */
    public function postSaveProducts(Request $request)
    {
        $param = $request->all();

        $cms_home_top_product = "";

        if (isset($param['cms_home_top_product'])) {
            $cms_home_top_product = $param['cms_home_top_product'];
            $this->funcConfService->updateByKey(FuncConfService::CMS_HOME_TOP_PRODUCT, $cms_home_top_product, 'txt_val');
        }

        if (isset($param['cms_home_new_product'])) {
            $value = $param['cms_home_new_product'];
            $this->funcConfService->updateByKey(FuncConfService::CMS_HOME_NEW_PRODUCT, $value, 'txt_val');
        }

        $result = [
            "msg" => 'Đã thêm sản phẩm thành công',
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadProducts(Request $request)
    {
        $param = $request->all();

        if ("NEW" == $param["type"]) {
            $listProduct = $this->productWebsiteService->selectTopProductOnHome(FuncConfService::CMS_HOME_NEW_PRODUCT);
        } else {
            $listProduct = $this->productWebsiteService->selectTopProductOnHome(FuncConfService::CMS_HOME_TOP_PRODUCT);
        }

        $result = [
            'listProduct' => $listProduct,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postNotifyAllZalo(Request $request)
    {
        $param   = $request->all();
        $message = $param["message"];
        $result = [];
    
        Log::debug("----- check access token ------");
        Log::debug($message);
        // $temp_id = ['217011',"217017",'217013','217014','217015','217019','217016','217316'];// "217017";
        // $phone = "0915846849";

        // $params  = array(
        //     // <customer_name>,<address>,<registration_id>,<registration_status>,<registration_deadline>
        //     '217011'  => ["CH Tỷ 73 -75","73 Đường 3/2 TP Sóc Trăng","DKDL001", "Thành công", "2022-12-30"]
        //     // 7 param <customer_name>,<address>,<order_date>,<order_id>,<order_name> ,<payments>,<status>
        //     ,"217017"  =>  ["CH Tỷ 73 -75","73 Đường 3/2 TP Sóc Trăng","19-06-2021","FDEL_00621_0017_NORM (#7307)","Watertec","6088000","xác nhận"]
        //     // 6 param <customer_name>,<address>,<order_date>,<contracts_id>,<payments>,<payment term>
        //     , '217013' => ["CH Tỷ 73 -75","73 Đường 3/2 TP Sóc Trăng","19-06-2021","HKE","2300000","19-06-2021"]
        //      // 3 param customer_name,order_id,order_date
        //     , '217014' => ["CH Tỷ 73 -75","FDEL_00621_0017_NORM (#7307)","19-06-2021"]
        //     // 5 param customer_name,customer_name,agent_id,number,time
        //     , '217015' => ["CH Tỷ 73 -75","CH Tỷ 73 -75","FDEL_00621_0017_NORM (#7307)","150","19-06-2021"]
        //       // 3 param <employee_id>,<part>,<prize>
        //     , '217019' => ["234", "IT", "23000000"]
        //     // 6 param <customer_name>,<employee_id>,<part>,<prize>,<prize_period>,<won_prize>
        //     , '217016' => ["Khang Duy","KKK","IT", "1st", "Q1", "100000"]
        //     ,'217316' => ["FDEL-0001-01212"]
        // );
        $result = $this->oaZaloService->broadcastText2Follower($message);
        // foreach ($temp_id as $key){
        //     $this->esms->post($key, $phone, $params[$key]);
        // }

        return response()->success($result);
    }

}
