<?php

namespace App\Console\Commands\Seo;

use Famdirksen\LaravelGoogleIndexing\LaravelGoogleIndexing;
use Ymigval\LaravelIndexnow\Facade\IndexNow;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Command to submit URLs to Google for indexing.
 */
class Urls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seo:urls {urls?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit URLs to Google for indexing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $urls = $this->argument('urls') ?? [];
        $pendingUrls = $this->getUrlsFromCsv(base_path('imports/seo/not-indexed.csv'));
        $urls = array_merge($urls, $pendingUrls);

        if (empty($urls)) {
            $this->error('No URLs provided for indexing.');
            return 1;
        }

        $this->info('Submitting URLs to Google for indexing...');
        $this->submit($urls);
        $this->info('Done!');
        return 0;
    }

    /**
     * Submit a batch of URLs for indexing.
     *
     * @param array $urls Array of URLs to submit.
     *
     * @return void
     */
    protected function submit(array $urls): void
    {
        foreach ($urls as $url) {
            try {
                $this->info("Submitting $url");
                $this->submitUrl($url);
                Log::info("URL submitted successfully: $url");
            } catch (\Exception $e) {
                $this->error("Failed to submit URL: $url");
                Log::error("Failed to submit URL: $url. Error: " . $e->getMessage());
            }
        }

        $this->submitUrlsToIndexNow($urls);
    }

    /**
     * Retrieves URLs from a CSV file.
     *
     * @param string $path Path to the CSV file.
     *
     * @return array Array of URLs.
     */
    private function getUrlsFromCsv(string $path): array
    {
        if (!file_exists($path)) {
            Log::error("CSV file not found at $path");
            return [];
        }

        $csvData = file_get_contents($path);
        $lines = explode("\n", $csvData);
        array_shift($lines);

        $urls = array_map(function ($line) {
            return str_getcsv($line)[0] ?? null;
        }, $lines);

        $urls = array_filter($urls);
        $urls = array_slice($urls, 0, rand(130, 140));

        // Update the CSV file with the remaining URLs
        $remainingLines = array_slice($lines, count($urls));
        file_put_contents($path, implode("\n", $remainingLines));

        return $urls;
    }

    /**
     * Submits a single URL to Google for indexing.
     *
     * @param string $url The URL to submit.
     *
     * @return void
     */
    protected function submitUrl(string $url): void
    {
        LaravelGoogleIndexing::create()->update($url);
    }

    protected function submitUrlsToIndexNow(array $urls): void
    {
        IndexNow::submit($urls);
    }
}