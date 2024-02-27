@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8">
            <main class="w-full px-4 mb-4 lg:mb-0">
                @if ($names->isNotEmpty() && $myFavorite)
                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 px-4 py-6">
                        <div class="flex flex-col space-y-2 mb-4 md:mb-0">
                            <h1 class="text-2xl md:text-3xl font-semibold text-base-900 dark:text-base-200">Favorite Names
                            </h1>
                            <p class="text-sm md:text-base text-base-600 dark:text-base-400">
                                Check out the names you've favorited. Share the link with your friends and family to get
                                their opinion.
                            </p>
                        </div>

                        <div class="flex items-center" x-data>
                            <div
                                class="flex items-center justify-between bg-surface dark:bg-base-800 p-2 rounded-lg shadow w-full">
                                <i class="fas fa-link text-lg text-primary-600 dark:text-primary-500 mx-2"></i>
                                <input type="text" id="shareable-link"
                                    class="flex-1 bg-transparent text-base focus:ring-0 border-none text-base-600 dark:text-base-300 focus:outline-none px-2"
                                    value="{!! route('names.favorites',
                                    ['favorite' => $guest->hash])
                                    !!}" readonly
                                    x-ref="shareableLink"
                                    >
                                <button
                                @click.prevent="Utility.copyTextToClipboard($refs.shareableLink.value,$event)"
                                    class="ml-2 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 text-white font-bold py-1 px-3 rounded transition ease-in-out duration-150"
                                    id="copy-link">
                                    Copy
                                </button>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
                        @forelse ($names as $name)
                            <div c<div class="p-6 shadow-md rounded-lg bg-surface dark:bg-base-800 transition-shadow duration-300 ease-in-out relative hover:shadow-xl">
                                <a href="{{ route('names.show', $name) }}" class="flex justify-between items-center hover:text-sky-500 dark:hover:text-sky-300 transition-colors duration-300">
                                    <div>
                                        <h2 class="text-2xl font-bold text-base-900 dark:text-base-100 capitalize mb-1">
                                            {{ $name->name }}
                                        </h2>
                                        <p class="text-sm text-base-600 dark:text-base-400 mt-2 truncate">
                                            {{ $name->meaning }}
                                        </p>
                                    </div>
                                </a>
                                <div class="flex absolute top-4 right-4 space-x-3 items-center">
                                    @if ($name->isMasculine())
                                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900">
                                            <i class="fas fa-mars text-blue-500 text-lg" title="Male"></i>
                                        </span>
                                    @elseif($name->isFeminine())
                                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-900">
                                            <i class="fas fa-venus text-pink-500 text-lg" title="Female"></i>
                                        </span>
                                    @else
                                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700">
                                            <i class="fas fa-genderless text-gray-500 text-lg" title="Unspecified"></i>
                                        </span>
                                    @endif
                                    @if ($myFavorite)
                                        <button class="w-10 h-10 flex justify-center items-center rounded-full bg-base-200 dark:bg-base-700 hover:bg-base-300 dark:hover:bg-base-600 text-red-500 hover:text-red-600 dark:hover:text-red-500 transition duration-300 ease-in-out focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50 favorite-button" data-slug="{{ $name->slug }}" aria-label="Toggle Favorite">
                                            <i class="fa-heart fas"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-10">
                                <p class="text-lg font-medium text-base-900 dark:text-base-200">
                                    Oops! We looked everywhere but couldn't find what you were looking for.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('names.search') }}"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 text-surface text-sm font-medium rounded-md shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2">
                                        Explore Names <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-8">
                    @if ($names->isNotEmpty())
                        <div class="flex justify-center">
                            {{ $names->links() }}
                        </div>
                    @endif
                </div>
            </main>
        </section>
    </section>
@endsection