<?php

namespace App\Services\Name;

use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextService;
use Illuminate\Support\Collection;

class ToolService
{
    private FancyTextService $fancyTextService;
    private UsernameService  $usernameService;

    public function __construct(FancyTextService $fancyTextService, UsernameService $usernameService)
    {
        $this->fancyTextService = $fancyTextService;
        $this->usernameService  = $usernameService;
    }

    public function getFancyTexts(string $name, bool $random = false): Collection
    {
        $randomness = $random ? rand(1, 15) : 1;

        return cache_remember("fancyTexts:$name:$randomness", function () use ($name) {
            return $this->fancyTextService->generate($name);
        });
    }

    public function getUsernames(string $name): Collection
    {
        $randomness = rand(1, 15);

        return cache_remember("usernames:$name:$randomness", function () use ($name) {
            return $this->usernameService->generateUsernames($name);
        });
    }

    public function getNumerology(string $name): array
    {
        return cache_remember("numerology:$name", function () use ($name) {
            return NumerologyFactory::create()->getAnalysis($name);
        });
    }
}