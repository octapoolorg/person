<?php

namespace App\Console\Commands\Seo;

use App\Models\Category;
use App\Models\Name;
use App\Models\Origin;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap as SpatieSitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use Wink\WinkPost;

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

            // Add Categories to Sitemap
            $this->addCategoriesToSitemap($sitemapIndex);

            // Add Names Starting With Letters to Sitemap
            $this->addAlphabeticalNamesToSitemap($sitemapIndex);

            // Add Blog Posts to Sitemap
            $this->addBlogPostsToSitemap($sitemapIndex);

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
                    usleep(200000); // 0.2 seconds delay - to not overload the server
                }

                $sitemapName = 'sitemap-' . $chunkCount . '.xml';
                $sitemap->writeToFile(public_path($sitemapName));
                $sitemapIndex->add('/' . $sitemapName);
            });
    }

    private function addOriginsToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $sitemap = SpatieSitemap::create();
        Origin::whereHas('names', function ($query) {
            $query->where('is_active', 1);
        }, '>', 30)->get()->each(function ($origin) use ($sitemap) {
            $url = route('names.origin', ['origin' => $origin->slug]);
            $sitemap->add(Url::create($url));
        });

        $sitemapName = 'sitemap-origins.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    public function addCategoriesToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $sitemap = SpatieSitemap::create();
        Category::whereHas('names', function ($query) {
            $query->where('is_active', 1);
        }, '>', 30)->get()->each(function ($category) use ($sitemap) {
            $url = route('names.category', ['category' => $category->slug]);
            $sitemap->add(Url::create($url));
        });

        $sitemapName = 'sitemap-categories.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    private function addAlphabeticalNamesToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $letters = range('a', 'z');
        $sitemap = SpatieSitemap::create();

        foreach ($letters as $letter) {
            $url = route('names.starting', ['letter' => $letter]);
            $sitemap->add(Url::create($url));
        }

        $sitemapName = 'sitemap-alphabetical.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    private function addBlogPostsToSitemap(SitemapIndex &$sitemapIndex): void
    {
        $sitemap = SpatieSitemap::create();
        $posts = WinkPost::where('published', true)->get();
        foreach ($posts as $post) {
            $url = route('blog.show', ['slug' => $post->slug]);
            $sitemap->add(Url::create($url));
        }

        $sitemapName = 'sitemap-blog.xml';
        $sitemap->writeToFile(public_path($sitemapName));
        $sitemapIndex->add('/' . $sitemapName);
    }

    private function cleanUpSitemaps(): void
    {
        File::delete(File::glob(public_path('sitemap-*.xml')));

        $this->info('Existing sitemap files cleaned up.');
    }
}
