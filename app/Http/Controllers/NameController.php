<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Exception;

class NameController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function view($name): View
    {
        try {
            $cacheKey = "nameDetails:$name";
            $nameDetails = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($name) {
                return Name::with(['gender', 'origin', 'categories'])
                    ->where('slug', $name)
                    ->firstOrFail();
            });

            $numerology = NumerologyFactory::create('pythagorean');
            $numerologyData = $numerology->getNumerologyData($nameDetails->name);

            $fancyText = new FancyTextGenerator($nameDetails->name);
            $fancyTexts = $fancyText->generate();

            $data = [
                'nameDetails' => $nameDetails,
                'numerology' => $numerologyData,
                'fancyTexts' => $fancyTexts
            ];

        } catch (Exception $e) {
            Log::error("Failed to fetch name details: {$e->getMessage()}");
            abort(404);
        }

        return view('names.view', compact('data'));
    }

    public function nameWallpaper($name): Response
    {
        // Validate input
        if (empty($name) || !is_string($name)) {
            abort(404);
        }

        try {
            // Fetch the actual name associated with the slug from the database
            $nameDetails = Name::where('slug', $name)->firstOrFail();
            $actualName = $nameDetails->name;

        } catch (Exception $e) {
            Log::error("Failed to fetch actual name: {$e->getMessage()}");
            abort(404);
        }

        try {
            // Generate or retrieve the image
            $base64Image = $this->generateOrRetrieveImage($actualName);

        } catch (Exception $e) {
            Log::error("Failed to generate or retrieve image: {$e->getMessage()}");
            abort(500);
        }

        $imageInfo = explode(',', $base64Image);
        $imageData = base64_decode($imageInfo[1]);

        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', "inline; filename=\"$actualName.png\"");
    }

    private function generateOrRetrieveImage($name)
    {
        $cacheKey = "nameWallpaper:$name";
        $base64Image = Cache::get($cacheKey);

        if (!$base64Image) {
            $base64Image = $this->generateImage($name);
            Cache::put($cacheKey, $base64Image, now()->addMinutes(60));
        }

        return $base64Image;
    }

    private function generateImage($name): string
    {
        $img = Image::make(public_path('static/images/wallpaper.png'));

        $imgWidth = $img->width();
        $imgHeight = $img->height();

        $fontSize = 100;

        $xPosition = $imgWidth / 2;
        $yPosition = $imgHeight / 2;

        $img->text($name, $xPosition, $yPosition, function ($font) use ($fontSize) {
            $font->file(public_path('static/fonts/roboto/roboto-medium.ttf'));
            $font->size($fontSize);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });

        return (string) $img->encode('data-url');
    }
}
