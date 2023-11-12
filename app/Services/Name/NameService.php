<?php

namespace App\Services\Name;

use App\Models\Gender;
use App\Models\Name;
use App\Models\NameTrait;
use App\Services\ImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember('names', now()->addHour(), function () {
            return Name::validMeaning()->limit(30)->get();
        });
    }

    public function getNameDetails(string $name): array
    {
        $nameDetails = Cache::remember("nameDetails:$name", now()->addQuarter(), function () use ($name) {
            return Name::with(['gender','comments'])->where('slug', $name)->firstOrFail();
        });

        $numerologyData = NumerologyFactory::create('pythagorean')->getNumerologyData($nameDetails->name);
        $fancyTexts = (new FancyTextService($nameDetails->name))->generate();
        $acronyms = $this->getAcronyms($nameDetails->name);

        $wallpaperUrl = route('names.wallpaper', ['name' => $nameDetails->slug]);
        $signatureUrls = $this->nameSignatures($nameDetails->slug);
        $userNames = $this->usernameGeneratorService->generateUsernames($nameDetails->name);

        return [
            'nameDetails' => $nameDetails,
            'numerology' => $numerologyData,
            'acronyms' => $acronyms,
            'fancyTexts' => $fancyTexts,
            'wallpaperUrl' => $wallpaperUrl,
            'signatureUrls' => $signatureUrls,
            'userNames' => $userNames,
        ];
    }

    public function getNamesByGender(string $gender)
    {
        $key = "names:$gender";
        $genderWithNames = Cache::remember('', now()->addHour(), function () use ($gender){
            return Gender::with(['names' => function($query){
                $query->validMeaning()->take(30);
            }])->where('slug', $gender)->firstOrFail();
        });

        return $genderWithNames->names;
    }

    public function getRandomNames(): Collection
    {
        $random = rand(1, 20);
        $key = "names:$random";
        return Cache::remember($key, now()->addQuarter(), function () {
            return Name::validMeaning()->inRandomOrder()->limit(10)->get();
        });
    }

    public function searchNames(string $query): Collection
    {
        return Cache::remember("search:$query", now()->addQuarter(), function () use ($query) {
            return Name::search($query)->limit(10)->get();
        });
    }

    public function nameWallpaper(string $name): Response
    {
        $name = Name::where('slug', $name)->firstOrFail()->name;
        $fontSize = strlen($name) > 10 ? 150 : 200;
        $base64Image =  $this->imageService->generateOrRetrieveImage(
            $name,
            '#000000',
            'static/images/wallpaper.jpg',
            'roboto/roboto-bold.ttf',
            $fontSize
        );

        return $this->imageService->prepareImageResponse($base64Image, $name, 'name wallpaper');
    }

    public function individualSignature(string $name, string $fontKey): Response
    {
        $actualName = Name::where('slug', $name)->firstOrFail()->name;
        $actualName = explode(' ', $actualName)[0];
        $actualName = $this->normalizeName($actualName);
        $fontPath = $this->mapFontKeyToPath($fontKey);
        $fontSize = $this->mapFontKeyToSize($fontKey);

        // Assuming the generateOrRetrieveImage method returns a base64 encoded image
        $base64Image = $this->imageService->generateOrRetrieveImage(
            $actualName,
            '#000000',
            'static/images/signature_background.jpg',
            $fontPath,
            $fontSize
        );
        return $this->imageService->prepareImageResponse($base64Image, $name, 'name signature');
    }

    public function normalizeName($name): array|string|null
    {
        // Transliterate characters to ASCII
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);

        // Remove any residual non-ASCII characters
        return preg_replace('/[^A-Za-z0-9 ]/', '', $normalized);
    }

    private function getAcronyms(string $name): array
    {
        $name = $this->normalizeName($name);
        $alphabets = str_split($name);
        $alphabets = array_filter($alphabets, function ($alphabet) {
            return $alphabet !== ' ';
        });
        $upperAlphabets = array_map('strtoupper', $alphabets);

        // Getting all traits for the alphabets
        $traitsCollection = NameTrait::whereIn('alphabet', $upperAlphabets)->get()->groupBy('alphabet');

        return collect($alphabets)->mapWithKeys(function ($alphabet) use ($traitsCollection) {
            $alphabetKey = strtoupper($alphabet);

            // Check if there are multiple traits for the alphabet and pick one randomly
            if (isset($traitsCollection[$alphabetKey]) && $traitsCollection[$alphabetKey]->count() > 0) {
                $randomTrait = $traitsCollection[$alphabetKey]->random();
                return [$alphabet => $randomTrait->name ?? null];
            }

            return [$alphabet => null];
        })->toArray();
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

    public function generateUsernames(string $name): array
    {
        $name = Cache::remember("name:$name", now()->addQuarter(), function () use ($name) {
            return Name::where('name', $name)->firstOrFail()->name;
        });
        $usernameGenerator = new UsernameGeneratorService();
        return $usernameGenerator->generateUsernames($name);
    }

    public function generateAcronyms(string $name): array
    {
        $name = Cache::remember("name:$name", now()->addQuarter(), function () use ($name) {
            return Name::where('name', $name)->firstOrFail()->name;
        });
        return $this->getAcronyms($name);
    }

    public function generateFancyTexts(string $name): array
    {
        $name = Cache::remember("name:$name", now()->addQuarter(), function () use ($name) {
            return Name::where('name', $name)->firstOrFail()->name;
        });
        $fancyText = new FancyTextService($name);
        return $fancyText->generate();
    }

    private function mapFontKeyToPath(string $fontKey): ?string
    {
        $fonts = [
            'cursive' => 'creattion-demo/creattion-demo.ttf',
            'allison-tessa' => 'allison-tessa/allison-tessa.ttf',
            'monsieur-la-doulaise' => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf'
        ];

        return $fonts[$fontKey] ?? null;
    }

    private function mapFontKeyToSize(string $fontKey): ?int
    {
        $fonts = [
            'cursive' => 250,
            'allison-tessa' => 120,
            'monsieur-la-doulaise' => 190
        ];

        return $fonts[$fontKey] ?? null;
    }
}
