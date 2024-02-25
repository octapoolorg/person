<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Guest;
use App\Services\Name\NameService;
use Exception;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            $slug = e($validated['slug']);

            $guest = Guest::query()->firstOrCreate([
                'uuid' => $uuid,
            ], [
                'ip_address' => $request->ip(),
            ]);

            $guest->hash = Hashids::encode($guest->id);
            $guest->save();

            $favorite = Favorite::query()->firstOrCreate([
                'slug' => $slug, 'guest_id' => $guest->id
            ]);

            if ($favorite->wasRecentlyCreated) {
                $isFavorited = true;
            } else {
                $favorite->delete();
                $isFavorited = false;
            }

            $favorites = Favorite::where('guest_id', $guest->id)->pluck('slug')->toArray();

            return response()->json([
                'isFavorited' => $isFavorited,
                'favorites' => $favorites,
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return response()->json(['error' => 'Something went wrong, please try again later.'], 500);
        }
    }
}
