@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
                <div id="favorite-list" class="space-y-4">
                    @forelse ($names as $name)
                        <a href="{!! $name->url !!}" class="p-4 shadow dark:shadow-none rounded-lg flex justify-start items-center dark:border dark:border-base-700 hover:bg-base-50 dark:hover:bg-base-800 transition duration-300 ease-in-out">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold text-primary-800 dark:text-primary-100 capitalize">{{ $name->name }}</h2>
                                <p class="text-md text-base-500 dark:text-base-300">{{ $name->meaning }}</p>
                            </div>
                            <span class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-200 transition duration-300 ease-in-out">Learn more</span>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <span class="text-lg text-base-400 dark:text-base-300">
                                You have not added any names to your favorite list.
                            </span>
                        </div>
                    @endforelse
                </div>
            </main>

            <x-names.sidebar />
        </section>
    </section>
@endsection