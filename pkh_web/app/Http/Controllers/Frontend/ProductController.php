<?php namespace App\Http\Controllers\Frontend;

use Log;
use View;
use App\Services\IpService;
use App\Models\TrnGuarantee;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\ProductService;
use App\Services\ProductWebsiteService;
use App\Http\Controllers\Frontend\FrontendController;

/**
 * News Controller
 */
class ProductController extends FrontendController
{
    /**
     * @var mixed
     */
    private $productService;
    /**
     * @var mixed
     */
    private $productWebsiteService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductService $productService,
        AreaService $areaService,
        IpService $ipService,
        ProductWebsiteService $productWebsiteService
    ) {
        $this->productService        = $productService;
        $this->areaService           = $areaService;
        $this->ipService             = $ipService;
        $this->productWebsiteService = $productWebsiteService;
        $this->middleware('guest');
    }

    /**
     * Display a listing of the news.
     *
     * @return ResponsenewList
     */
    public function newList()
    {
        return view($this->viewFolder . $this->currentTheme . '.product.new');
    }

    public function all()
    {
        $allProduct = $this->productService->selectAllProductForFrontend();
        $data       = array();

        $listProductCat = $this->productWebsiteService->selectListProductCat();

        return view(
            $this->viewFolder . $this->currentTheme . '.product.all',
            [
                'data'           => $data,
                'listProductCat' => $listProductCat,
            ]
        );
    }

    /**
     * @param $month
     */
    public function priceList($month)
    {
        $thisMonth = date('Y-m');

        if ($month != $thisMonth) {
            abort(404);
        }

        $priceList = $this->productService->getPriceList();

        return view($this->viewFolder . $this->currentTheme . '.product.price-list', ['priceList' => $priceList]);
    }

    /**
     * @param $code
     */
    public function getGuarantee($code)
    {
        $code = strtoupper($code);

        $product   = $this->productService->selectProductByCode($code);
        $listArea1 = $this->areaService->selectListArea1();
        $listArea2 = $this->areaService->selectListArea2();

        if (empty($product)) {
            abort(404);
        }

        return view($this->viewFolder . $this->currentTheme . '.product.quarantee',
            [
                'product'   => $product,
                'listArea1' => $listArea1,
                'listArea2' => $listArea2,
            ]
        );
    }

    /**
     * @param $code
     * @param Request $request
     */
    public function postGuarantee(
        $code,
        Request $request
    ) {
        $code = strtoupper($code);

        $product = $this->productService->selectProductByCode($code);

        if (empty($product)) {
            abort(404);
        }

        $data  = $request->all();
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $entity                = new TrnGuarantee();
        $entity->product_id    = $product->product_id;
        $entity->area1         = $data["area1"];
        $entity->area2         = $data["area2"];
        $entity->name          = strtoupper($data["name"]);
        $entity->email         = strtolower($data["email"]);
        $entity->tel           = $data["tel"];
        $entity->store         = $data["store"];
        $entity->purchase_date = $data["date"];
        $entity->ip            = $ip;
        $entity->agent         = $agent;

        try {
            $ip     = "125.214.48.102"; // For test
            $ipInfo = $this->ipService->getIpInfo($ip);
            $this->ipService->setIpInfoToObject($entity, $ipInfo);
        } catch (\Throwable $e) {
            Log::warning($e);
        }

        $entity->save();

        $result = [
            "cd" => true,
        ];

        return response()->json($result);
    }

    /**
     * @param $slug
     * @param $code
     * @param Request $request
     */
    public function getCat(
        $slug,
        $code,
        Request $request
    ) {
        $code = strtoupper($code);

        $productCat = $this->productService->selectProductCatByCode($code);

        if (!isset($productCat)) {
            return abort(404);
        }

        $listProductCat = $this->productWebsiteService->selectListProductCat();
        $listProduct    = $this->productWebsiteService->selectListProductionInCat($productCat->product_cat_id);
        return view($this->viewFolder . $this->currentTheme . '.product.product-cat',
            [
                'listProductCat' => $listProductCat,
                'productCat'     => $productCat,
                'listProduct'    => $listProduct,
            ]
        );
    }

    /**
     * @param $slug
     * @param $code
     * @param Request $request
     */
    public function getProduct(
        $slug,
        $code,
        Request $request
    ) {
        $code = strtoupper($code);

        $product = $this->productService->selectProductByCode($code);

        if (!isset($product) || $product->supplier_id != 1) {
            return abort(404);
        }

        $listProduct = $this->productWebsiteService->selectListProductionRelated($product->product_cat_id, $product->product_id);

        return view($this->viewFolder . $this->currentTheme . '.product.product',
            [
                'product'     => $product,
                'listProduct' => $listProduct,
            ]
        );
    }

    /**
     * @param $request
     * @return mixed
     */
    private function getIp($request)
    {
        $ip = $request->ip();

        if ($request->header('X-Client') != null) {
            $ip = $request->header('X-Client');
        }

        if ($request->header('cf-connecting-ip') != null) {
            $ip = $request->header('cf-connecting-ip');
        }

        return $ip;
    }

}
