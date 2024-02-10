<?php

namespace App\Services\Name;

use App\Models\Name;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ImageService
{
    protected $wallpaperStyles = [
        'funky' => [
            'image_path' => 'static/images/wallpaper_funky.jpg',
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#000000'
        ],
        'gamer' => [
            'image_path' => 'static/images/wallpaper_gamer.jpg',
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#000000'
        ],
        'nature' => [
            'image_path' => 'static/images/wallpaper_nature.jpg',
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#ffffff'
        ],
        'kids' => [
            'image_path' => 'static/images/wallpaper_kids.jpg',
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#000000'
        ],
        'summer' => [
            'image_path' => 'static/images/wallpaper_summer.jpg',
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#000000'
        ],
    ];

    protected $fontStyles = [
        'cursive' => [
            'image_path' => 'static/images/signature_background.jpg',
            'font_path' => 'creattion-demo/creattion-demo.ttf',
            'font_size' => 250,
            'font_color' => '#000000'
        ],
        'allison-tessa' => [
            'image_path' => 'static/images/signature_background.jpg',
            'font_path' => 'allison-tessa/allison-tessa.ttf',
            'font_size' => 120,
            'font_color' => '#000000'
        ],
        'monsieur-la-doulaise' => [
            'image_path' => 'static/images/signature_background.jpg',
            'font_path' => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf',
            'font_size' => 190,
            'font_color' => '#000000'
        ],
    ];

    public function individualWallpaper(string $nameSlug, string $style): Response
    {
        $meta = [
            'name' => 'name wallpaper',
        ];

        $name = cache_remember("name:$nameSlug", function () use ($nameSlug) {
            return Name::withoutGlobalScope('active')->where('slug', $nameSlug)->firstOrFail()->name;
        });

        $style = $this->wallpaperStyles[$style] ?? $this->wallpaperStyles['funky'];

        $style = array_merge($style, $meta);

        return $this->generateImageResponse($name, $style);
    }

    public function individualSignature(string $name, string $style): Response
    {
        $meta = [
            'name' => 'name signature',
        ];

        $style = $this->fontStyles[$style] ?? $this->fontStyles['cursive'];

        $style = array_merge($style, $meta);

        $nameParts = explode(' ', $name);
        $firstPart = normalize_name($nameParts[0]);
        return $this->generateImageResponse($firstPart, $style);
    }

    public function nameWallpapers(string $name): array
    {
        $styles = array_keys($this->wallpaperStyles);

        $wallpaperUrls = [];

        foreach ($styles as $style) {
            $wallpaperUrls[] = route('names.wallpaper', ['name' => $name, 'style' => $style]);
        }

        return $wallpaperUrls;
    }

    public function nameSignatures(string $name): array
    {
        $styles = array_keys($this->fontStyles);

        $signatureUrls = [];

        foreach ($styles as $style) {
            $signatureUrls[$style] = route('names.signature', ['name' => $name, 'style' => $style]);
        }

        return $signatureUrls;
    }

    private function generateImageResponse(string $name, array $style) : Response
    {
        $base64Image = $this->generateOrRetrieveImage(
            $name,
            $style['font_color'],
            $style['image_path'],
            $style['font_path'],
            $style['font_size'] ?? (strlen($name) > 10 ? 150 : 200)
        );

        return $this->prepareImageResponse($base64Image, $name, $style['name']);
    }



    /**
     * Generate an image with text applied.
     *
     * @param string $name The text to be applied on the image.
     * @param string $color The color of the text.
     * @param string $background The path to the background image.
     * @param string $font The font of the text.
     * @param int $fontSize The size of the font.
     * @return string The generated image as a data URL.
     */
    public function generateImage(string $name, string $color, string $background, string $font, int $fontSize, string $size = null): string
    {
        try {
            $fontPath = $this->getFontPath($font);
            $backgroundPath = $this->getBackgroundPath($background);

            $this->validateFilePaths([$fontPath, $backgroundPath]);

            $img = Image::make($backgroundPath);
            $this->applyTextToImage($img, $name, $color, $fontPath, $fontSize);

            if($size === 'thumb') {
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            return (string)$img->encode('data-url');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return '';
        }
    }

    /**
     * Retrieve the full path of a font file.
     *
     * @param string $font The font file name.
     * @return string The full path to the font file.
     */
    private function getFontPath(string $font): string
    {
        return public_path("static/fonts/$font");
    }

    /**
     * Retrieve the full path of a background image file.
     *
     * @param string $background The background image file name.
     * @return string The full path to the background image file.
     */
    private function getBackgroundPath(string $background): string
    {
        return public_path($background);
    }

    /**
     * Apply text to an image.
     *
     * @param \Intervention\Image\Image $img The image object.
     * @param string $name The text to be applied.
     * @param string $color The color of the text.
     * @param string $fontPath The path to the font file.
     * @param int $fontSize The font size.
     */
    private function applyTextToImage(\Intervention\Image\Image $img, string $name, string $color, string $fontPath, int $fontSize): void
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
     * @param array $paths Array of file paths to validate.
     * @throws FileNotFoundException Thrown if a file does not exist.
     */
    private function validateFilePaths(array $paths): void
    {
        foreach ($paths as $path) {
            if (!file_exists($path)) {
                throw new Exception("File not found at $path");
            }
        }
    }

    /**
     * Generate or retrieve a cached image.
     *
     * @param string $name The text to be applied on the image.
     * @param string $color The color of the text.
     * @param string $background The path to the background image.
     * @param string $font The font of the text.
     * @param int $fontSize The size of the font.
     * @return string The generated image as a data URL.
     */
    public function generateOrRetrieveImage(string $name, string $color, string $background, string $font, int $fontSize, string $size = null): string
    {
        $key = "image:$name:$background:$font:$fontSize:$size";
        return Cache::remember($key, now()->addYear(), function () use ($name, $color, $background, $font, $fontSize, $size) {
            return $this->generateImage($name, $color, $background, $font, $fontSize, $size);
        });
    }

    /**
     * Prepare an HTTP response with the image data.
     *
     * @param string $base64Image The base64 encoded image data.
     * @param string $actualName The name for the image file.
     * @param string $imageName The name for the image file.
     * @return Response The HTTP response with the image.
     */
    public function prepareImageResponse(string $base64Image, string $actualName, string $imageName): Response
    {
        $imageInfo = explode(',', $base64Image);
        $imageData = base64_decode($imageInfo[1]);
        return response($imageData)
            ->header('Content-Type', "image/jpg")
            ->header('Content-Disposition', "inline; filename=\"$actualName $imageName.jpg\"");
    }
}