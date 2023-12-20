<?php

namespace App\Console\Commands\Seo;

use Famdirksen\LaravelGoogleIndexing\LaravelGoogleIndexing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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