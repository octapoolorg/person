<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Services\Tools\FancyTextService;
use App\Services\Name\UsernameGeneratorService;


class UtilityService
{
    protected UsernameGeneratorService $usernameGeneratorService;
    protected ImageService $imageService;

    public function __construct(UsernameGeneratorService $usernameGeneratorService, ImageService $imageService)
    {
        $this->usernameGeneratorService = $usernameGeneratorService;
        $this->imageService = $imageService;
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

    public function wallpaperUrls(string $name): array
    {
        return $this->imageService->nameWallpapers($name);
    }

    public function signatureUrls(string $name): array
    {
        return $this->imageService->nameSignatures($name);
    }
}