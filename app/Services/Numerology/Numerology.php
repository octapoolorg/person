<?php

/**
 * Numerology Base Class
 *
 * Provides foundational methods and structures for calculating numerological numbers.
 * This abstract class serves as the base for specific numerology systems and defines
 * common functionalities such as calculating Destiny, Soul, and Personality Numbers.
 */

namespace App\Services\Numerology;

abstract class Numerology implements INumerology
{
    protected array $letterMap = [];

    const ZODIAC_STONES = [
        'Aries' => 'Bloodstone',
        'Taurus' => 'Sapphire',
        'Gemini' => 'Agate',
        'Cancer' => 'Emerald',
        'Leo' => 'Onyx',
        'Virgo' => 'Carnelian',
        'Libra' => 'Chrysolite',
        'Scorpio' => 'Beryl',
        'Sagittarius' => 'Citrine',
        'Capricorn' => 'Ruby',
        'Aquarius' => 'Garnet',
        'Pisces' => 'Amethyst',
    ];

    const ZODIAC_COLORS = [
        'Aries' => 'Red',
        'Taurus' => 'Green',
        'Gemini' => 'Yellow',
        'Cancer' => 'Silver',
        'Leo' => 'Gold',
        'Virgo' => 'Blue',
        'Libra' => 'Pink',
        'Scorpio' => 'Black',
        'Sagittarius' => 'Purple',
        'Capricorn' => 'Black',
        'Aquarius' => 'Blue',
        'Pisces' => 'Sea Green',
    ];

    const ZODIAC_METALS = [
        'Aries' => 'Iron',
        'Taurus' => 'Copper',
        'Gemini' => 'Aluminum',
        'Cancer' => 'Silver',
        'Leo' => 'Gold',
        'Virgo' => 'Mercury',
        'Libra' => 'Copper',
        'Scorpio' => 'Iron',
        'Sagittarius' => 'Tin',
        'Capricorn' => 'Lead',
        'Aquarius' => 'Uranium',
        'Pisces' => 'Tin',
    ];

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
            $total = array_sum(str_split((string) $total));
        }

        return $total;
    }

    protected function calculateLifePathNumber($dob): int
    {
        // Assuming $dob format is YYYY-MM-DD
        $digits = str_replace('-', '', $dob);

        return $this->reduceToSingleDigit($digits);
    }

    protected function calculateBirthdayNumber($dob): int
    {
        $day = (int) substr($dob, 8, 2);

        return $this->reduceToSingleDigit($day);
    }

    protected function reduceToSingleDigit($number): int
    {
        while ($number > 9) {
            $number = array_sum(str_split((string) $number));
        }

        return $number;
    }

    public function getNumerologyData($name, $dob = null): array
    {
        $name = normalize_name($name);
        $destinyNumber = $this->calculateNumber($name);
        $lifePathNumber = $dob ? $this->calculateLifePathNumber($dob) : null;
        $birthdayNumber = $dob ? $this->calculateBirthdayNumber($dob) : null;
        $maturityNumber = $dob ? $this->reduceToSingleDigit($destinyNumber + $lifePathNumber) : null;
        $zodiacSign = $destinyNumber ? $this->getZodiacSignByDestinyNumber($destinyNumber) : null;

        $result = [
            'numbers' => [
                'destiny' => $destinyNumber,
                'soul_urge' => $this->calculateNumber(preg_replace('/[^aeiou]/i', '', $name)),
                'personality' => $this->calculateNumber(preg_replace('/[aeiou]/i', '', $name)),
            ],
            'zodiac' => [
                'sign' => $zodiacSign,
                'attributes' => $this->getZodiacAttributesBySign($zodiacSign),
            ],
        ];

        if ($dob) {
            $result['numbers']['life_path'] = $lifePathNumber;
            $result['numbers']['birthday'] = $birthdayNumber;
            $result['numbers']['maturity'] = $maturityNumber;
        }

        return $result;
    }

    protected function getZodiacSignByDestinyNumber(int $destinyNumber): string
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
            11 => 'Capricorn',
            22 => 'Aquarius',
            33 => 'Pisces',
        ];

        return $zodiacSigns[$destinyNumber];
    }

    protected function normalizeZodiacSign(string $sign): string
    {
        return ucfirst(strtolower(trim($sign)));
    }

    protected function fetchAttributeBySign(array $attributeArray, string $normalizedSign): string
    {
        return $attributeArray[$normalizedSign];
    }

    protected function getZodiacAttributesBySign(string $sign): array
    {
        $normalizedSign = $this->normalizeZodiacSign($sign);

        $stone = $this->fetchAttributeBySign(self::ZODIAC_STONES, $normalizedSign);
        $color = $this->fetchAttributeBySign(self::ZODIAC_COLORS, $normalizedSign);
        $metal = $this->fetchAttributeBySign(self::ZODIAC_METALS, $normalizedSign);

        return [
            'stone' => $stone,
            'color' => $color,
            'metal' => $metal,
        ];
    }
}
