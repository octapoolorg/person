<?php

namespace App\Services\Tools;

use Illuminate\Support\Collection;

class FancyTextService
{
    private array $custom;
    private array $emoji;

    public function __construct()
    {
        $this->custom = config('name.fancy-text.custom');
        $this->emoji  = config('name.fancy-text.emoji');
    }

    /**
     * Generate a list of random emoji styles for a given name.
     *
     * @param string $name The name to stylize.
     * @param int $count The number of styles to generate.
     * @return Collection A collection of styled names with emojis.
     */
    public function generateEmojiStyles(string $name, int $count = 5): Collection
    {
        return collect($this->emoji)
            ->shuffle()
            ->take($count)
            ->map(fn($emoji) => $this->generateEmojiStyle($name, $emoji));
    }

    /**
     * Generate a styled string with emojis around and within the given name.
     *
     * @param string $name The name to stylize.
     * @param string $emoji The emoji to use in the styling.
     * @return string The styled name.
     */
    public function generateEmojiStyle(string $name, string $emoji): string
    {
        $spacedName = implode($emoji, str_split(strtoupper($name)));
        return "{$emoji}{$spacedName}{$emoji}";
    }

     /**
     * Generate a specified number of custom styles for the name.
     *
     * @param string $name The name to apply custom styles to.
     * @param int $stylesCount The number of custom styles to generate.
     * @return Collection A collection of custom-styled names.
     */
    private function generateCustomStyles(string $name, int $stylesCount): Collection
    {
        $styleKeys = collect($this->custom)
            ->keys()
            ->shuffle()
            ->take($stylesCount);

        return $styleKeys->mapWithKeys(function ($styleName) use ($name) {
            // Apply each selected style to the name
            return [$styleName => $this->applyStyle($name, $this->custom[$styleName])];
        });
    }


    /**
     * Apply a predefined style to the name.
     *
     * @param string $name The name to style.
     * @param array $style The style mapping.
     * @return string The styled name.
     */
    private function applyStyle($name, $style): string
    {
        $lowercase_style = collect($style)->mapWithKeys(function ($value, $key) {
            return [strtolower($key) => $value];
        });

        return collect(str_split(strtolower($name)))
            ->map(fn($char) => $lowercase_style->get($char, $char))
            ->implode('');
    }

    /**
     * Generate a collection of styled names using both emoji and custom styles.
     *
     * @param string $name The name to stylize.
     * @param int $stylesCount The total number of styles to generate.
     * @return Collection A collection of styled names.
     */
    public function generate(string $name, int $stylesCount = 10): Collection
    {
        $name = normalize_name($name);

        $emojiStylesCount = 3;
        $customStylesCount = $stylesCount - $emojiStylesCount;

        // Generate both emoji and custom styles
        $emojiStyles = $this->generateEmojiStyles($name, $emojiStylesCount);
        $customStyles = $this->generateCustomStyles($name, $customStylesCount);

        // Combine and shuffle the resulting styles
        return $emojiStyles->merge($customStyles)->shuffle();
    }
}
