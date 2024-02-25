@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
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
                        'feed-back',
                    ];
                @endphp

                @foreach ($sections as $section)
                    @include("components.names.{$section}", ['name' => $name, 'data' => $data])
                @endforeach

            </main>

            <aside class="w-full lg:w-1/3 md:px-4 space-y-8">
                <!--- Anchor Links to Sections -->
                <div class="shadow p-6 rounded-lg bg-surface dark:bg-base-800 border border-gray-200 dark:border-gray-700 transition-all">
                    <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-4">
                        On This Page
                    </h5>
                    <ul class="list-none pl-0 text-base-600 dark:text-base-300">
                        @foreach ($sections as $section)
                            <li class="mb-4">
                                <a href="#{{ $section }}" class="flex items center justify-between text-lg font-medium hover:text-primary-600 dark:hover:text-primary-400 focus:text-primary-600 dark:focus:text-primary-400 transition duration-300 focus:outline-none">
                                    {{  str($section)->camel()->headline() }}
                                    <i class="fas fa-arrow-right text-primary-500 dark:text-primary-400"></i>
                                </a>
                            </li>
                        @endforeach
                </div>
            </aside>
        </section>
    </section>
@endsection

@production
    @pushonce('scripts')
        <script type="text/javascript" async defer data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
    @endpushonce
@endproduction