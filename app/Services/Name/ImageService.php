<?php

namespace App\Services\Name;

use App\Enums\Gender;
use App\Models\Name;
use App\Services\BaseImageService;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ImageService
{
    private BaseImageService $baseImageService;

    protected array $wallpaperStyles;
    protected array $signStyles;
    protected array $coverStyles;

    public function __construct(BaseImageService $baseImageService)
    {
        $this->baseImageService = $baseImageService;

        $this->wallpaperStyles = config('name.wallpapers');
        $this->signStyles = config('name.signatures');
        $this->coverStyles = config('name.covers');
    }

    public function cover(Name $name): Response
    {
        $gender = ($name->gender === Gender::MASCULINE->value || $name->gender === Gender::FEMININE->value) ? $name->gender : 'neutral';

        $style = "cover_{$gender}";

        $style = $this->coverStyles[$style] ?? $this->coverStyles['cover_neutral'];

        $style = array_merge($style, [
            'seo_title' => 'Name Cover',
        ]);

        $name = $name->name;

        return $this->baseImageService->generate($name, $style);
    }

    public function wallpaper (string $name, string $style): Response
    {
        $style = $this->wallpaperStyles[$style] ?? abort(404);

        $style = array_merge($style, [
            'seo_title' => 'Name Wallpaper',
        ]);

        return $this->baseImageService->generate($name, $style);
    }

    public function signature (string $name, string $style): Response
    {
        $style = $this->signStyles[$style] ?? abort(404);

        $style = array_merge($style, [
            'seo_title' => 'Name Signature',
            'background' => 'signature_background.jpg',
        ]);

        return $this->baseImageService->generate($name, $style);
    }

    public function getWallpapers (string $nameSlug): Collection
    {
        $num = count($this->wallpaperStyles);
        $styles = array_rand($this->wallpaperStyles, $num);

        return $this->generateUrls($nameSlug, $styles, 'names.wallpaper');
    }

    public function getSignatures (string $nameSlug): Collection
    {
        $num = count($this->signStyles);
        $styles = array_rand($this->signStyles, $num);

        return $this->generateUrls($nameSlug, $styles, 'names.signature');
    }

    private function generateUrls (string $name, array $styles, string $routeName): Collection
    {
        $urls = [];

        foreach ($styles as $style) {
            $urls[$style] = route($routeName, ['name' => $name, 'style' => $style]);
        }

        return collect($urls);
    }
}