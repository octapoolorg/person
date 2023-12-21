@extends('layouts.main')

@section('content')

    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">

        <!-- Blog Header Section -->
        <section class="bg-indigo-600 text-white py-10 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-800 dark:to-purple-900 mt-8 md:mt-20">
            <div class="container mx-auto px-6 md:px-12 xl:px-20">
                <h1 class="text-6xl font-bold text-center mb-4 leading-tight">Blog</h1>
                <p class="text-xl text-center mb-6">Latest insights and stories from our community</p>
            </div>
        </section>

        <!-- Blog Posts Section -->
        <section class="container py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach ($posts as $post)
                    <a href="{!! route('blog.show', $post->slug) !!}" class="rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-300 dark:border dark:border-slate-700 dark:hover:border-slate-500">
                        @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                            <div class="hover:opacity-90 transition-opacity duration-300">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-2 text-slate-900 dark:text-slate-100">{{ $post->title }}</h2>
                            <p class="text-slate-600 dark:text-slate-300 mb-4">{{ Str::limit($post->excerpt, 150) }}</p>
                            <div class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                                <span>By {{ $post->author->name }}</span> |
                                <span>{{ $post->publish_date->format('F j, Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>
    </section>
@endsection