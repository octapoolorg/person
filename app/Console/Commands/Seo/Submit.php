<?php

namespace App\Console\Commands\Seo;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Submit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seo:submit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit sitemap and URLs to search engines.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Submitting to search engines...');

        $this->submitSitemapToSearchEngines();

        $this->info('Submitted to search engines.');
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
                Log::error('Failed to submit sitemap to ' . $name . ': ' . $response->body());
            }
        }
    }
}
