@extends('layouts.main')

@section('content')

    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">

        <!-- Blog Header Section -->
        <section class="bg-primary-600 text-surface py-10 bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-800 dark:to-primary-900 mt-8 md:mt-20">
            <div class="container mx-auto px-6 md:px-12 xl:px-20">
                <h1 class="text-6xl font-bold text-center mb-4 leading-tight">Blog</h1>
                <p class="text-xl text-center mb-6">Latest insights and stories from our community</p>
            </div>
        </section>

        <!-- Blog Posts Section -->
        <section class="container py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach ($posts as $post)
                    <a href="{!! route('blog.show', $post->slug) !!}" class="rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-300 dark:border dark:border-base-700 dark:hover:border-base-500">
                        @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                            <div class="hover:opacity-90 transition-opacity duration-300">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-2 text-base-900 dark:text-base-100">{{ $post->title }}</h2>
                            <p class="text-base-600 dark:text-base-300 mb-4">{{ Str::limit($post->excerpt, 150) }}</p>
                            <div class="text-base-500 dark:text-base-400 text-xs font-semibold">
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