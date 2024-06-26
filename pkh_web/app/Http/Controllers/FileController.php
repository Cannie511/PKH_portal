<?php

namespace App\Http\Controllers;

use Log;
use Cache;

class FileController extends Controller
{
    /**
     * @param $path
     */
    public function getPdf($path)
    {
        $fullPath = storage_path('app/pdf/') . $path;

        if (file_exists($fullPath)) {
            // return response()->file($fullPath);
            $file = response()->download($fullPath);
            ob_end_clean();
            return $file;
        }

        abort(404);
    }

    /**
     * @param $token
     */
    public function getFileOneTime($token)
    {
        $fullPath = Cache::pull($token);

        if (!empty($fullPath) && file_exists($fullPath)) {
            // return response()->file($fullPath);
            $file = response()->download($fullPath);
            ob_end_clean();
            return $file;
        }

        abort(404);
    }

}
