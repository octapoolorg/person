@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 mb-4 lg:mb-0 bg-surface dark:bg-base-800 rounded-lg shadow-md overflow-hidden p-4 md:p-8">

                <div class="">
                    <h1 class="text-lg font-semibold text-base-800 dark:text-surface mb-4">{!! $meta->title !!}</h1>
                    <p class="text-lg text-base-500 dark:text-base-400">
                        {!! $meta->description !!}
                    </p>
                </div>

                @foreach ($signatures as $signature)
                    <div class="border border-base-200 dark:border-base-700 rounded-lg overflow-hidden shadow-sm transition-transform duration-300 cursor-pointer my-5 relative">
                        <a href="{!! $signature !!}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 z-10"></a>
                        <!--Download button fa icon on right top -->
                        <a href="{!! $signature !!}" download="" target="_blank" rel="noopener noreferrer" class="absolute top-2 right-2 z-20 bg-surface dark:bg-base-800 py-2 px-3 rounded-lg transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-download text-base-500 dark:text-base-400"></i>
                        </a>
                        <img
                            class="inline-block rounded-lg w-full h-52 object-cover transition-opacity duration-300 lazy hover:opacity-80 dark:opacity-80 dark:hover:opacity-90"
                            src="{!! $signature !!}"
                            alt="{{ $name->name }} Signature"
                        >
                    </div>
                @endforeach
            </main>

            <aside class="w-full lg:w-1/3 md:px-4 space-y-8">
                <x-names.sidebar :name=$name />

                <div class="bg-surface dark:bg-base-800 rounded-lg shadow-md p-4 md:p-8">
                    <h2 class="text-lg font-semibold text-base-800 dark:text-surface mb-4">Share {!! $name->name !!}</h2>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" rel="noopener noreferrer" class="text-base-500 dark:text-base-400 hover:text-base-600 dark:hover:text-base-300">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Check out this name {{ $name->name }}&via=namesearch" target="_blank" rel="noopener noreferrer" class="text-base-500 dark:text-base-400 hover:text-base-600 dark:hover:text-base-300">
                            <i class="fab fa-twitter-square"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title=Check out this name {{ $name->name }}&summary=&source=namesearch" target="_blank" rel="noopener noreferrer" class="text-base-500 dark:text-base-400 hover:text-base-600 dark:hover:text-base-300">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

            </aside>
        </section>
    </section>
@endsection
