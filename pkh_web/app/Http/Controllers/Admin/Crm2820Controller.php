<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Services\Crm2820Service;
use App\Services\ProductService;
use App\Services\DownloadService;

/**
 * Crm2820Controller
 */
class Crm2820Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $crm2820Service;

    /**
     * @param Crm2820Service $crm2820Service
     * @param DownloadService $downloadService
     * @param ProductService $productService
     */
    public function __construct(
        Crm2820Service $crm2820Service,
        DownloadService $downloadService,
        ProductService $productService
    ) {
        $this->crm2820Service  = $crm2820Service;
        $this->downloadService = $downloadService;
        $this->productService  = $productService;
        $this->middleware('permission:screen.crm2820');
    }

    /**
     * Load init data
     *
     * @param Request $request
     * @return void
     */
    public function postInitData(Request $request)
    {
        $param       = $request->all();
        $listProduct = $this->productService->selectSellingProduct([]);
        $kpi         = $this->crm2820Service->loadKPI($param["kpi_id"]);
        $result      = [
            'listProduct' => $listProduct,
            'kpi'         => $kpi,
        ];

        return response()->success($result);
    }

    /**
     * Load data
     *
     * @param Request $request
     * @return void
     */
    public function postLoad(Request $request)
    {

        $this->validate($request, [
            'kpi_id' => 'required|numeric|min:1',
            'month'  => 'required|numeric|min:1|max:12',
        ]);

        $param             = $request->all();
        $listTargetProduct = $this->crm2820Service->selectKPIDetail($param['kpi_id'], $param['month']);

        $result = [
            'listTargetProduct' => $listTargetProduct,
        ];

        return response()->success($result);
    }

    /**
     * Save entity
     *
     * @param Request $request
     * @return void
     */
    public function postSave(Request $request)
    {

        // $this->middleware('permission:screen.crm2820.save');
        $this->validate($request, [
            'kpi_id' => 'required|numeric|min:0',
            'month'  => 'required|numeric|min:1|max:12',
        ]);

        try {
            DB::beginTransaction();

            $param = $request->all();
            Log::info($param);
            $data = $this->crm2820Service->saveEntity($param);
            DB::commit();

            return response()->success($data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->success([
                "rtnCd" => false,
                "msg"   => "Đã xãy ra lỗi (" . $e->getMessage() . ")",
            ]);
        }
    }

    // public function postDelete(Request $request) {

    //     $this->middleware('permission:screen.crm2820.delete');
    //     $param = $request->all();
    //     $data = $this->crm2820Service->deleteEntity($param["id"]);

    //     $result = [
    //         'data' => $data
    //     ];
    //     return response()->success($result);
    // }

}
