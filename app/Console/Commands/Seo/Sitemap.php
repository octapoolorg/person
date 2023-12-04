<?php

namespace App\Console\Commands\Seo;

use App\Models\Name;
use App\Models\Origin; // Assuming you have an Origin model
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap as SpatieSitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class Sitemap extends Command
{
    protected $signature = 'app:seo:sitemap';
    protected $description = 'Generate and submit sitemap to search engines';

    public function handle(): void
    {
        try {
            $this->cleanUpSitemaps();

            $sitemapIndex = SitemapIndex::create();
            $chunkSize = 50000;

            // Add Names to Sitemap
            $this->addNamesToSitemap($sitemapIndex, $chunkSize);

            // Add Origins to Sitemap
            $this->addOriginsToSitemap($sitemapIndex);

            // Add Names Starting With Letters to Sitemap
            $this->addAlphabeticalNamesToSitemap($sitemapIndex);

            // Write Sitemap Index File
            $sitemapIndexPath = public_path('sitemap_index.xml');
            $sitemapIndex->writeToFile($sitemapIndexPath);
            $this->info('Sitemap generated successfully.');

        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Sitemap generation error: ' . $e->getMessage());
        }
    }

    private function addNamesToSitemap(SitemapIndex &$sitemapIndex, $chunkSize): void
    {
        $chunkCount = 0;
        Name::query()
            ->select(['id', 'slug'])
            ->chunk($chunkSize, function ($names) use (&$sitemapIndex, &$chunkCount) {
                $chunkCount++;
                $sitemap = SpatieSitemap::create();

                foreach ($names as $name) {
                    $url = route('names.show', ['name' => $name->slug]);
                    $sitemap->add(Url::create($url));
                }

                $sitemapName = 'sitemap-names-' . $chunkCount . '.xml';
                $sitemap->writeToFile(public_path($sitemapName));
                $sitemapIndex->add('/' . $sitemapName);
            });
    }

    private function addOriginsToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $sitemap = SpatieSitemap::create();
        Origin::all()->each(function ($origin) use ($sitemap) {
            $url = route('names.origin', ['origin' => $origin->slug]);
            $sitemap->add(Url::create($url));
        });

        $sitemapName = 'sitemap-origins.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    private function addAlphabeticalNamesToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $letters = range('A', 'Z');
        $sitemap = SpatieSitemap::create();

        foreach ($letters as $letter) {
            $url = route('names.starting', ['letter' => $letter]);
            $sitemap->add(Url::create($url));
        }

        $sitemapName = 'sitemap-alphabetical.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    private function cleanUpSitemaps(): void
    {
        $files = File::glob(public_path('sitemap-*.xml'));
        foreach ($files as $file) {
            $this->info('Deleting ' . $file);
            File::delete($file);
        }

        $this->info('Existing sitemap files cleaned up.');
    }
}
