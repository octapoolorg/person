<?php

namespace App\Services\Numerology;

use App\Services\Numerology\ChaldeanNumerology;
use App\Services\Numerology\PythagoreanNumerology;

class NumerologyFactory
{
    public static function create($type): ChaldeanNumerology|PythagoreanNumerology
    {
        return match ($type) {
            'pythagorean' => new PythagoreanNumerology(),
            'chaldean' => new ChaldeanNumerology(),
            default => throw new \InvalidArgumentException("Invalid numerology type"),
        };
    }
}
