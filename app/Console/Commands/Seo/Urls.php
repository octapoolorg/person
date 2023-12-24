<?php

namespace App\Console\Commands\Seo;

use Famdirksen\LaravelGoogleIndexing\LaravelGoogleIndexing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Urls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seo:urls {urls*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit URLs to Google for indexing';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $urls = $this->argument('urls');

        $pendingUrls = $this->getUrlsFromCsv('pending-urls.csv');

        $urls = array_merge($urls, $pendingUrls);

        if(!empty($urls)) {
            $this->info('Submitting URLs to Google for indexing...');
            $this->submit($urls);
            $this->info('Done!');
            return 0;
        }

        $this->error('No URLs provided for indexing.');
        return 1;
    }

    /**
     * Submit URLs to Google for indexing.
     *
     * @param array $urls
     */
    protected function submit(array $urls): void
    {
        foreach ($urls as $url) {
            try {
                $this->info('Submitting ' . $url);
                $this->submitUrl($url);
                Log::info('URL submitted successfully: ' . $url);
            } catch (\Exception $e) {
                $this->error('Failed to submit URL: ' . $url);
                Log::error('Failed to submit URL: ' . $url . '. Error: ' . $e->getMessage());
            }
        }
    }

    private function getUrlsFromCsv(string $path): array
    {
        // Read the CSV file
        $csvData = Storage::get($path);

        // Convert CSV data to an array
        $urls = array_map('str_getcsv', explode("\n", $csvData));

        // Convert the array to a collection
        $collection = collect($urls);

        // Get the first 150 URLs and remove them from the collection
        $first150Urls = $collection->splice(0, rand(140, 150));

        // Convert the remaining collection back to CSV format
        $remainingCsvData = $collection->implode("\n");

        // Write the remaining CSV data back to the file
        Storage::put($path, $remainingCsvData);

        // Return the first 150 URLs as an array
        return $first150Urls->toArray();
    }

    /**
     * Submit a URL to Google for indexing.
     *
     * @param string $url
     */
    protected function submitUrl(string $url): void
    {
        LaravelGoogleIndexing::create()->update($url);
    }
}