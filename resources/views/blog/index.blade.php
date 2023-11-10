@extends('layouts.main')

@section('content')

    <!-- Blog Header Section -->
    <section class="bg-indigo-600 text-white py-10 bg-gradient-to-r from-indigo-500 to-purple-600">
        <div class="container mx-auto px-6 md:px-12 xl:px-20">
            <h1 class="text-6xl font-bold text-center mb-4 leading-tight">Blog</h1>
            <p class="text-xl text-center mb-6">Latest insights and stories from our community</p>
            <!-- Optional navigation menu here -->
        </div>
    </section>


    <!-- Blog Posts Section -->
    <section class="container py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach ($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <a href="{!! route('blog.show', $post->slug) !!}" class="hover:opacity-90 transition-opacity duration-300">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-6">
                        <a href="{!! route('blog.show', $post->slug) !!}" class="hover:text-indigo-600 transition-colors duration-300">
                            <h2 class="text-2xl font-semibold mb-2">{{ $post->title }}</h2>
                        </a>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 150) }}</p>
                        <div class="text-gray-500 text-xs font-semibold">
                            <span>By {{ $post->author->name }}</span> |
                            <span>{{ $post->publish_date->format('F j, Y') }}</span>
                        </div>
                        <a href="{!! route('blog.show', $post->slug) !!}" class="text-indigo-600 hover:underline">Read more</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
