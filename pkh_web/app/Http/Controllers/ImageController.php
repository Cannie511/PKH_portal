<?php

namespace App\Http\Controllers;

use App\Services\ImageService;

class ImageController extends Controller
{
    /**
     * @var mixed
     */
    private $imageService;

    /**
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param $path
     */
    public function getImage(
        $screen,
        $path
    ) {
        $fullPath = $this->imageService->loadImage($screen, $path);

        if (isset($fullPath) && file_exists($fullPath)) {
            ob_end_clean();
            ob_start();
            return response()->file($fullPath);
        }

        abort(404);
    }

    /**
     * @param $path
     */
    public function getImageWeb($path)
    {
        $fullPath = $this->imageService->loadImageWeb($path);

        if (isset($fullPath) && file_exists($fullPath)) {
            ob_end_clean();
            ob_start();
            return response()->file($fullPath);
        }

        abort(404);
    }

}
