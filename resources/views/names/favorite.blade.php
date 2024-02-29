@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 shadow rounded-lg bg-surface dark:bg-base-800">
            <main class="w-full px-4 mb-4 lg:mb-0">
                @if ($names->isNotEmpty() && $myFavorite)
                    <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-10 px-4 py-10">
                        <div class="">
                            <h1 class="text-2xl md:text-3xl font-semibold text-base-900 dark:text-base-200 mb-2">
                                Favorite Names
                            </h1>
                            <p class="text-sm md:text-base text-base-600 dark:text-base-400">
                                Check out the names you've favorited. Share the link with your friends and family to get
                                their opinion.
                            </p>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center justify-between bg-base-100 dark:bg-base-700 p-2 rounded-lg shadow" x-data>
                            <div class="flex-grow flex items-center">
                                <i class="fas fa-link text-lg text-primary-600 dark:text-primary-500 ml-2"></i>
                                <input type="text" id="shareable-link" title="Share Link"
                                    class="flex-grow overflow-hidden bg-transparent focus:outline-none focus:ring-2 focus:ring-primary-500 border-none text-base-600 dark:text-base-300 ml-2"
                                    value="{!! route('names.favorites', ['favorite' => $guest->hash]) !!}" x-ref="shareableLink">
                            </div>
                            <div x-data="shareComponent()" class="flex items-center ">
                                <button type="button" title="Share" @click.prevent="share"
                                    class="w-full lg:w-auto mt-2 lg:mt-0 lg:ml-2 bg-primary-600 dark:bg-primary-800 text-center hover:bg-primary-700 focus:ring-2 focus:ring-primary-300 dark:focus:ring-primary-800 text-surface dark:text-base-200 font-bold py-1 px-3 rounded transition ease-in-out duration-150">
                                    Share <i class="fas fa-share text-sm ml-2 share-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
                        @forelse ($names as $name)
                            <div
                                class="p-6 shadow-md dark:shadow rounded-lg bg-surface dark:bg-base-800 dark:border dark:border-base-700 dark:shadow-base-900 transition-shadow duration-300 ease-in-out relative hover:shadow-xl">
                                <a href="{{ route('names.show', $name) }}"
                                    class="flex justify-between items-center hover:text-sky-500 dark:hover:text-sky-300 transition-colors duration-300">
                                    <div class="w-full">
                                        <h2
                                            class="flex flex-wrap text-2xl font-semibold text-base-900 dark:text-base-100 capitalize mb-4">
                                            <span class="mr-2">
                                                {{ $name->name }}
                                            </span>

                                            @if ($name->isMasculine())
                                                <span
                                                    class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900">
                                                    <i class="fas fa-mars text-blue-500 text-sm"
                                                        title="{!! str($name->gender)->title() !!}"></i>
                                                </span>
                                            @elseif($name->isFeminine())
                                                <span
                                                    class="flex items-center justify-center w-6 h-6 rounded-full bg-pink-100 dark:bg-pink-900">
                                                    <i class="fas fa-venus text-pink-500 text-sm"
                                                        title="{!! str($name->gender)->title() !!}"></i>
                                                </span>
                                            @else
                                                <span
                                                    class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 dark:bg-gray-700">
                                                    <i class="fas fa-genderless text-gray-500 text-sm"
                                                        title="{!! str($name->gender)->title() !!}"></i>
                                                </span>
                                            @endif
                                        </h2>
                                        <p class="text-sm text-base-600 dark:text-base-400 mt-2">
                                            {{ $name->meaning }}
                                        </p>
                                    </div>
                                </a>
                                <div class="flex absolute top-4 right-4 space-x-3 items-center">

                                    @if ($myFavorite)
                                        <button
                                            class="size-8 flex justify-center items-center rounded-full bg-base-50 dark:bg-base-700  hover:bg-base-200 dark:hover:bg-base-700 text-red-500 dark:text-red-600 hover:text-red-600 dark:hover:text-red-700 transition duration-300 ease-in-out focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50 favorite-button"
                                            data-slug="{{ $name->slug }}" aria-label="Toggle Favorite">
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

    <script>
        function shareComponent() {
            return {
                share() {
                    if (navigator.share) {
                        navigator.share({
                            title: 'Favorite Names - iDenteez',
                            text: 'Check out the names I\'ve favorited on iDenteez',
                            url: this.$refs.shareableLink.value
                        });
                    } else {
                        this.copyToClipboard(this.$refs.shareableLink.value);
                    }
                },
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(function() {
                        var shareIcon = document.querySelector('.share-icon');
                        shareIcon.classList.remove('fa-share');
                        shareIcon.classList.add('fa-check');
                        setTimeout(() => {
                            shareIcon.classList.remove('fa-check');
                            shareIcon.classList.add('fa-share');
                        }, 2000);
                    });
                }
            }
        }
    </script>
@endsection
