<?php namespace App\Http\Controllers\Frontend;

use DB;
use Log;
use View;
use App\Models\UserWeb;
use App\Models\TrnWebOrder;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Services\ProductService;
use App\Models\TrnWebOrderDetail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Frontend\FrontendController;

/**
 * News Controller
 */
class OrderController extends FrontendController
{
    /**
     * @var mixed
     */
    private $newsService;
    /**
     * @var mixed
     */
    private $productService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        NewsService $newsService,
        ProductService $productService
    ) {
        $this->newsService    = $newsService;
        $this->productService = $productService;
        $this->middleware('guest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow()
    {

        $param = [];
        $data  = [1, 2, 3];

        $data2 = $this->productService->selectListCatForWeb();

        return view($this->viewFolder . $this->currentTheme . '.pages.dat-hang', ['data2' => $data2]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function getShowDetail(
        Request $request,
        $id
    ) {
        $param = [
            "product_id" => $id,
        ];
        Log::debug($param);
        $product = $this->productService->selectProduct($param);
        $product = $product[0];
        //Log::debug($product);

        return view($this->viewFolder . $this->currentTheme . '.pages.chi-tiet', ['product' => $product]);
    }

    public function getProductList()
    {
        $param       = [];
        $productList = $this->productService->selectProductListForOrderWeb($param);
        $cateList    = $this->productService->selectListCatForWeb();
        Log::debug("check load");

// foreach ($productList as $item){

//     while (strlen($item->name) <50){

//         $item->name .= "-";

//     }

//     Log::debug(strlen($item->name));

        // }
        $result = [
            "productList" => $productList,
            "cateList"    => $cateList,
        ];

        return response()->success($result);
    }

    public function getAddCart()
    {
        $oldCart = null;

        return view($this->viewFolder . $this->currentTheme . '.pages.gio-hang', ['data' => $oldCart]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProduct($id)
    {
        $param = [
            'product_id' => $id,
        ];
        $product = $this->productService->selectProduct($param);
        $product = $product[0];

        return $product;
    }

    /**
     * @param Request $request
     */
    public function getUpdateCart(Request $request)
    {

        return Redirect::route('dathang');
    }

    /**
     * @param $phone
     * @return mixed
     */
    private function findUserByPhone($phone)
    {
        $sqlParam = array();
        $sql      = "
           select
				a.id
				, a.name
				, a.email
				, a.area1
				, a.area2
				, a.phone_number
			from
				users_web a
			where
				a.active_flg = 1
				and a.phone_number = ?
        ";
        $sqlParam[] = $phone;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postMakeOrder(Request $request)
    {
        $param = $request->all();

//Log::debug('test param order');
        //Log::debug($param["cart"]);
        $oldUser = $this->findUserByPhone($param["phone"]);

        if ($oldUser) {
            $user_id = $oldUser[0]->id;
        } else {
            $entityUser               = new UserWeb();
            $entityUser->name         = $param["name"];
            $entityUser->phone_number = $param["phone"];
            $entityUser->save();
            $user_id = $entityUser->id;
        }

        $entityOrder              = new TrnWebOrder();
        $entityOrder->user_web_id = $user_id;
        $entityOrder->total       = $param["total"];
        $entityOrder->order_sts   = 0;
        $entityOrder->save();
        $listOrderDetail = array();
        $count           = 0;
        $cart            = $param["cart"]["list"];

        foreach ($cart as $key => $item) {
            $orderDetail               = new TrnWebOrderDetail();
            $orderDetail->product_id   = $item["product_id"];
            $orderDetail->amount       = $item["amount"];
            $orderDetail->unit_price   = $item["selling_price"];
            $orderDetail->seq_no       = $count++;
            $orderDetail->web_order_id = $entityOrder->web_order_id;
            $orderDetail->save();
        }

        $result = [];
        //Log::debug($entityUser->id);

        return $result;
    }

}
