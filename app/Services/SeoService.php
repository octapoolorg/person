<?php

namespace App\Services;

use Artesaos\SEOTools\SEOTools;

class SeoService
{
    public function getSeoData(array $meta, array $replace = []): object
    {
        $seoData = $this->getData($meta['page'], $replace);

        $seoTools = new SEOTools();

        $seoTools->setTitle($seoData['title']);
        $seoTools->setDescription($seoData['description']);
        $seoTools->opengraph()->setType($seoData['type']);

        if (isset($meta['image'])) {
            $seoTools->addImages($meta['image']);
        }

        return (object) $seoData;
    }

    private function getData($page, $replace): array
    {
        $seoData = [
            'type' => 'website',
        ];

        $seoData['title'] = __("seo.{$page}.title", $replace);
        $seoData['description'] = __("seo.{$page}.description", $replace);

        return $seoData;
    }
}
