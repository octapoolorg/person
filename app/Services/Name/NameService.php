<?php

namespace App\Services\Name;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Name;
use App\Models\NameTrait;
use App\Models\Origin;
use App\Services\Name\ImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
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

    public function getNames(): Collection
    {
        return cache_remember('names', function () {
            return Name::validMeaning()->limit(30)->get();
        });
    }

    public function getNameDetails(string $name): array
    {
        $nameDetails = cache_remember("nameDetails:$name", function () use ($name) {
            return Name::withoutGlobalScope('active')->with(['gender', 'comments'])->where('slug', $name)->firstOrFail();
        });

        return [
            'nameDetails' => $nameDetails,
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($nameDetails->name),
            'abbreviations' => $this->getAbbreviations($nameDetails->name),
            'fancyTexts' => $this->getFancyTexts($nameDetails->name),
            'wallpaperUrls' => $this->imageService->nameWallpapers($nameDetails->slug),
            'signatureUrls' => $this->imageService->nameSignatures($nameDetails->slug),
            'userNames' => $this->getUsernames($nameDetails->slug)
        ];
    }

    public function getNamesByGender(string $gender): Collection
    {
        return cache_remember("names:$gender", function () use ($gender) {
            return Gender::with(['names' => function ($query) {
                $query->validMeaning()->take(30);
            }])->where('slug', $gender)->firstOrFail()->names;
        });
    }

    public function getRandomNames(): Collection
    {
        $random = rand(1, 15);
        return cache_remember("names:random:$random", function () {
            return Name::validMeaning()->inRandomOrder()->limit(10)->get();
        }, now()->addDay());
    }

    public function searchNames(Request $request) : LengthAwarePaginator
    {
        $randomness = rand(1, 15);
        $cacheKey = "search:" . Str::slug($request->fullUrl()) . ":$randomness";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($request) {
            $query = Name::query()->withoutGlobalScope('active');

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

            return $query->paginate(20);
        });
    }

    public function getFavoriteNames() : array
    {
        $favoriteNames = request()->cookie('favorites-list');

        if ($favoriteNames) {
            $names = json_decode($favoriteNames, true);
            //to object
            $names = array_map(function ($name) {
                return (object) $name;
            }, $names);
        }

        return $names ?? [];
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
        $alphabets = str_split($name);
        $alphabets = array_filter($alphabets, function ($alphabet) {
            return $alphabet !== ' ';
        });
        $upperAlphabets = array_map('strtoupper', $alphabets);

        // Getting all traits for the alphabets
        $randomness = rand(1, 15);
        $traitsCollection = cache_remember("traits:$name:$randomness", function () use ($upperAlphabets) {
            return NameTrait::whereIn('alphabet', array_unique($upperAlphabets))->get()->groupBy('alphabet');
        });

        $traits = [];
        foreach ($alphabets as $alphabet) {
            $alphabetKey = strtoupper($alphabet);

            // Check if there are multiple traits for the alphabet and pick one randomly
            if (isset($traitsCollection[$alphabetKey]) && $traitsCollection[$alphabetKey]->count() > 0) {
                $randomTrait = $traitsCollection[$alphabetKey]->random();
                $traits[] = [$alphabet => $randomTrait->name ?? null];
            } else {
                $traits[] = [$alphabet => null];
            }
        }

        return $traits;
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
            return Name::validMeaning()->whereHas('origins', function ($query) use ($origin) {
                $query->where('slug', $origin);
            })->limit(30)->get();
        });
    }

    public function getNamesByCategory(string $category)
    {
        $randomness = rand(1, 15);
        return cache_remember("names:$category:$randomness", function () use ($category) {
            return Name::validMeaning()->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            })->limit(30)->get();
        });
    }

    public function getNamesByStarting(string $starting)
    {
        $randomness = rand(1, 15);
        return cache_remember("names:$starting:$randomness", function () use ($starting) {
            return Name::validMeaning()->where('name', 'like', "$starting%")->limit(30)->get();
        });
    }

    public function getNamesByEnding(string $ending)
    {
        $randomness = rand(1, 15);
        return cache_remember("names:$ending:$randomness", function () use ($ending) {
            return Name::validMeaning()->where('name', 'like', "%$ending")->limit(30)->get();
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
