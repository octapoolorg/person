<?php

namespace App\Services;

use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class BaseImageService
{
    public function generateImage(string $name, array $style): Response
    {
        $back = $this->getBackgroundPath($style['background']);
        $key = $name.$style['background'];

        if ($style['text']) {
            $key .= $style['font_path'].$style['font_size'].$style['font_color'];
            request()->filled('size') && $key .= request()->size;
        }

        $base64Image = cache_remember($key, function () use ($back, $name, $style) {
            return $this->generateImageResponse($back, $name, $style);
        }, 0);

        return $this->image($base64Image, $name, $style['seo_title']);
    }

    public function image(string $base64Image, string $actualName, string $imageName): Response
    {
        $imageInfo = explode(',', $base64Image);
        $imageData = base64_decode($imageInfo[1]);

        return response($imageData)
            ->header('Content-Type', 'image/jpg')
            ->header('Content-Disposition', "inline; filename=\"$actualName $imageName.jpg\"");
    }

    private function generateImageResponse(string $back, string $name, array $style): string
    {
        $img = Image::make($back);

        if ($style['text']) {
            $this->applyTextToImage($img, $name, $style);
        }

        if (request()->filled('size') && request()->size === 'thumb') {
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return (string) $img->encode('data-url');
    }

    private function applyTextToImage($img, $name, $style)
    {
        $font = $this->getFontPath($style['font_path']);
        $fontSize = $style['font_size'];
        $color = $style['font_color'];

        $imageWidth = $img->width();
        $imageHeight = $img->height();

        if (isset($style['position_x']) && isset($style['position_y'])) {
            $xPosition = $style['position_x'];
            $yPosition = $style['position_y'];
        } else {
            $xPosition = $imageWidth / 2;
            $yPosition = $imageHeight / 2;
        }

        $align = 'center';
        $valign = 'center';

        $img->text($name, $xPosition, $yPosition, function ($fontObj) use ($font, $fontSize, $color, $align, $valign) {
            $fontObj->file($font);
            $fontObj->size($fontSize);
            $fontObj->color($color);
            $fontObj->align($align);
            $fontObj->valign($valign);
        });
    }

    private function getFontPath(string $font): string
    {
        return resource_path("fonts/$font");
    }

    private function getBackgroundPath(string $background): string
    {
        return resource_path("images/$background");
    }
}
