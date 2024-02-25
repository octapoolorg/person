<?php

namespace App\Services\Numerology;

/**
 * Numerology Interface
 *
 * Defines the contract for numerology services.
 */
interface INumerology
{
    public function getAnalysis(string $name, string $dob): array;
}
