<?php

namespace App\Services\Numerology;

use App\Services\Numerology\ChaldeanNumerology;
use App\Services\Numerology\PythagoreanNumerology;

class NumerologyFactory
{
    public static function create($type)
    {
        switch ($type) {
            case 'pythagorean':
                return new PythagoreanNumerology();
            case 'chaldean':
                return new ChaldeanNumerology();
            default:
                throw new \InvalidArgumentException("Invalid numerology type");
        }
    }
}
