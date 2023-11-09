@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <div class="mb-4">
                <form action="{!! route('names.search') !!}" method="GET">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <input type="text" id="search" name="q"
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-300 ease-in-out"
                               placeholder="Search names...">
                        <div class="absolute left-0 top-0 mt-3 ml-4">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div id="search-results" class="space-y-4">
                @forelse ($names as $name)
                    <a href="{!! route('names.show', $name) !!}" class="p-4 bg-white shadow rounded-lg flex justify-start items-center hover:bg-gray-50 transition duration-300 ease-in-out">
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold text-indigo-800">{{ $name->name }}</h2>
                            <p class="text-md text-gray-500">{{ $name->meaning }}</p>
                        </div>
                        <span class="text-indigo-600 hover:text-indigo-900 transition duration-300 ease-in-out">Learn more</span>
                    </a>
                @empty
                    <div class="text-center py-8">
                        <span class="text-lg text-gray-400">No names found. Try a different search.</span>
                    </div>
                @endforelse
            </div>
        </main>

        @include('partials.names._sidebar')
    </section>
@endsection
