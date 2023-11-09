<?php

namespace App\Http\Controllers;

use Wink\WinkPost;

class BlogController extends Controller
{
    public function show(string $slug)
    {
        $post = WinkPost::with('tags')->where('slug', $slug)->firstOrFail();

        $relatedPosts = WinkPost::with('tags')
            ->live()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', function ($query) use ($post) {
                $query->whereIn('id', $post->tags->pluck('id'));
            })
            ->orderBy('publish_date', 'desc')
            ->take(3)
            ->get();

        return view('blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts
        ]);
    }

}
