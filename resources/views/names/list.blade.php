@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
                <div id="search-results" class="space-y-4">
                    @forelse ($names as $name)
                    <div class="p-4 shadow dark:shadow-none rounded-lg flex justify-start items-center dark:border dark:border-base-700 bg-surface dark:bg-base-800 hover:bg-base-50 transition duration-300 ease-in-out">
                        <a href="{!! route('names.show', $name) !!}" class="w-11/12 flex-grow">
                            <h2 class="text-xl font-semibold text-primary-800 dark:text-primary-100 capitalize">
                                {{ $name->name }} ({{ $name->gender }})
                            </h2>
                            <p class="text-md text-base-500 dark:text-base-300 over truncate pe-10">{{ $name->meaning }}</p>
                        </a>
                        <a class="w-1/12 flex justify-center items-center text-pink-600 dark:text-pink-500 hover:text-pink-700 dark:hover:text-pink-600 favorite-button" href="javascript:;" data-slug="{{ $name->slug }}">
                            <i class="fa-heart text-2xl far" id="favorite-icon"></i>
                        </a>
                    </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="mt-4">
                                <p class="mt-6 text-base leading-7 text-base-600 dark:text-base-300">
                                    Oops! We looked everywhere but couldn't find what you were looking for.
                                </p>
                                <div class="mt-10 flex items-center justify-center gap-x-6">
                                    <a href="{!! route('names.search') !!}" class="rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-surface shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                                        Explore Names <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                             </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $names->links() }}
                </div>
            </main>

            <x-names.sidebar />
        </section>
    </section>
@endsection