<?php

namespace App\Console\Commands\Seo;

use Illuminate\Console\Command;

class Submit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seo:submit {urls*}';

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
        $this->info('Submitting sitemap and URLs to search engines...');

        $urls = $this->argument('urls') ?? [];

        $this->call('app:seo:sitemap');
        $this->call('app:seo:urls', ['urls' => $urls]);

        $this->info('Sitemap and URLs submitted successfully.');
    }
}
