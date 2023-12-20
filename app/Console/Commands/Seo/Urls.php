<?php

namespace App\Console\Commands\Seo;

use Famdirksen\LaravelGoogleIndexing\LaravelGoogleIndexing;
use Illuminate\Console\Command;

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

            return 1;
        }

        return 0;

    }

    /**
     * Submit URLs to Google for indexing.
     *
     * @param array $urls
     */
    protected function submit(array $urls): void
    {

        foreach ($urls as $url) {
            $this->info('Submitting ' . $url);

            $this->submitUrl($url);
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
