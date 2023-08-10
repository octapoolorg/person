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

    public function getNumerologyData($name)
    {
        return [
            'numbers' => [
                'destiny' => $this->calculateNumber($name),
                'soul' => $this->calculateNumber(preg_replace('/[^aeiou]/i', '', $name)),
                'personality' => $this->calculateNumber(preg_replace('/[aeiou]/i', '', $name))
            ],
            'zodiac' => [
                'sign' => $this->getZodiacSignByDestinyNumber($this->calculateNumber($name))
            ],
        ];
    }

    protected function getZodiacSignByDestinyNumber($destinyNumber)
    {
        $zodiacSigns = [
            1 => 'Aries',
            2 => 'Taurus',
            3 => 'Gemini',
            4 => 'Cancer',
            5 => 'Leo',
            6 => 'Virgo',
            7 => 'Libra',
            8 => 'Scorpio',
            9 => 'Sagittarius',
            11 => 'Capricorn', // Master number
            22 => 'Aquarius',  // Master number
            33 => 'Pisces'    // Master number
        ];

        return $zodiacSigns[$destinyNumber] ?? 'Unknown';
    }
}
