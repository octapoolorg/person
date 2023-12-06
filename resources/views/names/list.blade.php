@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <div id="search-results" class="space-y-4">
                @forelse ($names as $name)
                    <a href="{!! route('names.show', $name) !!}" class="p-4 bg-white dark:bg-gray-800 shadow dark:shadow-none rounded-lg flex justify-start items-center hover:bg-gray-50 dark:hover:bg-gray-900 transition duration-300 ease-in-out">
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold text-indigo-800 dark:text-indigo-100">{{ $name->name }}</h2>
                            <p class="text-md text-gray-500 dark:text-gray-300">{{ $name->meaning }}</p>
                        </div>
                        <span class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 transition duration-300 ease-in-out">Learn more</span>
                    </a>
                @empty
                    <div class="text-center py-8">
                        <span class="text-lg text-gray-400 dark:text-gray-300">No names found. Try a different search.</span>
                    </div>
                @endforelse
            </div>
        </main>

        @include('partials.names._sidebar')
    </section>
@endsection