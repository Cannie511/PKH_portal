<?php

namespace App\Http\Controllers\Customer;

//use Auth;
use Auth;
use Input;
use App\Services\OrderService;
use App\Services\StoreService;
use App\Services\ProductService;

/**
 * Cus0110Controller
 * Tạo đơn đặt hàng dành cho cửa hàng
 */
class Cus0110Controller extends CustomerBaseController
{
    /**
     * @var mixed
     */
    protected $orderService;
    /**
     * @var mixed
     */
    protected $productService;
    /**
     * @var mixed
     */
    protected $storeService;

    /**
     * @param OrderService $orderService
     * @param ProductService $productService
     * @param StoreService $storeService
     */
    public function __construct(
        OrderService $orderService,
        ProductService $productService,
        StoreService $storeService
    ) {
        $this->orderService   = $orderService;
        $this->productService = $productService;
        $this->storeService   = $storeService;
    }

    public function postLoadInit()
    {
        $allProduct = $this->productService->selectAllProductForFrontend();
        $data       = array();

        $noImage = ['WT001Z-16005', 'WT002I-1600A', 'WT001F-1600A', 'WT001D-1600A', 'WT0027-16009', 'WT0029-16009', 'WT001B-16009', 'WT0028-16009', 'WT002A-16009', 'WT001C-16009', 'WT002X-1600D', 'WT002Y-1600D', 'WT0024-1600D', 'WT0025-1600D', 'WT002P-1600C', 'WT0013-16006', 'WT0010-16006', 'WT0012-16006', 'WT0011-16006', 'WT002S-16006', 'WT0010-16006', 'WT0012-16006', 'WT0011-16006', 'WT0016-16008', 'WT001A-16008', 'WT002V-160030', 'WT002B-16003', 'WT002U-16003', 'WT002W-16003', 'WT002V-16003', 'WT002J-1600A', 'WT0008-16002', 'WT001J-16002'];

        foreach ($allProduct as $product) {

            if (!isset($data[$product->product_cat_code])) {
                $data[$product->product_cat_code] = [
                    "name"  => $product->product_cat_name,
                    "code"  => $product->product_cat_code,
                    "items" => array(),
                ];
            }

            if (in_array($product->product_code, $noImage)) {
                $product->noImage = 1;
            } else {
                $product->noImage = 0;
            }

            $data[$product->product_cat_code]["items"][] = $product;
        }

        return response()->success($data);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function postOrder()
    {
        $data = Input::all();
        $user = Auth::user();
        $this->orderService->createOrderForCustomer($user, $user->store_id, $data, true);

        return response()->success(['rtnCd' => 'OK']);
    }

}
