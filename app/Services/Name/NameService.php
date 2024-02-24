<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Models\Favorite;
use App\Models\Name;
use App\Services\BaseImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NameService
{
    protected UsernameService $usernameService;

    protected BaseImageService $baseImageService;

    public function __construct(UsernameService $usernameService, BaseImageService $baseImageService)
    {
        $this->usernameService = $usernameService;
        $this->baseImageService = $baseImageService;
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
            'font_size' => 120,
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
        $name = cache_remember("name:$nameSlug", function () use ($nameSlug) {
            $name = Name::query()
                ->withoutGlobalScopes()
                ->with(['origins.meanings' => function ($query) use ($nameSlug) {
                    // Assuming you have the Name model accessible here or you fetch it based on the slug
                    // Join the meanings table to filter meanings based on the name's slug
                    $query->whereExists(function ($subQuery) use ($nameSlug) {
                        $subQuery->select(DB::raw(1))
                            ->from('names')
                            ->whereColumn('names.id', 'meanings.name_id')
                            ->where('names.slug', $nameSlug);
                    });
                }, 'comments', 'nicknames', 'similarNames', 'siblingNames'])
                ->where('slug', $nameSlug)
                ->firstOrFail();

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

                return $name;
            }

            // Adjust to distribute meanings evenly across 5 elements
            $chunkSize = max(3, ceil($sortedMeanings->count() / 5));
            $remainingMeanings = $sortedMeanings->chunk($chunkSize);
            $name->meanings = $remainingMeanings->map(function ($chunk) {
                return $chunk->implode(', ');
            });

            return $name;
        });

        return [
            'name' => $name,
            'wallpaperUrls' => $this->wallpaperUrls($name->slug),
            'signatureUrls' => $this->signatureUrls($name->slug),
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($name->name),
            'abbreviations' => $this->getAbbreviations($name->name),
            'fancyTexts' => $this->getFancyTexts($name->name),
            'userNames' => $this->getUsernames($name->name),
            'quotes' => $this->getQuotes($name->name),
            'statuses' => $this->getStatuses($name->name),
        ];
    }

    public function getUsernames(string $name): array
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameService->generateUsernames($name);
        });
    }

    public function getQuotes(string $name): array
    {
        $quotes = collect(__('quotes', ['name' => $name]));

        return $quotes->random(3)->toArray();
    }

    public function getStatuses(string $name): array
    {
        $statuses = collect(__('statuses', ['name' => $name]));

        return $statuses->random(3)->toArray();
    }

    public function getAbbreviations(string $name): array
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

        return $abbreviations;
    }

    public function getFancyTexts(string $name, bool $random = false): array
    {
        $randomness = $random ? rand(1, 15) : 1;
        $fancyTextService = new FancyTextService($name);

        return cache_remember("fancyTexts:$name:$randomness", function () use ($fancyTextService) {
            return $fancyTextService->generate();
        });
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

    private function getFirstPartOfName(string $name): string
    {
        return normalize_name(explode(' ', $name)[0]);
    }

    public function wallpaperUrls(string $name): array
    {
        $num = count($this->wallpaperStyles) > 3 ? 3 : count($this->wallpaperStyles);
        $styles = array_rand($this->wallpaperStyles, $num);

        return $this->generateUrls($name, $styles, 'names.wallpaper');
    }

    public function signatureUrls(string $name): array
    {
        $num = count($this->signStyles) > 3 ? 3 : count($this->signStyles);
        $styles = array_rand($this->signStyles, $num);

        return $this->generateUrls($name, $styles, 'names.signature');
    }

    private function generateUrls(string $name, array $styles, string $routeName): array
    {
        $urls = [];

        foreach ($styles as $style) {
            $urls[$style] = route($routeName, ['name' => $name, 'style' => $style]);
        }

        return $urls;
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

    public function search(Request $request): LengthAwarePaginator
    {
        $request->validate([
            'q' => 'nullable|string',
            'origin' => 'nullable|string',
        ]);

        $params = $request
            ->collect()
            ->sortKeys()
            ->map(function ($value, $key) {
                return $key.':'.$value;
            })->implode(':');

        $cacheKey = 'search:'.$params;

        return cache_remember($cacheKey, function () use ($request) {
            $query = Name::query()
                ->with(['origins'])
                ->withoutGlobalScopes();

            $request->whenFilled('q', function ($searchTerm) use ($query) {
                $query->where('names.name', 'like', $searchTerm.'%');
            }, function () use ($query) {
                $query->popular();
            });

            $request->whenFilled('origin', function ($origin) use ($query) {
                $query->popular();
                $query->whereHas('origins', function ($q) use ($origin) {
                    $q->select('slug')->where('slug', $origin);
                });
            });

            $request->whenFilled('gender', function ($gender) use ($query) {
                $query->popular()->where('gender', $gender);
            });

            $query->orderBy('is_popular', 'desc')->orderBy('name', 'asc');
            $names = $query->paginate(30);

            $names->appends($request->query());

            return $names;
        });
    }
}
