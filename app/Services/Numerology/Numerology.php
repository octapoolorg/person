<?php

/**
 * Numerology Base Class
 * 
 * Provides foundational methods and structures for calculating numerological numbers.
 * This abstract class serves as the base for specific numerology systems and defines
 * common functionalities such as calculating Destiny, Soul, and Personality Numbers.
 * 
 * @package App\Services\Numerology
 */

namespace App\Services\Numerology;

abstract class Numerology implements INumerology
{
    protected $letterMap = [];

    protected function calculateNumber($name)
    {
        $total = 0;
        $name = strtolower($name);

        for ($i = 0; $i < strlen($name); $i++) {
            $letter = $name[$i];
            if (isset($this->letterMap[$letter])) {
                $total += $this->letterMap[$letter];
            }
        }

        // Pythagorean reduction (with exceptions for master numbers)
        while ($total > 9 && $total != 11 && $total != 22 && $total != 33) {
            $total = array_sum(str_split((string)$total));
        }

        return $total;
    }

    public function getNumerologyNumbers($name)
    {
        return [
            'destiny' => $this->calculateNumber($name),
            'soul' => $this->calculateNumber(preg_replace('/[^aeiou]/i', '', $name)),
            'personality' => $this->calculateNumber(preg_replace('/[aeiou]/i', '', $name))
        ];
    }
}
