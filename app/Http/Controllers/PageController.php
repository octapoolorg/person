<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Wink\WinkPage;

class PageController extends Controller
{
    public function show($page): View
    {
        $page = WinkPage::where('slug', $page)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
