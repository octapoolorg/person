<?php

namespace App\Services;


use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as ImageObject;

class BaseImageService
{
    public function generateImageResponse(string $name, array $style): Response
    {
        $base64Image = $this->generateOrRetrieveImage(
            $name,
            $style['background'],
            $style['font_color'],
            $style['font_path'],
            $style['font_size'] ?? (strlen($name) > 10 ? 150 : 200)
        );

        return $this->prepareImageResponse($base64Image, $name, $style['name']);
    }

    /**
     * Generate an image with text applied.
     *
     * @param  string  $name  The text to be applied on the image.
     * @param  string  $color  The color of the text.
     * @param  string  $background  The path to the background image.
     * @param  string  $font  The font of the text.
     * @param  int  $fontSize  The size of the font.
     * @return string The generated image as a data URL.
     */
    private function generateImage(string $name, string $background, string $color, string $font, int $fontSize, ?string $size = null): string
    {
        try {
            $fontPath = $this->getFontPath($font);
            $backgroundPath = $this->getBackgroundPath($background);

            $this->validateFilePaths([$fontPath, $backgroundPath]);

            $img = Image::make($backgroundPath);
            $this->applyTextToImage($img, $name, $color, $fontPath, $fontSize);

            if ($size === 'thumb') {
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            return (string) $img->encode('data-url');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return '';
        }
    }

    /**
     * Retrieve the full path of a font file.
     *
     * @param  string  $font  The font file name.
     * @return string The full path to the font file.
     */
    private function getFontPath(string $font): string
    {
        return resource_path("fonts/$font");
    }

    /**
     * Retrieve the full path of a background image file.
     *
     * @param  string  $background  The background image file name.
     * @return string The full path to the background image file.
     */
    private function getBackgroundPath(string $background): string
    {
        return resource_path("images/$background");
    }

    /**
     * Apply text to an image.
     *
     * @param  ImageObject  $img  The image object.
     * @param  string  $name  The text to be applied.
     * @param  string  $color  The color of the text.
     * @param  string  $fontPath  The path to the font file.
     * @param  int  $fontSize  The font size.
     */
    private function applyTextToImage(ImageObject $img, string $name, string $color, string $fontPath, int $fontSize): void
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
     * @param  array  $paths  Array of file paths to validate.
     *
     * @throws FileNotFoundException Thrown if a file does not exist.
     */
    private function validateFilePaths(array $paths): void
    {
        foreach ($paths as $path) {
            if (! file_exists($path)) {
                throw new Exception("File not found at $path");
            }
        }
    }

    /**
     * Generate or retrieve a cached image.
     *
     * @param  string  $name  The text to be applied on the image.
     * @param  string  $color  The color of the text.
     * @param  string  $background  The path to the background image.
     * @param  string  $font  The font of the text.
     * @param  int  $fontSize  The size of the font.
     * @return string The generated image as a data URL.
     */
    public function generateOrRetrieveImage(string $name, string $color, string $background, string $font, int $fontSize, ?string $size = null): string
    {
        $key = "image:$name:$color:$background:$font:$fontSize:$size";

        return cache_remember($key, function () use ($name, $color, $background, $font, $fontSize, $size) {
            return $this->generateImage($name, $color, $background, $font, $fontSize, $size);
        });
    }

    /**
     * Prepare an HTTP response with the image data.
     *
     * @param  string  $base64Image  The base64 encoded image data.
     * @param  string  $actualName  The name for the image file.
     * @param  string  $imageName  The name for the image file.
     * @return Response The HTTP response with the image.
     */
    public function prepareImageResponse(string $base64Image, string $actualName, string $imageName): Response
    {
        $imageInfo = explode(',', $base64Image);
        $imageData = base64_decode($imageInfo[1]);

        return response($imageData)
            ->header('Content-Type', 'image/jpg')
            ->header('Content-Disposition', "inline; filename=\"$actualName $imageName.jpg\"");
    }
}
