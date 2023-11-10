<?php

namespace App\Services;

use App\Models\Gender;
use App\Models\Name;
use App\Models\NameTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;

class NameService
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
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
            return Name::with('gender')->where('slug', $name)->firstOrFail();
        });

        $numerology = (new NumerologyFactory())->create('pythagorean');
        $numerologyData = $numerology->getNumerologyData($nameDetails->name);

        $fancyText = new FancyTextGenerator($nameDetails->name);
        $fancyTexts = $fancyText->generate();

        $alphabets = str_split($nameDetails->name);
        $traits = $this->getTraits($alphabets);

        $wallpaperUrl = route('nameWallpaper', ['name' => $nameDetails->name]);
        $signatureUrls = $this->nameSignatures($nameDetails->slug);

        return [
            'nameDetails' => $nameDetails,
            'numerology' => $numerologyData,
            'traits' => $traits,
            'fancyTexts' => $fancyTexts,
            'wallpaperUrl' => $wallpaperUrl,
            'signatureUrls' => $signatureUrls
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
        $base64Image =  $this->imageService->generateOrRetrieveImage(
            $name,
            '#ffffff',
            'static/images/wallpaper.jpg',
            'roboto/roboto-medium.ttf',
            200
        );

        return $this->imageService->prepareImageResponse($base64Image, $name);
    }

    public function individualSignature(string $name, string $fontKey): Response
    {
        $actualName = Name::where('slug', $name)->firstOrFail()->name;
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
        return $this->imageService->prepareImageResponse($base64Image, $name, $type = 'jpg');
    }

    private function getTraits(array $alphabets): \Illuminate\Support\Collection
    {
        $upperAlphabets = array_map('strtoupper', $alphabets);
        $traitsCollection = NameTrait::whereIn('alphabet', $upperAlphabets)->get()->keyBy('alphabet');

        return collect($alphabets)->mapWithKeys(function ($alphabet) use ($traitsCollection) {
            $alphabetKey = strtoupper($alphabet);
            return [$alphabet => $traitsCollection[$alphabetKey]->name ?? null];
        });
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
            $signatureUrls[$key] = route('individualSignature', ['name' => $name, 'font' => $key]);
        }

        return $signatureUrls;
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
