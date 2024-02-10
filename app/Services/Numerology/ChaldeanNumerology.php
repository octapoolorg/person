<?php

/**
 * Chaldean Numerology Class
 *
 * Implements the Chaldean numerology system, which originates from ancient Babylon.
 * It's considered one of the oldest systems of numerology with a more spiritual approach.
 * The number 9 is considered sacred in this system and is not assigned to any letter.
 *
 * This class provides methods to calculate the Destiny, Soul, and Personality Numbers
 * using the Chaldean system.
 */

namespace App\Services\Numerology;

class ChaldeanNumerology extends Numerology
{
    protected array $letterMap = [
        'a' => 1, 'i' => 1, 'j' => 1, 'q' => 1, 'y' => 1,
        'b' => 2, 'k' => 2, 'r' => 2,
        'c' => 3, 'g' => 3, 'l' => 3, 's' => 3,
        'd' => 4, 'm' => 4, 't' => 4,
        'e' => 5, 'h' => 5, 'n' => 5, 'x' => 5,
        'u' => 6, 'v' => 6, 'w' => 6,
        'o' => 7, 'z' => 7,
        'f' => 8, 'p' => 8,
    ];

    // Override the calculateNumber method for Chaldean to always reduce to a single digit
    protected function calculateNumber($name): int
    {
        $total = parent::calculateNumber($name);

        // Chaldean reduction to a single digit
        while ($total > 9) {
            $total = array_sum(str_split((string) $total));
        }

        return $total;
    }
}
