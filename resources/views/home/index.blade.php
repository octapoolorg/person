@extends('layouts.main')

@section('content')
    <!-- Hero Section with Image Background and Overlay -->
    <section class="relative bg-cover bg-center py-32" style="background-image: url({{ asset('static/images/hero-bg.jpg') }});">
        <div class="absolute inset-0 bg-gradient-to-b from-primary-700 to-primary-800 opacity-90 dark:from-primary-800 dark:to-primary-900 dark:opacity-90"></div>
        <div class="container mx-auto px-6 md:px-12 xl:px-20 relative z-10">
            <div class="text-center text-surface">
                <h1 class="text-3xl md:text-6xl font-bold mb-6 leading-tight">Uncover Name Mysteries</h1>
                <p class="text-xl mb-8">Join millions in the quest for names' history, culture, and significance.</p>
                <div class="flex justify-center">
                    <form action="{!! route('names.search') !!}" method="GET" class="w-full max-w-lg">
                        <label for="search-home" class="sr-only">Search for a name</label>
                        <div class="relative">
                            <input type="text" id="search-home" name="q"
                                   class="w-full pl-5 py-3 focus:border-primary-200 rounded-full bg-surface dark:bg-base-800 bg-opacity-90 text-base-700 dark:text-base-300 focus:bg-opacity-100 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:outline-none transition duration-200"
                                   placeholder="Enter a name to get started..." required>
                            <button type="submit" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-primary-500 text-surface px-4 py-3 rounded-full hover:bg-primary-600 transition duration-200">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <!-- Popular Names Section with Interactive Cards -->
        <section class="container mx-auto py-20 my-10">
            <h2 class="text-5xl font-bold text-center text-base-800 dark:text-base-100 mb-16">Trending Names</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach ($namesList->random(8) as $name)
                    <a href="{!! route('names.show', $name->slug) !!}" class="group rounded-lg overflow-hidden shadow-md hover:shadow-lg border border-base-200 dark:border-base-700 transition-all duration-300 ease-in-out">
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-bold text-base-900 dark:text-base-100 group-hover:text-primary-700 transition-colors duration-300">{{ $name->name }}</h3>
                            <p class="text-base-600 dark:text-base-300 mt-3 text-sm truncate capitalize">{{ $name->meaning }}</p>
                            <span class="text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 text-sm font-semibold tracking-wide mt-4 inline-block transition-colors duration-300">
                                Learn more <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Latest Blog Posts Section with Featured Images -->
        <section class="container mx-auto my-10">
            <div class="container mx-auto">
                <h2 class="text-5xl font-bold text-center text-base-800 dark:text-base-100 mb-16">Insights & Stories</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-4 sm:px-6 lg:px-12 py-20 border dark:border-base-700 shadow rounded-lg ">
                    @foreach ($data['latestPosts'] as $post)
                        <a href="{!! route('blog.show', $post->slug) !!}" class="group dark:bg-base-800 rounded-lg border border-base-200 dark:border-base-700 shadow dark:hover:shadow-primary-300 group-hover:shadow-lg">
                            @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                                <img class="w-full h-56 object-cover group-hover:opacity-90 transition-opacity duration-300 lazy"
                                src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
                                data-src="{{ $post->featured_image }}" alt="{{ $post->title }}">
                            @endif
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-base-800 dark:text-base-100 mb-2 transition-colors duration-300">{{ Str::limit($post->title, 25) }}</h3>
                                <p class="text-base-600 dark:text-base-300 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                                <div class="text-base-500 dark:text-base-400 text-xs capitalize tracking-wide font-semibold">
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
