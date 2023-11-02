<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\ImageService;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NameController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): View
    {
        return view('welcome');
    }

    public function view(string $name): View
    {
        $nameDetails = $this->getCachedData("nameDetails:$name", function () use ($name) {
            return Name::with(['gender', 'origin', 'categories'])->where('slug', $name)->firstOrFail();
        });

        $numerology = NumerologyFactory::create('pythagorean');
        $numerologyData = $numerology->getNumerologyData($nameDetails->name);

        $fancyText = new FancyTextGenerator($nameDetails->name);
        $fancyTexts = $fancyText->generate();

        $signatureUrls = $this->nameSignatures($name);

        $data = [
            'nameDetails' => $nameDetails,
            'numerology' => $numerologyData,
            'fancyTexts' => $fancyTexts,
            'signatureUrls' => $signatureUrls
        ];

        return view('names.view', compact('data'));
    }

    public function nameWallpaper(string $name): Response
    {
        $this->validateName($name);
        $name = Name::where('slug',$name)->first()->name;
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
        $this->validateName($name);
        $name = Name::where('slug',$name)->first()->slug;

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

            $name = Name::where('slug',$name)->first()->name;

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

    public function getRandomNames(): mixed
    {
        return $this->getCachedData("randomNames", function () {
            return Name::inRandomOrder()->limit(5)->get();
        });
    }

    private function getCachedData(string $key, callable $callback)
    {
        try {
            return Cache::remember($key, now()->addQuarter(), $callback);
        } catch (Exception $e) {
            $this->handleException("Failed to fetch or cache data for $key", $e);
        }
    }

    private function generateOrRetrieveImage(string $name, string $color, string $background, string $font, int $fontSize): string
    {
        return $this->getCachedData("image:$name:$background:$font:$fontSize", function () use ($name, $color, $background, $font, $fontSize) {
            return $this->imageService->generateImage($name, $color, $background, $font, $fontSize);
        });
    }

    private function validateName(string $name): void
    {
        if (empty($name) || !is_string($name)) {
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
