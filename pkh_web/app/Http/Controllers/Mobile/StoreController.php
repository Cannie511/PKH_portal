<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\StoreService;
use App\Services\Mobile\StoreNotesService;
use App\Services\Mobile\StoreSignaturesService;

/**
 * StoreController
 */
class StoreController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $storeService;
    /**
     * @var mixed
     */
    private $storeNotesService;
    /**
     * @var mixed
     */
    private $storeSignaturesService;

    /**
     * @param StoreService $storeService
     * @param StoreNotesService $storeNotesService
     * @param StoreSignaturesService $storeSignaturesService
     */
    public function __construct(
        StoreService $storeService,
        StoreNotesService $storeNotesService,
        StoreSignaturesService $storeSignaturesService
    ) {
        $this->storeService           = $storeService;
        $this->storeNotesService      = $storeNotesService;
        $this->storeSignaturesService = $storeSignaturesService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $param  = $request->all();
        $result = $this->storeService->selectList($param);

        return response()->success($result);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $result = $this->storeService->selectById($id);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     */
    public function checkin(
        Request $request,
        $store_id
    ) {
        $agent = $request->header('User-Agent');
        $ip    = $this->getIp($request);

        $param             = $request->all();
        $param["store_id"] = $store_id;
        $param["agent"]    = $agent;
        $param["ip"]       = $ip;
        $result            = $this->storeService->checkin($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     * @param $checkin_id
     */
    public function uploadImage(
        Request $request,
        $store_id,
        $checkin_id
    ) {
        $param               = $request->all();
        $param["store_id"]   = $store_id;
        $param["checkin_id"] = $checkin_id;
        $result              = $this->storeService->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     */
    public function note(
        Request $request,
        $store_id
    ) {
        $param             = $request->all();
        $param["store_id"] = $store_id;
        $result            = $this->storeNotesService->add($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     * @param $note_id
     */
    public function uploadNoteImage(
        Request $request,
        $store_id,
        $note_id
    ) {
        $param             = $request->all();
        $param["store_id"] = $store_id;
        $param["note_id"]  = $note_id;
        $result            = $this->storeNotesService->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     */
    public function getSignature(
        Request $request,
        $store_id
    ) {
        $result = $this->storeSignaturesService->getList($store_id);

        return response()->success($result);
    }

    /**
     * @param Request $request
     * @param $store_id
     */
    public function uploadSignature(
        Request $request,
        $store_id
    ) {
        $param             = $request->all();
        $param["store_id"] = $store_id;
        $result            = $this->storeSignaturesService->upload($param);

        return response()->success($result);
    }

}
