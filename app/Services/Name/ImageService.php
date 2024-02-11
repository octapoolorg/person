<?php

namespace App\Services\Name;

use App\Models\Name;
use Illuminate\Http\Response;
use App\Services\BaseImageService;
class ImageService
{
    protected array $wallpaperStyles = [
        'funky' => [
            'background' => 'wallpaper_funky.jpg',
            'font_path'  => 'roboto/roboto-bold.ttf',
            'font_size'  => 150,
            'font_color' => '#000000',
        ],
        'dark' => [
            'background' => 'wallpaper_dark.jpg',
            'font_path'  => 'better-saturday/better-saturday.ttf',
            'font_size'  => 150,
            'font_color' => '#ffffff',
        ],
        'gamer' => [
            'background' => 'wallpaper_gamer.jpg',
            'font_path'  => 'edo/edo.ttf',
            'font_size'  => 150,
            'font_color' => '#000000',
        ],
        'nature' => [
            'background' => 'wallpaper_nature.jpg',
            'font_path'  => 'roboto/roboto-bold.ttf',
            'font_size'  => 150,
            'font_color' => '#ffffff',
        ],
        'summer' => [
            'background' => 'wallpaper_summer.jpg',
            'font_path'  => 'roboto/roboto-bold.ttf',
            'font_size'  => 150,
            'font_color' => '#000000',
        ],
    ];

    protected array $signStyles = [
        'cursive' => [
            'font_path'  => 'creattion-demo/creattion-demo.ttf',
            'font_size'  => 250,
            'font_color' => '#000000',
        ],
        'allison-tessa' => [
            'font_path'  => 'allison-tessa/allison-tessa.ttf',
            'font_size'  => 120,
            'font_color' => '#000000',
        ],
        'monsieur-la-doulaise' => [
            'font_path'  => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf',
            'font_size'  => 190,
            'font_color' => '#000000',
        ],
    ];

    private BaseImageService $baseImageService;

    public function __construct(BaseImageService $baseImageService)
    {
        $this->baseImageService = $baseImageService;
    }

    public function individualWallpaper(string $nameSlug, string $style): Response
    {
        $name = $this->getNameFromSlug($nameSlug)->name;
        $style = $this->getStyle($style, 'wallpaper');

        return $this->generateImageResponse($name, $style, 'name wallpaper');
    }

    public function individualSignature(string $name, string $style): Response
    {
        $style = $this->getStyle($style, 'signature');
        $firstPart = $this->getFirstPartOfName($name);

        return $this->generateImageResponse($firstPart, $style, 'name signature');
    }

    public function nameWallpapers(string $name): array
    {
        return $this->generateUrls($name, array_keys($this->wallpaperStyles), 'names.wallpaper');
    }

    public function nameSignatures(string $name): array
    {
        return $this->generateUrls($name, array_keys($this->signStyles), 'names.signature');
    }

    private function getNameFromSlug(string $nameSlug): Name
    {
        return cache_remember("name:$nameSlug", function () use ($nameSlug) {
            return Name::withoutGlobalScope('active')->where('slug', $nameSlug)->firstOrFail();
        });
    }

    private function getStyle(string $style, string $type): array
    {
        $styles = $type === 'wallpaper' ? $this->wallpaperStyles : $this->signStyles;
        $defaultStyle = $styles['funky'] ?? reset($styles); // For wallpaper, 'funky' is the default; adjust for signatures.

        return $styles[$style] ?? $defaultStyle;
    }

    private function generateImageResponse(string $name, array $style, string $metaName): Response
    {
        $meta = [
            'name' => $metaName,
        ];

        if ($metaName === 'name signature') {
            $meta['background'] = 'signature_background.jpg';
        }

        $style = array_merge($style, $meta);

        return $this->baseImageService->generateImageResponse($name, $style);
    }

    private function getFirstPartOfName(string $name): string
    {
        return normalize_name(explode(' ', $name)[0]);
    }

    private function generateUrls(string $name, array $styles, string $routeName): array
    {
        $urls = [];

        foreach ($styles as $style) {
            $urls[$style] = route($routeName, ['name' => $name, 'style' => $style]);
        }

        return $urls;
    }
}
