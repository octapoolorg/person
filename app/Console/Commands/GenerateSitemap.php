<?php

namespace App\Console\Commands;

use App\Models\Name;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Http;

class GenerateSitemap extends Command
{
    protected $signature = 'app:generate-sitemap';
    protected $description = 'Generate and submit sitemap to search engines';

    public function handle(): void
    {
        try {
            $sitemapIndex = SitemapIndex::create();

            $chunkSize = 50000;
            $chunkCount = 0;

            Name::query()
                ->select(['id', 'slug'])
                ->chunk($chunkSize, function ($names) use (&$sitemapIndex, &$chunkCount) {
                    $chunkCount++;
                    $sitemap = Sitemap::create();

                    foreach ($names as $name) {
                        $url = route('names.show', ['name' => $name->slug]);
                        $sitemap->add(Url::create($url));
                    }

                    // Static sitemap name based on chunk count
                    $sitemapName = 'sitemap-' . $chunkCount . '.xml';
                    $sitemap->writeToFile(public_path($sitemapName));

                    $sitemapIndex->add('/' . $sitemapName);
                });

            $sitemapIndexPath = public_path('sitemap_index.xml');
            $sitemapIndex->writeToFile($sitemapIndexPath);
            $this->info('Sitemap generated successfully.');

            // Submit to search engines
            $this->submitSitemapToSearchEngines();

        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Sitemap generation error: ' . $e->getMessage());
        }
    }

    private function submitSitemapToSearchEngines(): void
    {
        $sitemapUrl = url('sitemap_index.xml');
        $searchEngines = [
            'google' => 'https://www.google.com/ping?sitemap=' . $sitemapUrl,
        ];

        foreach ($searchEngines as $name => $submissionUrl) {
            $response = Http::get($submissionUrl);

            if ($response->successful()) {
                $this->info('Sitemap submitted to ' . $name . ' successfully.');
            } else {
                $this->error('Failed to submit sitemap to ' . $name . '.');
                Log::error('Failed to submit sitemap to ' . $name . ': ' . $response->body());
            }
        }
    }
}
