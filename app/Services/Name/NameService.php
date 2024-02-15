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
            $names = Name::query()
                ->withoutGlobalScopes()
                ->inRandomOrder()
                ->limit(300)
                ->get();

            $names = $names->sortBy('name');

            return paginate($names, 30);
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

            // Adjust to distribute meanings evenly across 5 elements
            $chunkSize = max(3, ceil($sortedMeanings->count() / 5));
            $remainingMeanings = $sortedMeanings->chunk($chunkSize);
            $name->meanings = $remainingMeanings->map(function ($chunk) {
                return $chunk->implode(', ');
            });

            // Limit the number of meanings to 5
            $name->meanings = $name->meanings->slice(0, 5);

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
        $names = cache_remember("names:$gender", function () use ($gender) {
            $names = Name::query()
                ->withoutGlobalScopes()
                ->popular()
                ->inRandomOrder()
                ->whereHas('gender', function ($query) use ($gender) {
                    $query->where('slug', $gender);
                })
                ->limit(200)
                ->get();

            return $names->sortBy('name');
        });

        return paginate($names, 30);
    }

    public function getRandomNames(): LengthAwarePaginator
    {
        $randomness = rand(1, 2);

        $names = cache_remember("names:random:$randomness", function () {
            return  Name::query()
                ->withoutGlobalScopes()
                ->popular()
                ->validGender()
                ->inRandomOrder()
                ->limit(200)
                ->get();
        }, now()->addWeek());

        $names = $names->sortBy('name');

        return paginate($names, 30);
    }

    public function searchNames(Request $request): LengthAwarePaginator
    {
        $cacheKey = 'search:' . implode($request->all());

        return cache_remember($cacheKey, function () use ($request) {
            $query = Name::query()->withoutGlobalScopes()->validGender()->simple();

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

            $names = $query->take(200)->get();

            //sort names by name
            $names = $names->sortBy('is_popular');
            $names = $names->sortBy('is_simple');
            $names = $names->sortBy('name');

            $names = paginate($names, 50);

            $names->appends($request->query());

            return $names;
        });
    }

    public function getFavoriteNames(): LengthAwarePaginator
    {
        $uuid = request()->cookie('uuid');

        $nameSlugs = cache_remember("favorites:$uuid", function () use ($uuid) {
            return Favorite::where('uuid', $uuid)->get(['slug']);
        }, now()->addWeek());

        $names = Name::query()->withoutGlobalScopes()->whereIn('slug', $nameSlugs)->get();

        return paginate($names, 30);
    }

    public function getUsernames(string $name): array
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameGeneratorService->generateUsernames($name);
        });
    }

    public function getAbbreviations(string $name, bool $rand = false): array
    {
        $name = normalize_name($name);
        $alphabets = collect(str_split($name))->filter(function ($alphabet) {
            return $alphabet !== ' ';
        })->toUpper()->toArray();

        // Getting abbreviations for the alphabets
        $randomness = $rand ? rand(1, 15) : 1;
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

    public function getFancyTexts(string $name, bool $random = false): array
    {
        $randomness = $random ? rand(1, 15) : 1;
        $fancyTextService = new FancyTextService($name);

        return cache_remember("fancyTexts:$name:$randomness", function () use ($fancyTextService) {
            return $fancyTextService->generate();
        });
    }

    public function getOriginNames(string $origin): LengthAwarePaginator
    {
        $names = cache_remember("names:origin:$origin", function () use ($origin) {
            return Name::query()
                ->withoutGlobalScopes()
                ->simple()
                ->validGender()
                ->inRandomOrder()
                ->whereHas('origins', function ($query) use ($origin) {
                    $query->where('slug', $origin);
                })
                ->limit(200)
                ->get();
        });

        $names = $names->sortBy('name');

        return paginate($names, 30);
    }

    public function getCategoryNames(string $category)
    {
        $names = cache_remember("names:category:$category", function () use ($category) {
            return Name::query()
                ->withoutGlobalScopes()
                ->simple()
                ->validGender()
                ->inRandomOrder()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                })
                ->limit(200)
                ->get();
        });


        $names->sortBy('name');

        return paginate($names, 30);
    }

    public function getStartingNames(string $starting)
    {
        return cache_remember("names:starting:$starting", function () use ($starting) {
            return Name::query()->where('name', 'like', "$starting%")->limit(30)->get();
        });
    }

    public function getEndingNames(string $ending)
    {
        return cache_remember("names:ending:$ending", function () use ($ending) {
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
