@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 md:px-4 mb-4 lg:mb-0">

                @php
                    $sections = [
                        'detail',
                        'signature',
                        'numerology',
                        'fancy-text',
                        'list',
                        // 'quote',
                        // 'statuses',
                        'wallpaper',
                        'abbreviation',
                        'username',
                        'zodiac',
                        'faq',
                        'share',
                        'comment',
                    ];
                @endphp

                @foreach ($sections as $section)
                    @include("components.names.{$section}", ['name' => $name, 'data' => $data])
                @endforeach

            </main>

            <x-names.sidebar :name="$name" />
        </section>
    </section>
@endsection

@production
    @pushonce('scripts')
        <script type="text/javascript" async defer data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
    @endpushonce
@endproduction