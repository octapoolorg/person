<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Wink\WinkPage;
use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    public function show($page): View
    {
        $page = WinkPage::where('slug', $page)->firstOrFail();
        $this->seoTags($page);
        return view('pages.show', compact('page'));
    }

    public function seoTags($page)
    {
        SEOTools::setTitle($page->title);
        SEOTools::setDescription($page->title);
    }
}
