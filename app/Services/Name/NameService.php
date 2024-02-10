<?php

namespace App\Services\Name;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Name;
use App\Models\NameTrait;
use App\Models\Origin;
use App\Services\ImageService;
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
        return $this->cacheRemember('names', function () {
            return Name::validMeaning()->limit(30)->get();
        });
    }

    public function getNameDetails(string $name): array
    {
        $nameDetails = $this->cacheRemember("nameDetails:$name", function () use ($name) {
            return Name::withoutGlobalScope('active')->with(['gender', 'comments'])->where('slug', $name)->firstOrFail();
        });

        return [
            'nameDetails' => $nameDetails,
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($nameDetails->name),
            'abbreviations' => $this->getAbbreviations($nameDetails->name),
            'fancyTexts' => $this->getFancyTexts($nameDetails->name),
            'wallpaperUrl' => route('names.wallpaper', ['name' => $nameDetails->slug]),
            'signatureUrls' => $this->nameSignatures($nameDetails->slug),
            'userNames' => $this->getUsernames($nameDetails->slug)
        ];
    }

    public function getNamesByGender(string $gender): Collection
    {
        return $this->cacheRemember("names:$gender", function () use ($gender) {
            return Gender::with(['names' => function ($query) {
                $query->validMeaning()->take(30);
            }])->where('slug', $gender)->firstOrFail()->names;
        });
    }

    public function getRandomNames(): Collection
    {
        $random = rand(1, 15);
        return $this->cacheRemember("names:random:$random", function () {
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

    public function nameWallpaper(string $nameSlug, string $size): Response
    {
        $name = $this->cacheRemember("name:$nameSlug", function () use ($nameSlug) {
            return Name::withoutGlobalScope('active')->where('slug', $nameSlug)->firstOrFail()->name;
        });
        return $this->generateImageResponse($name, 'name wallpaper', 'static/images/wallpaper.jpg', 'roboto', $size);
    }

    public function individualSignature(string $name, string $fontKey): Response
    {
        $nameParts = explode(' ', $name);
        $firstPart = $this->normalizeName($nameParts[0]);
        return $this->generateImageResponse($firstPart, 'name signature', 'static/images/signature_background.jpg', $fontKey);
    }

    private function cacheRemember(string $key, \Closure $callback, $duration = null)
    {
        $duration = $duration ?? now()->addHour();
        return Cache::remember($key, $duration, $callback);
    }

    private function getFontDetails(string $fontKey): array
    {
        $fonts = [
            'cursive' => ['path' => 'creattion-demo/creattion-demo.ttf', 'size' => 250],
            'allison-tessa' => ['path' => 'allison-tessa/allison-tessa.ttf', 'size' => 120],
            'monsieur-la-doulaise' => ['path' => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf', 'size' => 190],
        ];

        return $fonts[$fontKey] ?? ['path' => 'roboto/roboto-bold.ttf', 'size' => null];
    }

    private function generateImageResponse(string $name, string $type, string $backgroundImage, string $fontKey = null, string $size = null): Response
    {
        $fontDetails = $this->getFontDetails($fontKey);
        $base64Image = $this->imageService->generateOrRetrieveImage(
            $name,
            '#000000',
            $backgroundImage,
            $fontDetails['path'],
            $fontDetails['size'] ?? (strlen($name) > 10 ? 150 : 200),
            $size
        );

        return $this->imageService->prepareImageResponse($base64Image, $name, $type);
    }

    private function normalizeName($name): array|string|null
    {
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        return preg_replace('/[^A-Za-z0-9 ]/', '', $normalized);
    }

    public function getUsernames(string $name): array
    {
        $randomness = rand(1, 15);
        return $this->cacheRemember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameGeneratorService->generateUsernames($name);
        });
    }

    public function getAbbreviations(string $name): array
    {
        $name = $this->normalizeName($name);
        $alphabets = str_split($name);
        $alphabets = array_filter($alphabets, function ($alphabet) {
            return $alphabet !== ' ';
        });
        $upperAlphabets = array_map('strtoupper', $alphabets);

        // Getting all traits for the alphabets
        $randomness = rand(1, 15);
        $traitsCollection = $this->cacheRemember("traits:$name:$randomness", function () use ($upperAlphabets) {
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

    private function nameSignatures(string $name): array
    {
        $fonts = [
            'cursive' => 'creattion-demo/creattion-demo.ttf',
            'allison-tessa' => 'allison-tessa/allison-tessa.ttf',
            'monsieur-la-doulaise' => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf'
        ];

        $signatureUrls = [];

        foreach ($fonts as $key => $fontPath) {
            $signatureUrls[$key] = route('names.signature', ['name' => $name, 'font' => $key]);
        }

        return $signatureUrls;
    }

    public function getFancyTexts(string $name): array
    {
        $randomness = rand(1, 15);
        $fancyTextService = new FancyTextService($name);
        return $this->cacheRemember("fancyTexts:$name:$randomness", function () use ($fancyTextService) {
            return $fancyTextService->generate();
        });
    }

    public function getNamesByOrigin(string $origin)
    {
        $randomness = rand(1, 15);
        return $this->cacheRemember("names:$origin:$randomness", function () use ($origin) {
            return Name::validMeaning()->whereHas('origins', function ($query) use ($origin) {
                $query->where('slug', $origin);
            })->limit(30)->get();
        });
    }

    public function getNamesByCategory(string $category)
    {
        $randomness = rand(1, 15);
        return $this->cacheRemember("names:$category:$randomness", function () use ($category) {
            return Name::validMeaning()->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            })->limit(30)->get();
        });
    }

    public function getNamesByStarting(string $starting)
    {
        $randomness = rand(1, 15);
        return $this->cacheRemember("names:$starting:$randomness", function () use ($starting) {
            return Name::validMeaning()->where('name', 'like', "$starting%")->limit(30)->get();
        });
    }

    public function getNamesByEnding(string $ending)
    {
        $randomness = rand(1, 15);
        return $this->cacheRemember("names:$ending:$randomness", function () use ($ending) {
            return Name::validMeaning()->where('name', 'like', "%$ending")->limit(30)->get();
        });
    }

    public function getCategory(string $category)
    {
        return $this->cacheRemember("category:$category", function () use ($category) {
            return Category::where('slug', $category)->firstOrFail();
        });
    }

    public function getOrigin(string $origin)
    {
        return $this->cacheRemember("origin:$origin", function () use ($origin) {
            return Origin::where('slug', $origin)->firstOrFail();
        });
    }

    public function getGender(string $gender)
    {
        return $this->cacheRemember("gender:$gender", function () use ($gender) {
            return Gender::where('slug', $gender)->firstOrFail();
        });
    }
}
