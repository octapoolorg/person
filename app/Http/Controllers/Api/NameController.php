<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Services\Name\NameService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NameController extends Controller
{
    private NameService $nameService;

    public function __construct(NameService $nameService)
    {
        $this->nameService = $nameService;
    }

    public function generateAbbreviations(): JsonResponse
    {
        $name = request()->input('name');
        $abbreviations = $this->nameService->getAbbreviations($name);
        $html = view('components.names.api.abbreviations', compact('abbreviations'))->render();

        return response()->json($html);
    }

    public function generateFancyTexts(): JsonResponse
    {
        $name = request()->input('name');
        $fancyTexts = $this->nameService->getFancyTexts($name, true);
        $html = view('components.names.api.fancy-texts', compact('fancyTexts'))->render();

        return response()->json($html);
    }

    public function generateUsernames(): JsonResponse
    {
        $name = request()->input('name');
        $userNames = $this->nameService->getUsernames($name, true);
        $html = view('components.names.api.usernames', compact('userNames'))->render();

        return response()->json($html);
    }

    public function toggleFavorite(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'slug' => 'required|string',
            ]);

            $uuid = $request->cookie('uuid');
            $slug = $validated['slug'];

            $favorite = Favorite::where('uuid', $uuid)->where('slug', $slug)->first();

            $isFavorited = false;
            if ($favorite) {
                $favorite->delete();
            } else {
                Favorite::create(['uuid' => $uuid, 'slug' => $slug]);
                $isFavorited = true;
            }

            cache()->forget("favorites:$uuid");
            $favorites = cache_remember("favorites:$uuid", function () use ($uuid) {
                return Favorite::where('uuid', $uuid)->pluck('slug');
            });

            return response()->json([
                'isFavorited' => $isFavorited,
                'favorites' => $favorites->toArray(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => 'Something went wrong, please try again later.'], 500);
        }
    }
}
