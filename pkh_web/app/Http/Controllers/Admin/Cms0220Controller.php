<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Cms0220Service;

/**
 * Cms0220Controller
 */
class Cms0220Controller extends AdminBaseController
{
    /**
     * @var mixed
     */
    private $cms0220Service;

    /**
     * @param Cms0220Service $cms0220Service
     */
    public function __construct(Cms0220Service $cms0220Service)
    {
        $this->cms0220Service = $cms0220Service;
        //$this->middleware( 'permission:screen.cms0220' );
    }

    /**
     * @param Request $request
     */
    public function postLoad(Request $request)
    {
        $param = $request->all();
        $data  = $this->cms0220Service->selectList($param);

        $result = [
            'data' => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postRemove(Request $request)
    {
        $param = $request->all();
        $data  = $this->cms0220Service->removeFile($param);

        $result = [
            'rtnCd' => 'OK',
            'data'  => $data,
        ];

        return response()->success($result);
    }

    /**
     * @param Request $request
     */
    public function postUpload(Request $request)
    {
        $param = $request->all();

        if (isset($param['file'])) {
            // $files_img = $this->cms0220Service->selectList($param);
            $files_img     = $this->cms0220Service->selectListAll($param);
            $imageFileName = $param['title'] . ".jpg";

            if (in_array($imageFileName, $files_img)) {
                $result = [
                    'rtnCd' => false,
                ];

                return response()->success($result);
            }

        }

        $data   = $this->cms0220Service->uploadFile($param);
        $result = [
            'rtnCd' => true,
            'data'  => $data,
        ];

        return response()->success($result);
    }

}
