<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Auth;
use Illuminate\Http\Request;
use App\Services\Crm0810Service;
use App\Services\DownloadService;
use App\Services\WarehouseService;

/**
 * Crm0810Controller
 * Danh muc san pham danh cho nhan vien ban hang
 */
class Crm0810Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    protected $crm0810Service;
    /**
     * @var mixed
     */
    protected $warehouseService;

    /**
     * @param Crm0810Service $crm0810Service
     * @param DownloadService $downloadService
     */
    public function __construct(
        Crm0810Service $crm0810Service,
        DownloadService $downloadService,
        WarehouseService $warehouseService
    ) {
        $this->crm0810Service   = $crm0810Service;
        $this->downloadService  = $downloadService;
        $this->warehouseService = $warehouseService;
        $this->middleware('permission:screen.crm0810');
    }

    /**
     * @param Request $request
     */
    public function postSearch(Request $request)
    {
        $productActive = $request->get("productActive");
        $list          = $this->crm0810Service->selectListProduct($productActive);

        foreach ($list as $item) {
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $item->product_code . ".png";
        }

        $warehouseList = $this->warehouseService->selectWarehouseList();
        $result        = [
            'warehouseList' => $warehouseList,
            'list'          => $list,
        ];

        return response()->success($result);

        // return response()->success(compact('list'));
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $checkWarehouseId = $request->get("checkWarehouseId");
        // $productActive = $request->get("productActive");
        $param         = $request->all();
        $list          = $this->crm0810Service->loadListProduct($param);
        $warehouseList = $this->warehouseService->selectWarehouseList();

// Log::debug(print_r($list, true));
        foreach ($list as $item) {
            $item->imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $item->product_code . ".png";
        }

        $info   = $this->crm0810Service->loadCheckWareHouse($checkWarehouseId);
        $result = [
            'warehouseList' => $warehouseList,
            'info'          => $info,
            'list'          => $list,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postSave(Request $request)
    {
        $param  = $request->all();
        $user   = Auth::user();
        $status = $this->crm0810Service->createCheckWarehouseDetail($user, $param);

        $result = [
            'rtnCd'  => 'OK',
            'status' => $status,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postDownload(Request $request)
    {
        // $this->requirePermission('screen.crm0810.download');
        $param = $request->all();
        //$result = $this->crm0810Service->download($param);
        $data          = $this->crm0810Service->loadListProduct($param);
        $paramDownload = [
            "data"      => $data,
            "file_name" => "DanhSachKiemKho",
            "view"      => "crm0810-list",
        ];
        $result = $this->downloadService->downloadExcelFile($paramDownload);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postCancel(Request $request)
    {
        $this->requirePermission('screen.crm0810.cancel');

        $param = $request->all();
        // $user                   = Auth::user();
        $result = $this->crm0810Service->cancelCheckWarehouse($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0810Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->crm0810Service->loadImages($param);
        // Log::info("list image:",$result);

        return response()->success($result);
    }

}
