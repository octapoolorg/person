<?php

namespace App\Services\Name;

use App\Services\BaseImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ToolService
{
    private BaseImageService $baseImageService;
    private FancyTextService $fancyTextService;
    private UsernameService $usernameService;


    protected array $wallpaperStyles = [
        'funky' => [
            'background' => 'wallpaper_funky.jpg',
            'position_x' => 970,
            'position_y' => 400,
            'font_path' => 'roboto/roboto-bold.ttf',
            'font_size' => 150,
            'font_color' => '#f2f9f9',
            'text' => true,
        ],
        'cat' => [
            'background' => 'wallpaper_cat.jpg',
            'text' => false,
        ],
    ];

    protected array $signStyles = [
        'cursive' => [
            'font_path' => 'creattion-demo/creattion-demo.ttf',
            'font_size' => 250,
            'font_color' => '#000000',
            'text' => true,
        ],
        'allison-tessa' => [
            'font_path' => 'allison-tessa/allison-tessa.ttf',
            'font_size' => 100,
            'font_color' => '#000000',
            'text' => true,
        ],
        'motterdam' => [
            'font_path' => 'motterdam/motterdam.ttf',
            'font_size' => 200,
            'font_color' => '#000000',
            'text' => true,
        ],
        'darlington' => [
            'font_path' => 'darlington/darlington.ttf',
            'font_size' => 200,
            'font_color' => '#000000',
            'text' => true,
        ],
        'autography' => [
            'font_path' => 'autography/autography.otf',
            'font_size' => 200,
            'font_color' => '#000000',
            'text' => true,
        ],
        'sign_style' => [
            'font_path' => 'sign_style/sign_style.ttf',
            'font_size' => 200,
            'font_color' => '#000000',
            'text' => true,
        ],
    ];

    public function __construct(BaseImageService $baseImageService, FancyTextService $fancyTextService, UsernameService $usernameService)
    {
        $this->baseImageService = $baseImageService;
        $this->fancyTextService = $fancyTextService;
        $this->usernameService = $usernameService;
    }

    public function wallpaper (string $name, string $style): Response
    {
        $style = $this->wallpaperStyles[$style];

        $style = array_merge($style, [
            'seo_title' => 'Name Wallpaper',
        ]);

        return $this->baseImageService->generate($name, $style);
    }

    public function signature(string $name, string $style): Response
    {
        $style = $this->signStyles[$style];
        $firstPart = get_first_part_of_name($name);

        $style = array_merge($style, [
            'seo_title' => 'Name Signature',
            'background' => 'signature_background.jpg',
        ]);

        return $this->baseImageService->generate($firstPart, $style);
    }

    public function getFancyTexts(string $name, bool $random = false): Collection
    {
        $randomness = $random ? rand(1, 15) : 1;

        return cache_remember("fancyTexts:$name:$randomness", function () use ($name) {
            return $this->fancyTextService->generate($name);
        });
    }

    public function getUsernames(string $name): Collection
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameService->generateUsernames($name);
        });
    }

    public function getNumerology(string $name): array
    {
        return cache_remember("numerology:$name", function () use ($name) {
            return NumerologyFactory::create()->getAnalysis($name);
        });
    }

    public function getWallpapers(string $nameSlug): Collection
    {
        $num = count($this->wallpaperStyles);
        $styles = array_rand($this->wallpaperStyles, $num);

        return $this->generateUrls($nameSlug, $styles, 'names.wallpaper');
    }

    public function getSignatures(string $nameSlug): Collection
    {
        $num = count($this->signStyles);
        $styles = array_rand($this->signStyles, $num);

        return $this->generateUrls($nameSlug, $styles, 'names.signature');
    }

    private function generateUrls(string $name, array $styles, string $routeName): Collection
    {
        $urls = [];

        foreach ($styles as $style) {
            $urls[$style] = route($routeName, ['name' => $name, 'style' => $style]);
        }

        return collect($urls);
    }
}