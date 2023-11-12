@extends('layouts.main')

@section('content')

    <!-- Hero Section with Image Background and Overlay -->
    <section class="relative bg-cover bg-center py-32 md:mt-20" style="background-image: url({{ asset('static/images/hero-bg.png') }});">
        <div class="absolute inset-0 bg-indigo-800 opacity-90"></div>
        <div class="container mx-auto px-6 md:px-12 xl:px-20 relative">
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-6xl font-extrabold mb-6 leading-tight">Uncover the Meaning of Names</h1>
                <p class="text-xl mb-8">Join millions in the quest for names' history, culture, and significance.</p>
                <div class="flex justify-center">
                    <form action="{!! route('names.search') !!}" method="GET" class="w-full max-w-lg relative">
                        <label for="search-home" class="sr-only">Search for a name</label>
                        <input type="text" id="search-home" name="q"
                               class="w-full pl-5 pr-16 py-3 rounded-full bg-white bg-opacity-80 text-gray-700 focus:bg-opacity-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200"
                               placeholder="Enter a name to get started...">
                        <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-indigo-500 text-white p-2.5 rounded-full hover:bg-indigo-600 transition duration-200">
                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Names Section with Interactive Cards -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-12 py-20">
        <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-16">Trending Names</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach ($data['popularNames'] as $name)
                <a href="{!! route('names.show', $name->slug) !!}" class="group bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl border border-gray-200 transform hover:scale-105 transition-all duration-300 ease-in-out">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-indigo-700 transition-colors duration-300">{{ $name->name }}</h3>
                        <p class="text-gray-600 mt-3 text-sm">{{ $name->meaning }}</p>
                        <span class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold tracking-wide mt-4 inline-block transition-colors duration-300">Learn more</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Latest Blog Posts Section with Featured Images -->
    <section class="bg-gray-100 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-16">Insights & Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($data['latestPosts'] as $post)
                    <a href="{!! route('blog.show', $post->slug) !!}" class="group bg-white rounded-lg border border-gray-200 overflow-hidden shadow transition-transform duration-300 hover:shadow-lg">
                        <img class="w-full h-56 object-cover group-hover:opacity-90 transition-opacity duration-300" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800 group-hover:text-indigo-600 mb-2 transition-colors duration-300">{{ Str::limit($post->title, 25) }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                            <div class="text-gray-500 text-xs uppercase tracking-wide font-semibold">
                                By {{ $post->author->name }} &bull; {{ $post->publish_date->format('M d, Y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
