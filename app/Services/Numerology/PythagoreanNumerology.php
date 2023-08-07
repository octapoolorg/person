<?php

/**
 * Pythagorean Numerology Class
 * 
 * Implements the Pythagorean numerology system, which is widely used in the Western world.
 * In this system, each letter of the alphabet is assigned a number from 1 to 9 based on 
 * the teachings of the Greek philosopher Pythagoras.
 * 
 * This class provides methods to calculate the Destiny, Soul, and Personality Numbers
 * using the Pythagorean system.
 * 
 * @package App\Services\Numerology
 */

namespace App\Services\Numerology;

class PythagoreanNumerology extends Numerology
{
    protected $letterMap = [
        'a' => 1, 'j' => 1, 's' => 1,
        'b' => 2, 'k' => 2, 't' => 2,
        'c' => 3, 'l' => 3, 'u' => 3,
        'd' => 4, 'm' => 4, 'v' => 4,
        'e' => 5, 'n' => 5, 'w' => 5,
        'f' => 6, 'o' => 6, 'x' => 6,
        'g' => 7, 'p' => 7, 'y' => 7,
        'h' => 8, 'q' => 8, 'z' => 8,
        'i' => 9, 'r' => 9
    ];
}
