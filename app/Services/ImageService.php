<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Generate an image with text applied.
     *
     * @param string $name
     * @param string $color
     * @param string $background
     * @param string $font
     * @param int $fontSize
     * @return string
     * @throws FileNotFoundException
     * @throws Exception
     */
    public function generateImage(string $name, string $color, string $background, string $font, int $fontSize): string
    {
        $fontPath = public_path("static/fonts/$font");
        $backgroundPath = public_path($background);
        $this->validateFilePaths([$fontPath, $backgroundPath]);

        $img = Image::make($backgroundPath);

        $this->applyTextToImage($img, $name, $color, $fontPath, $fontSize);

        return (string)$img->encode('data-url');
    }

    /**
     * Apply text to an image.
     *
     * @param $img
     * @param string $name
     * @param string $color
     * @param string $fontPath
     * @param int $fontSize
     */
    private function applyTextToImage($img, string $name, string $color, string $fontPath, int $fontSize): void
    {
        $xPosition = $img->width() / 2;
        $yPosition = $img->height() / 2;

        $img->text($name, $xPosition, $yPosition, function ($font) use ($fontSize, $color, $fontPath) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color($color);
            $font->align('center');
            $font->valign('center');
        });
    }

    /**
     * Validate if files exist.
     *
     * @param array $paths
     * @throws FileNotFoundException
     */
    private function validateFilePaths(array $paths): void
    {
        foreach ($paths as $path) {
            if (!file_exists($path)) {
                throw new FileNotFoundException("File not found at $path");
            }
        }
    }
}
