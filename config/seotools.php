<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults' => [
            'title' => 'iDenteez', // set false to total remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => 'Search baby names, meanings, origins, numerology and more.', // set false to total remove
            'separator' => ' - ',
            'keywords' => ['baby names', 'astrology', 'zodiac', 'numerology', 'name meanings', 'name origins'],
            'canonical' => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots' => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google' => null,
            'bing' => null,
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
            'norton' => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title' => 'iDenteez', // set false to total remove
            'description' => 'Search baby names, meanings, origins, numerology and more.', // set false to total remove
            'url' => null, // Set null for using Url::current(), set false to total remove
            'type' => false,
            'site_name' => false,
            'images' => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card' => 'summary',
            'site' => '@iDenteez',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title' => 'iDenteez', // set false to total remove
            'description' => 'Search baby names, meanings, origins, numerology and more.', // set false to total remove
            'url' => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type' => 'WebPage',
            'images' => [],
        ],
    ],
];
