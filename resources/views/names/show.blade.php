@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 md:px-4 mb-4 lg:mb-0">
                <!-- Name Details Section -->
                <x-names.detail :name="$name" />

                <!-- Name Zodiac Section -->
                <x-names.zodiac :data="$data" />

                <!-- Name Signature Section -->
                <x-names.signature :data="$data" />

                <!-- Numerology Details Section -->
                <x-names.numerology :data="$data" />

                <!-- Abbreviations Section -->
                <x-names.abbreviation :data="$data" />

                <!-- Username Section -->
                <x-names.username :data="$data" />

                <!-- Wallpaper section -->
                <x-names.wallpaper :data="$data" />

                <!-- Fancy Texts Section -->
                <x-names.fancy-texts :data="$data" />

                <!-- Similar Names Section -->
                {{-- <x-names.similar-names :data="$data" /> --}}

                <!-- FAQ Section -->
                <x-names.faq :data="$data" />

                <!-- Share Section -->
                <x-names.share :data="$data" />

                <!-- Comment Section -->
                <x-names.comment :data="$data" />
            </main>

            <x-names.sidebar />
        </section>
    </section>
@endsection

@production
    @pushonce('scripts')
        <script type="text/javascript" async defer data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
    @endpushonce
@endproduction