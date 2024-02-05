@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <div class="mb-4">
                <form action="{!! route('names.search') !!}" method="GET">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <input type="search" id="search" name="q"
                               class="w-full pl-10 pr-4 py-3 border border-base-300 dark:border-base-700 rounded-full shadow-sm focus:outline-none focus:border-primary-500 dark:focus:border-primary-500 transition duration-300 ease-in-out dark:bg-base-800 dark:text-base-100"
                               placeholder="Search names..." value="{{request()->input('q')}}">
                        <div class="absolute left-0 top-0 mt-4 ml-4">
                            <svg class="fill-base-400 dark:fill-base-600 w-5 h-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                        </div>
                    </div>
                </form>
            </div>
            <div id="search-results" class="space-y-4">
                @forelse ($names as $name)
                    <a href="{!! route('names.show', $name) !!}" class="p-4 shadow dark:shadow-none rounded-lg flex justify-start items-center hover:bg-base-50 dark:hover:bg-base-800 transition duration-300 ease-in-out dark:border dark:border-base-700">
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold text-primary-800 dark:text-primary-100">{{ $name->name }}</h2>
                            <p class="text-md text-base-500 dark:text-base-300">{{ $name->meaning }}</p>
                        </div>
                        <span class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-200 transition duration-300 ease-in-out">Learn more</span>
                    </a>
                @empty
                    <div class="text-center py-8">
                        <span class="text-lg text-base-400 dark:text-base-300">No names found. Try a different search.</span>
                    </div>
                @endforelse
            </div>
        </main>

        @include('partials.names._sidebar')
    </section>
    </section>
@endsection
