@extends('layouts.main')

@section('content')
    <!-- Hero Section with Image Background and Overlay -->
    <section class="relative bg-cover bg-center py-32" style="background-image: url({{ asset('static/images/hero-bg.png') }});">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-500 to-indigo-600 opacity-90"></div>
        <div class="container mx-auto px-6 md:px-12 xl:px-20 relative z-10">
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-6xl font-extrabold mb-6 leading-tight">Uncover the Meaning of Names</h1>
                <p class="text-xl mb-8">Join millions in the quest for names' history, culture, and significance.</p>
                <div class="flex justify-center">
                    <form action="{!! route('names.search') !!}" method="GET" class="w-full max-w-lg relative">
                        <label for="search-home" class="sr-only">Search for a name</label>
                        <input type="text" id="search-home" name="q"
                               class="w-full pl-5 pr-16 py-3 rounded-full bg-white bg-opacity-90 text-slate-700 focus:bg-opacity-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200"
                               placeholder="Enter a name to get started..." required>
                        <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-indigo-500 text-white p-2.5 rounded-full hover:bg-indigo-600 transition duration-200">
                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <!-- Popular Names Section with Interactive Cards -->
        <section class="container mx-auto py-20 my-10">
            <h2 class="text-5xl font-extrabold text-center text-slate-800 mb-16">Trending Names</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach ($data['popularNames'] as $name)
                    <a href="{!! route('names.show', $name->slug) !!}" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg border border-slate-200 transition-all duration-300 ease-in-out">
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-bold text-slate-900 group-hover:text-indigo-700 transition-colors duration-300">{{ $name->name }}</h3>
                            <p class="text-slate-600 mt-3 text-sm">{{ $name->meaning }}</p>
                            <span class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold tracking-wide mt-4 inline-block transition-colors duration-300">Learn more</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Latest Blog Posts Section with Featured Images -->
        <section class="container mx-auto my-10">
            <div class="container mx-auto">
                <h2 class="text-5xl font-extrabold text-center text-slate-800 mb-16">Insights & Stories</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-4 sm:px-6 lg:px-12 py-20 border shadow rounded-lg ">
                    @foreach ($data['latestPosts'] as $post)
                        <a href="{!! route('blog.show', $post->slug) !!}" class="group rounded-lg border border-slate-200 shadow group-hover:shadow-lg">
                            @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                                <img class="w-full h-56 object-cover group-hover:opacity-90 transition-opacity duration-300" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                            @endif
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-slate-800 mb-2 transition-colors duration-300">{{ Str::limit($post->title, 25) }}</h3>
                                <p class="text-slate-600 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                                <div class="text-slate-500 text-xs capitalize tracking-wide font-semibold">
                                    By {{ $post->author->name }} &bull; {{ $post->publish_date->format('M d, Y') }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

    </section>
@endsection
