@extends('layouts.main')

{{-- @section('data-theme')
    @php
        $theme =
        $name->isMasculine() ? 'boyish' :
        (
            $name->isFeminine() ? 'girly' :
            'default'
        );
    @endphp
    data-theme="{{ $theme }}"
@endsection --}}

@section('content')
    <section class="max-w-7xl mx-auto px-2 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-16">
            <main class="w-full lg:w-2/3 md:px-4 mb-4 lg:mb-0">

                @php
                    $sections = [
                        'meanings',
                        'signatures',
                        'numerology',
                        'stylish-names',
                        'related-names',
                        // 'quote',
                        // 'statuses',
                        'wallpapers',
                        'abbreviations',
                        'usernames',
                        'good-luck',
                        'questions',
                        'share',
                        'comments',
                    ];
                @endphp

                @foreach ($sections as $section)
                    @include("components.names.$section", ['name' => $name])
                @endforeach

            </main>

            <aside class="w-full lg:w-1/3 md:px-4 space-y-8">
                <x-names.sidebar :name="$name"/>

                <!--- Anchor Links to Sections -->
                <div
                    class="shadow p-6 rounded-lg bg-surface dark:bg-base-800 border border-base-200 dark:border-base-700 transition-all sticky top-5">
                    <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-4">
                        On This Page
                    </h5>
                    <ul class="list-none pl-0 text-base-600 dark:text-base-300">
                        @foreach ($sections as $section)
                            @if ($section !== 'related-names')
                                <li class="mb-4">
                                    <a href="#{{ $section }}"
                                       class="flex items center justify-between text-lg font-medium hover:text-primary-600 dark:hover:text-primary-400 focus:text-primary-600 dark:focus:text-primary-400 transition duration-300 focus:outline-none">
                                        {{  str($section)->camel()->headline() }}
                                        <i class="fas fa-arrow-right text-primary-500 dark:text-primary-400"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </aside>
        </section>
    </section>
@endsection

@production
    @pushonce('scripts')
        <script type="text/javascript" async defer data-pin-hover="true"
                src="//assets.pinterest.com/js/pinit.js"></script>

        <div class="fixed bottom-20 right-0 z-10 transform origin-top-right rotate-90">
            <a href="https://www.surveymonkey.com/r/L6ZFDD7" target="_blank"
                class="inline-flex items-center gap-x-1 bg-base-500 hover:bg-base-600 dark:bg-base-400 dark:hover:bg-base-500 text-surface text-xs px-2 py-1 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-base-500 dark:focus:ring-base-400 transition duration-300">
                <i class="fas fa-comment-alt"></i>
                <span>Feedback</span>
            </a>
        </div>
    @endpushonce
@endproduction