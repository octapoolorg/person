<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\NameTrait;
use App\Services\ImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class NameController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): View
    {
        $names = $this->getCachedData("names",now()->addHour(), function () {
            return Name::validMeaning()->limit(30)->get();
        });

        return view('names.list', compact('names'));
    }

    public function view(string $name): View
    {
        $nameDetails = $this->getCachedData("nameDetails:$name",now()->addQuarter(), function () use ($name) {
            return Name::with('gender')->where('slug', $name)->firstOrFail();
        });

        $this->validateName($nameDetails);

        $numerology = NumerologyFactory::create('pythagorean');
        $numerologyData = $numerology->getNumerologyData($nameDetails->name);

        $fancyText = new FancyTextGenerator($nameDetails->name);
        $fancyTexts = $fancyText->generate();

        $alphabets = str_split($name);
        $cacheKey = 'name_traits_for_' . implode('', $alphabets);

        $traits = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($alphabets) {
            $upperAlphabets = array_map('strtoupper', $alphabets);

            // Fetch the traits and key them by 'alphabet'
            $traitsCollection = NameTrait::whereIn('alphabet', $upperAlphabets)->get()->keyBy('alphabet');

            return collect($alphabets)->mapWithKeys(function ($alphabet) use ($traitsCollection) {
                $alphabetKey = strtoupper($alphabet);

                if (isset($traitsCollection[$alphabetKey])) {
                    return [$alphabet => $traitsCollection[$alphabetKey]->name];
                } else {
                    return [$alphabet => null];
                }
            });
        });

        $wallpaperUrl = route('nameWallpaper', $nameDetails->name);
        $signatureUrls = $this->nameSignatures($nameDetails->name);

        $data = [
            'nameDetails' => $nameDetails,
            'numerology' => $numerologyData,
            'traits' => $traits,
            'fancyTexts' => $fancyTexts,
            'wallpaperUrl' => $wallpaperUrl,
            'signatureUrls' => $signatureUrls
        ];

        return view('names.show', compact('data'));
    }

    public function getRandomNames(): View
    {
        $random = rand(1,20);
        $names = $this->getCachedData("randomNames_$random",now()->addQuarter(), function () {
            return Name::validMeaning()->random()->limit(10)->get();
        });

        return view('names.list', compact('names'));
    }

    public function search(): View
    {
        $name = request()->input('q');
        $names = $this->getCachedData("search:$name",now()->addQuarter(), function () use ($name) {
            return Name::search($name)->limit(10)->get();
        });

        return view('names.search', compact('names'));
    }


    public function nameWallpaper(string $name): Response
    {
        $base64Image = $this->generateOrRetrieveImage($name, '#ffffff','static/images/wallpaper.jpg', 'roboto/roboto-medium.ttf', 200);
        return $this->prepareImageResponse($base64Image, $name);
    }

    /**
     * Generate or retrieve multiple name-based signatures.
     *
     * @param string $name
     * @return array
     */
    private function nameSignatures(string $name): array
    {
        $fonts = [
            'cursive' => 'creattion-demo/creattion-demo.ttf',
            'allison-tessa' => 'allison-tessa/allison-tessa.ttf',
            'monsieur-la-doulaise' => 'monsieur-la-doulaise/monsieur-la-doulaise.ttf'
        ];

        $signatureUrls = [];

        foreach ($fonts as $key => $font) {
            $url = route('individualSignature',['name'=>$name,$key]);
            $signatureUrls[$key] = $url;
        }

        return $signatureUrls;
    }

    public function individualSignature(string $name, string $fontKey): Response
    {
        try {
            // Validate the provided name
            $this->validateName($name);

            $name = Name::where('slug',$name)->firstOrFail()->name;

            // Map the provided font key to its actual path
            $font = $this->mapFontKeyToPath($fontKey);
            $fontSize = $this->mapFontKeyToSize($fontKey);

            // Check if the font is valid
            if (!$font) {
                return response("Invalid font", 400)
                    ->header('Content-Type', 'text/plain');
            }

            $base64Image = $this->generateOrRetrieveImage($name, '#000000', 'static/images/signature_background.jpg', $font, $fontSize);

            return $this->prepareImageResponse($base64Image, $name);

        } catch (Exception $e) {
            // Handle any exceptions that occur
            $this->handleException("Failed to generate or retrieve signature image for $name", $e);

            return response("Internal Server Error", 500)
                ->header('Content-Type', 'text/plain');
        }
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

    private function mapFontKeyToSize(string $fontKey): ?string{
        $fonts = [
            'cursive' => 250,
            'allison-tessa' => 120,
            'monsieur-la-doulaise' => 190
        ];

        return $fonts[$fontKey] ?? null;
    }


    private function getCachedData(string $key,$time, callable $callback)
    {
        try {
            return Cache::remember($key, $time, $callback);
        } catch (Exception $e) {
            $this->handleException("Failed to fetch or cache data for $key", $e);
        }
    }

    private function generateOrRetrieveImage(string $name, string $color, string $background, string $font, int $fontSize): string
    {
        return $this->getCachedData("image:$name:$background:$font:$fontSize", now()->addQuarter(), function () use ($name, $color, $background, $font, $fontSize) {
            return $this->imageService->generateImage($name, $color, $background, $font, $fontSize);
        });
    }

    private function validateName($name): void
    {
        if (empty($name)) {
            abort(404);
        }
    }

    private function prepareImageResponse(string $base64Image, string $actualName): Response
    {
        $imageInfo = explode(',', $base64Image);
        $imageData = base64_decode($imageInfo[1]);
        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "inline; filename=\"$actualName.png\"");
    }

    private function handleException(string $message, Exception $e): void
    {
        Log::error("$message: {$e->getMessage()}");
//        abort($e instanceof ModelNotFoundException ? 404 : 500);
    }
}
