<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Cms0210Service;

/**
 * Cms0210Controller
 */
class Cms0210Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $cms0210Service;

    /**
     * @param Cms0210Service $cms0210Service
     */
    public function __construct(Cms0210Service $cms0210Service)
    {
        $this->cms0210Service = $cms0210Service;
        //$this->middleware( 'permission:screen.cms0210' );
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $param          = $request->get('newsId');
        $result         = [];
        $result["news"] = $this->cms0210Service->loadNews($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postIndex(Request $request)
    {
        $param  = $request->all();
        $newsId = $this->cms0210Service->createNews($param);
        $result = [
            'rtnCd'  => 'OK',
            'newsId' => $newsId,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param  = $request->all();
        $result = $this->cms0210Service->upload($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postLoadImages(Request $request)
    {
        $param  = $request->all();
        $result = $this->cms0210Service->loadImages($param);

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postRemoveImage(Request $request)
    {
        $param  = $request->all();
        $result = $this->cms0210Service->removeImage($param);

        return response()->success($result);
    }

}
