<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Models\Favorite;
use App\Models\Name;
use App\Services\BaseImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DetailService
{
    private BaseImageService $baseImageService;
    private UsernameService $usernameService;
    private FancyTextService $fancyTextService;

    public function __construct(BaseImageService $baseImageService, UsernameService $usernameService, FancyTextService $fancyTextService)
    {
        $this->baseImageService = $baseImageService;
        $this->usernameService = $usernameService;
        $this->fancyTextService = $fancyTextService;
    }

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

    public function getName(string $nameSlug): array
    {
        $name = $this->fetchNameData($nameSlug);

        return $this->prepareResponseData($name);
    }

    private function getFirstPartOfName(string $name): string
    {
        return normalize_name(explode(' ', $name)[0]);
    }


    private function fetchNameData(string $nameSlug)
    {
        return cache_remember("name:$nameSlug", function () use ($nameSlug) {
            return $this->queryNameData($nameSlug);
        });
    }

    private function queryNameData(string $nameSlug)
    {
        $name = Name::query()
            ->withoutGlobalScopes()
            ->with([
                'origins.meanings' => function ($query) use ($nameSlug) {
                    $this->filterMeaningsBasedOnSlug($query, $nameSlug);
                },
                'comments', 'nicknames', 'similarNames', 'siblingNames'
            ])
            ->where('slug', $nameSlug)
            ->firstOrFail();

        $this->processMeanings($name);

        return $name;
    }

    private function filterMeaningsBasedOnSlug($query, string $nameSlug)
    {
        $query->whereExists(function ($subQuery) use ($nameSlug) {
            $subQuery->select(DB::raw(1))
                ->from('names')
                ->whereColumn('names.id', 'meanings.name_id')
                ->where('names.slug', $nameSlug);
        });
    }

    private function processMeanings($name)
    {
        $sortedMeanings = collect(explode(',', $name->meaning))
            ->sort(function ($a, $b) {
                return Str::length($b) <=> Str::length($a);
            });

        if ($sortedMeanings->count() > 3) {
            $mainMeanings = $sortedMeanings->splice(0, 3);
            $name->mainMeaning = $mainMeanings->implode(', ');
        } else {
            $name->mainMeaning = $sortedMeanings->implode(', ');
            $name->meanings = collect();
            return;
        }

        $chunkSize = max(3, ceil($sortedMeanings->count() / 5));
        $remainingMeanings = $sortedMeanings->chunk($chunkSize);
        $name->meanings = $remainingMeanings->map(function ($chunk) {
            return $chunk->implode(', ');
        });
    }

    private function prepareResponseData($name): array
    {
        return [
            'name' => $name,
            'wallpapers' => $this->getWallpapers($name->slug),
            'signatures' => $this->getSignatures($name->slug),
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($name->name),
            'abbreviations' => $this->getAbbreviations($name->name),
            'fancyTexts' => $this->getFancyTexts($name->name),
            'userNames' => $this->getUsernames($name->name),
            'quotes' => $this->getQuotes($name->name),
            'statuses' => $this->getStatuses($name->name),
        ];
    }

    public function getUsernames(string $name): Collection
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameService->generateUsernames($name);
        });
    }

    public function getQuotes(string $name): Collection
    {
        $quotes = collect(__('quotes', ['name' => $name]));

        return $quotes->random(3);
    }

    public function getStatuses(string $name): Collection
    {
        $statuses = collect(__('statuses', ['name' => $name]));

        return $statuses->random(3);
    }

    public function getAbbreviations(string $name): Collection
    {
        $name = normalize_name($name);
        $alphabets = collect(str_split($name))->filter(function ($alphabet) {
            return $alphabet !== ' ';
        })->toUpper()->toArray();

        // Getting abbreviations for the alphabets
        $abbreviationsCollection = cache_remember("abbreviations", function () use ($alphabets) {
            return Abbreviation::get()->groupBy('alphabet');
        });

        $abbreviations = [];
        foreach ($alphabets as $alphabet) {
            $alphabetKey = strtoupper($alphabet);

            // Check if there are multiple abbreviations for the alphabet and pick one randomly
            if (isset($abbreviationsCollection[$alphabetKey]) && $abbreviationsCollection[$alphabetKey]->count() > 0) {
                $randomAbbreviation = $abbreviationsCollection[$alphabetKey]->random();
                $abbreviations[] = [$alphabet => $randomAbbreviation->name ?? null];
            } else {
                $abbreviations[] = [$alphabet => null];
            }
        }

        return collect($abbreviations);
    }

    public function getFancyTexts(string $name, bool $random = false): Collection
    {
        $randomness = $random ? rand(1, 15) : 1;

        return cache_remember("fancyTexts:$name:$randomness", function () use ($name) {
            return $this->fancyTextService->generate($name);
        });
    }

    public function getWallpapers(string $name): Collection
    {
        $num = count($this->wallpaperStyles);
        $styles = array_rand($this->wallpaperStyles, $num);

        return $this->generateUrls($name, $styles, 'names.wallpaper');
    }

    public function getSignatures(string $name): Collection
    {
        $num = count($this->signStyles);
        $styles = array_rand($this->signStyles, $num);

        return $this->generateUrls($name, $styles, 'names.signature');
    }

    private function generateUrls(string $name, array $styles, string $routeName): Collection
    {
        $urls = [];

        foreach ($styles as $style) {
            $urls[$style] = route($routeName, ['name' => $name, 'style' => $style]);
        }

        return collect($urls);
    }

    public function wallpaper(string $nameSlug, string $style): Response
    {
        $style = $this->wallpaperStyles[$style];
        $name = $this->getName($nameSlug)['name']->name;

        $style = array_merge($style, [
            'seo_title' => 'Name Wallpaper',
        ]);

        return $this->baseImageService->generateImage($name, $style);
    }

    public function signature(string $name, string $style): Response
    {
        $style = $this->signStyles[$style];
        $name = $this->getName($name)['name']->name;
        $firstPart = $this->getFirstPartOfName($name);

        $style = array_merge($style, [
            'seo_title' => 'Name Signature',
            'background' => 'signature_background.jpg',
        ]);

        return $this->baseImageService->generateImage($firstPart, $style);
    }

    public function getFavorites(?string $favorite = null): LengthAwarePaginator
    {
        $uuid = $favorite ? $favorite : request()->cookie('uuid');

        $nameSlugs = cache_remember("favorites:$uuid", function () use ($uuid) {
            return Favorite::where('uuid', $uuid)->pluck('slug');
        });

        $names = Name::query()->withoutGlobalScopes()->whereIn('slug', $nameSlugs)->paginate(30);

        return $names;
    }
}