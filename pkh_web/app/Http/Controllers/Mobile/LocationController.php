<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Services\Mobile\LocationService;

/**
 * LocationController
 */
class LocationController extends MobileBaseController
{
    /**
     * @var mixed
     */
    private $locationService;

    /**
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $result = $this->locationService->createLocations($params);

        return response()->success($result);
    }
}
