<?php

namespace App\Console\Commands\Seo;

use Google\Exception;
use Google_Client;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Urls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seo:urls {urls*}';

    //TODO - Test this command with a list of URLs and make sure it works as expected.

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit a list of URLs to Google and Bing for indexing.';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle() : void
    {
        $urls = $this->argument('urls');

        if (empty($urls)) {
            $this->error('No URLs provided.');
            return;
        }

        $this->submitToGoogle($urls);
        $this->submitToBing($urls);
    }

    /**
     * @throws Exception
     */
    private function submitToGoogle(array $urls): void
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path('config/credentials/identeez-09a7ad89985c.json'));
        $client->addScope(Google_Service_Indexing::INDEXING);

        $indexingService = new Google_Service_Indexing($client);

        foreach ($urls as $url) {
            $notification = new Google_Service_Indexing_UrlNotification();
            $notification->setUrl($url);
            $notification->setType('URL_CREATED');

            try {
                $response = $indexingService->urlNotifications->publish($notification);
                $this->info("Google: Submitted URL: $url");
            } catch (\Exception $e) {
                $this->error("Google: Error submitting URL: $url. Error: " . $e->getMessage());
            }
        }
    }

    private function submitToBing(array $urls): void
    {
        $apiKey = '0159e8b6982b43f19cdfbb8ada7d0b35';
        $siteUrl = 'https://identeez.com/';
        $endpoint = "https://ssl.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey=$apiKey";

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($endpoint, [
                'siteUrl' => $siteUrl,
                'urlList' => $urls
            ]);

        if ($response->successful()) {
            $this->info("Bing: URLs submitted successfully.");
        } else {
            $this->error("Bing: Failed to submit URLs. Error: " . $response->body());
        }
    }
}
