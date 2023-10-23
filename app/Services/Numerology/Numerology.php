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
    protected array $letterMap = [];

    const ZODIAC_STONES = [
        'Aries' => ['Diamond'],
        'Taurus' => ['Emerald'],
        'Gemini' => ['Agate'],
        'Cancer' => ['Moonstone', 'Pearl'],
        'Leo' => ['Ruby'],
        'Virgo' => ['Sapphire'],
        'Libra' => ['Opal'],
        'Scorpio' => ['Topaz'],
        'Sagittarius' => ['Turquoise'],
        'Capricorn' => ['Garnet'],
        'Aquarius' => ['Amethyst'],
        'Pisces' => ['Aquamarine']
    ];

    const ZODIAC_COLORS = [
        'Aries' => ['Red'],
        'Taurus' => ['Green'],
        'Gemini' => ['Yellow'],
        'Cancer' => ['Silver', 'White'],
        'Leo' => ['Gold', 'Orange'],
        'Virgo' => ['Blue', 'Green'],
        'Libra' => ['Pink', 'Blue'],
        'Scorpio' => ['Black', 'Red'],
        'Sagittarius' => ['Purple', 'Blue'],
        'Capricorn' => ['Black', 'Brown'],
        'Aquarius' => ['Blue', 'Silver'],
        'Pisces' => ['Sea Green', 'Indigo']
    ];

    const ZODIAC_METALS = [
        'Aries' => ['Iron'],
        'Taurus' => ['Copper'],
        'Gemini' => ['Aluminum'],
        'Cancer' => ['Silver'],
        'Leo' => ['Gold'],
        'Virgo' => ['Mercury'],
        'Libra' => ['Copper'],
        'Scorpio' => ['Iron', 'Plutonium'],
        'Sagittarius' => ['Tin'],
        'Capricorn' => ['Lead'],
        'Aquarius' => ['Uranium'],
        'Pisces' => ['Tin', 'Neptunium']
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
            $total = array_sum(str_split((string)$total));
        }

        return $total;
    }

    public function getNumerologyData($name): array
    {
        $destinyNumber = $this->calculateNumber($name);
        $zodiacSign = $this->getZodiacSignByDestinyNumber($destinyNumber);

        return [
            'numbers' => [
                'destiny' => $destinyNumber,
                'soul' => $this->calculateNumber(preg_replace('/[^aeiou]/i', '', $name)),
                'personality' => $this->calculateNumber(preg_replace('/[aeiou]/i', '', $name))
            ],
            'zodiac' => [
                'sign' => $zodiacSign,
                'attributes' => $this->getZodiacAttributesBySign($zodiacSign)
            ],
        ];
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
            11 => 'Capricorn', // Master number
            22 => 'Aquarius',  // Master number
            33 => 'Pisces'     // Master number
        ];

        return $zodiacSigns[$destinyNumber] ?? 'Unknown';
    }

    protected function normalizeZodiacSign(string $sign): string
    {
        return ucfirst(strtolower(trim($sign)));
    }

    protected function fetchAttributeBySign(array $attributeArray, string $normalizedSign): array
    {
        return $attributeArray[$normalizedSign] ?? ['Unknown'];
    }

    protected function getZodiacAttributesBySign(string $sign): array
    {
        $normalizedSign = $this->normalizeZodiacSign($sign);

        return [
            'stone' => implode(', ', $this->fetchAttributeBySign(self::ZODIAC_STONES, $normalizedSign)),
            'color' => implode(', ', $this->fetchAttributeBySign(self::ZODIAC_COLORS, $normalizedSign)),
            'metal' => implode(', ', $this->fetchAttributeBySign(self::ZODIAC_METALS, $normalizedSign))
        ];
    }

}
