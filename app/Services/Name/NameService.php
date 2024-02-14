<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Gender;
use App\Models\Name;
use App\Models\Origin;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class NameService
{
    protected UsernameGeneratorService $usernameGeneratorService;

    protected ImageService $imageService;

    public function __construct(UsernameGeneratorService $usernameGeneratorService, ImageService $imageService)
    {
        $this->usernameGeneratorService = $usernameGeneratorService;
        $this->imageService = $imageService;
    }

    public function getNames(): LengthAwarePaginator
    {
        return cache_remember('names:index', function () {
            return
                Name::query()
                ->valid()
                ->paginate(30);
        });
    }

    public function getName(string $nameSlug): array
    {
        $name = cache_remember("name:$nameSlug", function () use ($nameSlug) {
            $name = Name::query()
                ->withoutGlobalScopes()
                ->with(['comments'])
                ->where('slug', $nameSlug)
                ->firstOrFail();

            $sortedMeanings = collect(explode(',', $name->meaning))
                ->sort(function ($a, $b) {
                    return Str::length($b) <=> Str::length($a);
                });

            // Adjust to ensure mainMeaning contains 3 elements if possible
            if ($sortedMeanings->count() > 3) {
                $mainMeanings = $sortedMeanings->splice(0, 3);
                $name->mainMeaning = $mainMeanings->implode(', ');
            } else {
                $name->mainMeaning = $sortedMeanings->implode(', ');
                $name->meanings = collect();
                return $name; // Early return if not enough meanings for separation
            }

            // Adjust to limit meanings array to 5 elements, concatenating as necessary
            $remainingMeanings = $sortedMeanings->chunk(ceil($sortedMeanings->count() / 5));
            $name->meanings = $remainingMeanings->map(function ($chunk) {
                return $chunk->implode(', ');
            });

            return $name;
        });

        return [
            'name' => $name,
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($name->name),
            'abbreviations' => $this->getAbbreviations($name->name),
            'fancyTexts' => $this->getFancyTexts($name->name),
            'wallpaperUrls' => $this->imageService->nameWallpapers($name->slug),
            'signatureUrls' => $this->imageService->nameSignatures($name->slug),
            'userNames' => $this->getUsernames($name->slug),
        ];
    }

    public function getNamesByGender(string $gender): LengthAwarePaginator
    {
        return cache_remember("names:$gender", function () use ($gender) {
            return Name::query()->withoutGlobalScopes()->whereHas('gender', function ($query) use ($gender) {
                $query->where('slug', $gender);
            })->paginate(30);
        });
    }

    public function getRandomNames(): Collection
    {
        $randomness = rand(1, 30);

        return cache_remember("names:random:$randomness", function () {
            return Name::withoutGlobalScopes()->valid()->inRandomOrder()->limit(10)->get();
        });
    }

    public function searchNames(Request $request): LengthAwarePaginator
    {
        $randomness = rand(1, 15);
        $cacheKey = 'search:' . Str::slug($request->fullUrl()) . ":$randomness";

        // return cache_remember($cacheKey, function () use ($request) {
            $query = Name::query()->withoutGlobalScopes();

            $request->whenFilled('q', function ($searchTerm) use ($query) {
                $query->search($searchTerm);
            });

            $request->whenFilled('alphabet', function ($alphabet) use ($query) {
                $query->where('name', 'like', $alphabet . '%');
            });

            $request->whenFilled('origin', function ($origin) use ($query) {
                $query->whereHas('origins', function ($q) use ($origin) {
                    $q->where('slug', $origin);
                });
            });

            $request->whenFilled('gender', function ($gender) use ($query) {
                $query->whereHas('gender', function ($q) use ($gender) {
                    $q->where('slug', $gender);
                });
            });


            $query->orderBy('is_popular', 'desc');
            $query->orderBy('is_simple', 'desc');
            $query->orderBy('name', 'asc');

            
            $query= $query->paginate(20);

            $query->appends(request()->query());

            return $query;
        // });
    }

    public function getFavoriteNames(): collection
    {
        $uuid = request()->cookie('uuid');

        $nameSlugs = cache_remember("favorites:$uuid", function () use ($uuid) {
            return Favorite::where('uuid', $uuid)->get(['slug']);
        }, now()->addWeek());

        $names = Name::query()->withoutGlobalScopes()->whereIn('slug', $nameSlugs)->get();

        return $names;
    }

    public function getUsernames(string $name): array
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameGeneratorService->generateUsernames($name);
        });
    }

    public function getAbbreviations(string $name): array
    {
        $name = normalize_name($name);
        $alphabets = collect(str_split($name))->filter(function ($alphabet) {
            return $alphabet !== ' ';
        })->toUpper()->toArray();

        // Getting abbreviations for the alphabets
        $randomness = rand(1, 15);
        $abbreviationsCollection = cache_remember("abbreviations:$name:$randomness", function () use ($alphabets) {
            return Abbreviation::whereIn('alphabet', $alphabets)->get()->groupBy('alphabet');
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

    public function getFancyTexts(string $name): array
    {
        $randomness = rand(1, 15);
        $fancyTextService = new FancyTextService($name);

        return cache_remember("fancyTexts:$name:$randomness", function () use ($fancyTextService) {
            return $fancyTextService->generate();
        });
    }

    public function getNamesByOrigin(string $origin)
    {
        $randomness = rand(1, 15);

        return cache_remember("names:$origin:$randomness", function () use ($origin) {
            return Name::query()->whereHas('origins', function ($query) use ($origin) {
                $query->where('slug', $origin);
            })->limit(30)->get();
        });
    }

    public function getNamesByCategory(string $category)
    {
        $randomness = rand(1, 15);

        return cache_remember("names:$category:$randomness", function () use ($category) {
            return Name::query()->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            })->limit(30)->get();
        });
    }

    public function getNamesByStarting(string $starting)
    {
        $randomness = rand(1, 15);

        return cache_remember("names:$starting:$randomness", function () use ($starting) {
            return Name::query()->where('name', 'like', "$starting%")->limit(30)->get();
        });
    }

    public function getNamesByEnding(string $ending)
    {
        $randomness = rand(1, 15);

        return cache_remember("names:$ending:$randomness", function () use ($ending) {
            return Name::query()->where('name', 'like', "%$ending")->limit(30)->get();
        });
    }

    public function getCategory(string $category)
    {
        return cache_remember("category:$category", function () use ($category) {
            return Category::where('slug', $category)->firstOrFail();
        });
    }

    public function getOrigin(string $origin)
    {
        return cache_remember("origin:$origin", function () use ($origin) {
            return Origin::where('slug', $origin)->firstOrFail();
        });
    }

    public function getGender(string $gender)
    {
        return cache_remember("gender:$gender", function () use ($gender) {
            return Gender::where('slug', $gender)->firstOrFail();
        });
    }
}
