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
            'font_size'  => 200,
            'font_color' => '#a62756',
            'text'       => true
        ],
        'gamer' => [
            'background' => 'wallpaper_gamer.jpg',
            'position_x' => 300,
            'position_y' => 750,
            'font_path'  => 'edo/edo.ttf',
            'font_size'  => 250,
            'font_color' => '#ffffff',
            'text'       => true
        ],
        'pet' => [
            'background' => 'wallpaper_pet.jpg',
            'font_path'  => 'roboto/roboto-bold.ttf',
            'font_size'  => 150,
            'font_color' => '#f2f9f9',
            'text'       => true
        ],
        'evening' => [
            'background' => 'wallpaper_evening.jpg',
            'position_x' => 970,
            'position_y' => 600,
            'font_path'  => 'poppins/poppins-regular.ttf',
            'font_size'  => 150,
            'font_color' => '#ffffff',
            'text'       => true
        ],
        'cat' => [
            'background' => 'wallpaper_cat.jpg',
            'text'       => false
        ]
    ];

    protected array $signStyles = [
        'cursive' => [
            'font_path'  => 'creattion-demo/creattion-demo.ttf',
            'font_size'  => 250,
            'font_color' => '#000000',
            'text'       => true
        ],
        'allison-tessa' => [
            'font_path'  => 'allison-tessa/allison-tessa.ttf',
            'font_size'  => 120,
            'font_color' => '#000000',
            'text'       => true
        ],
        'monsieur-la-doulaise' => [
            'font_path'  => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf',
            'font_size'  => 190,
            'font_color' => '#000000',
            'text'       => true
        ]
    ];

    private BaseImageService $baseImageService;

    public function __construct(BaseImageService $baseImageService)
    {
        $this->baseImageService = $baseImageService;
    }

    public function wallpaper(string $nameSlug, string $style): Response
    {
        $name = $this->getNameFromSlug($nameSlug)->name;
        $style = $this->getStyle($style, 'wallpaper');

        $style = array_merge($style, [
            'seo_title' => 'Name Wallpaper',
        ]);

        return $this->baseImageService->generateImage($name, $style);
    }

    public function signature(string $name, string $style): Response
    {
        $style = $this->getStyle($style, 'signature');
        $firstPart = $this->getFirstPartOfName($name);

        $style = array_merge($style, [
            'seo_title' => 'Name Signature',
            'background' => 'signature_background.jpg'
        ]);

        return $this->baseImageService->generateImage($firstPart, $style);
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
        $defaultStyle = $styles['funky'] ?? reset($styles);

        return $styles[$style] ?? $defaultStyle;
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
