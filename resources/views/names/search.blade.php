@extends('layouts.main')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-16">
    <div class="py-12 bg-surface dark:bg-base-800 rounded-lg shadow px-5">
        <h1 class="text-3xl font-bold text-center mb-10 text-base-800 dark:text-surface">Search Names</h1>
        <!-- Search Form -->
        <form action="{!! route('names.search') !!}" method="GET" class="mb-10">
            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <div class="relative flex-grow">
                    <input
                        type="search" id="search" name="q"
                        class="w-full pl-12 pr-4 py-3 border border-base-300 text-base-700 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 transition duration-300 ease-in-out placeholder-base-400 dark:placeholder-base-500 dark:ring-0 dark:bg-base-800 dark:text-base-200"
                        placeholder="Search names..."
                        value="{{ request()->query('q') }}"
                        aria-label="Search names"
                    >
                    <div class="absolute left-4 top-0 mt-3 flex items-center justify-center">
                        <svg class="w-6 h-6 text-base-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit" class="flex-shrink-0 px-6 py-3 bg-primary-600 text-surface font-semibold rounded-md hover:bg-primary-700 transition duration-300 ease-in-out">
                    Search
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Filters Here -->
                <x-names.search-filters :query="request()->query()" />
            </div>
        </form>

        <!-- Search Results -->
        <div id="search-results">
            @forelse ($names as $name)
                <div class="mb-6 p-4 bg-surface dark:bg-base-800 border border-base-200 dark:border-base-600 rounded-lg transition-shadow duration-300 ease-in-out hover:shadow-lg">
                    <a href="{!! route('names.show', $name) !!}" class="flex justify-between items-center text-base-800 dark:text-base-200 hover:text-primary-600 dark:hover:text-primary-400">
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold">{{ $name->name }}</h2>
                            <p class="text-base-600 dark:text-base-400">{{ $name->meaning }}</p>
                        </div>
                        <span class="text-primary-600 hover:text-primary-800 dark:hover:text-primary-500 transition duration-300 ease-in-out dark:text-primary-400">
                            Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
            @empty
                <div class="text-center py-8">
                    <span class="text-lg text-base-500 dark:text-base-400">No names found. Try a different search.</span>
                </div>
            @endforelse
        </div>
        <!-- Pagination -->
        @if($names->total() > 0)
            <div class="mt-6">
                {!! $names->onEachSide(1)->links() !!}
            </div>
        @endif
    </div>
</section>
@endsection
