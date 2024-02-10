<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use App\Services\Name\ImageService;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function wallpaper(string $style, string $nameSlug): Response
    {
        return $this->imageService->individualWallpaper($nameSlug, $style);
    }

    public function signature(string $style, string $name): Response
    {
        return $this->imageService->individualSignature($name, $style);
    }
}
