@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 md:px-4 mb-4 lg:mb-0">
            <!-- Name Section -->
            <section class="bg-slate-100 dark:bg-slate-800 px-4 py-10 md:p-16 rounded-lg shadow-lg overflow-hidden relative text-slate-900 dark:text-slate-100 border dark:border-slate-700">
                <article class="text-center">
                    <header>
                        <h1 class="text-4xl md:text-7xl font-bold mb-6 tracking-tight text-slate-900 dark:text-slate-100" id="actual-name">
                            {{ $data['nameDetails']->name }}
                        </h1>
                    </header>

                    <div class="flex flex-col items-center space-y-6 mt-10 mb-20 md:mb-16 relative">
                        <strong class="text-xl md:text-3xl font-semibold uppercase text-slate-900 dark:text-slate-100">Means:</strong>
                        <p class="text-xl md:text-2xl leading-relaxed md:mx-6 capitalize text-slate-900 dark:text-slate-100">
                            {{ $data['nameDetails']->meaning }}
                        </p>
                        @if($data['nameDetails']->generated > 0)
                            <div class="group absolute -bottom-5 md:-bottom-10 right-0 mb-2 mr-2 flex items-center">
                                <!-- SVG Icon -->
                                <svg class="fill-indigo-500 dark:fill-indigo-300 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>

                                <!-- Tooltip Text -->
                                <span class="absolute bottom-full mb-2 right-0 bg-black text-white text-xs rounded py-1 px-3 hidden group-hover:block">
                                    Based on Numerology.
                                </span>
                            </div>
                        @endif
                    </div>
                </article>

                <footer class="absolute bottom-0 left-0 w-full bg-indigo-700 dark:bg-indigo-800 text-slate-100 text-center py-4 md:py-6 border-t border-indigo-800 dark:border-indigo-700">
                    <p class="text-lg md:text-xl font-bold md:text-end md:mr-5">
                        <span class="font-normal not-italic">Gender:</span> {{ $data['nameDetails']->gender->name }}
                    </p>
                </footer>
            </section>

            <!-- Name Details Section -->
            <section class="border dark:border-slate-700 my-10 rounded-lg shadow dark:shadow-none">
                <!-- Zodiac Sign Section -->
                @include('partials.names._box', [
                    'title' => 'Zodiac Sign',
                    'description' => __(
                        'zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.zodiac_sign',
                        ['name' => $data['nameDetails']->name]),
                    'img_src' => asset(
                        'static/images/zodiac/signs/' . strtolower($data['numerology']['zodiac']['sign']) . '.png'),
                    'caption' => $data['numerology']['zodiac']['sign'],
                ])

                <hr class="dark:border-slate-700">

                <!-- Auspicious Stones Section -->
                @include('partials.names._box', [
                    'title' => 'Auspicious Stones',
                    'description' => __(
                        'zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_stones',
                        ['name' => $data['nameDetails']->name]),
                    'img_src' => asset(
                        'static/images/zodiac/stones/' . strtolower($data['numerology']['zodiac']['attributes']['stone']) . '.png'),
                    'caption' => $data['numerology']['zodiac']['attributes']['stone'],
                ])
            </section>

            <!-- Name Signature Section -->
            <section class="px-4 py-10 md:p-8 border dark:border-slate-700 mb-10 rounded-lg shadow dark:shadow-none">
                <h2 class="text-2xl mb-6 text-slate-900 dark:text-slate-100">Signatures for {{ $data['nameDetails']->name }}</h2>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    @foreach ($data['signatureUrls'] as $font => $url)
                        <img src="{{ $url }}" alt="{{ $data['nameDetails']->name }} name Signature"
                             class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 dark:opacity-80">
                    @endforeach
                </div>
            </section>

            <!-- Numerology Details Section -->
            <section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-slate-700">
                <div class="flex flex-row justify-between items-center relative">
                    <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold relative">
                        {{ $data['nameDetails']->name }} Name Numerology
                    </h2>
                    <span class="group relative md:absolute top-0 right-0 mb-2 mr-2 flex items-center">
                        <!-- SVG Icon -->
                        <svg class="fill-indigo-500 dark:fill-indigo-300 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>

                        <!-- Tooltip Text -->
                        <span class="absolute bottom-full mb-2 right-0 bg-black dark:bg-black text-white dark:text-slate-100 text-xs rounded py-1 px-3 hidden group-hover:block">
                            Based on Pythagorean Numerology.
                        </span>
                    </span>
                </div>

                <div class="space-y-10">
                    <!-- Numerology Explanation -->
                    <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        Numerology numbers, each associated with a unique color, offer insights into personality and destiny. Discover the colors and meanings personalized for {{ $data['nameDetails']->name }}.
                    </p>

                    <!-- Numerology Details -->
                    <!-- Destiny -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-indigo-50 dark:bg-indigo-900 rounded-xl shadow-inner dark:shadow-none p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/numerology-icon.png') }}" alt="Destiny Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-indigo-700 dark:text-indigo-300 mb-3">Destiny Number</h3>
                            <p class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                                {{ __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Soul -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-green-50 dark:bg-green-900 rounded-xl shadow-inner dark:shadow-none p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/soul-icon.png') }}" alt="Soul Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-green-700 dark:text-green-300 mb-3">Soul Number</h3>
                            <p class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                                {{ __('numerology.soul_urge.' . $data['numerology']['numbers']['soul_urge'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Personality -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-yellow-50 dark:bg-yellow-900 rounded-xl shadow-inner dark:shadow-none p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/personality-icon.png') }}" alt="Personality Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-yellow-700 dark:text-yellow-300 mb-3">Personality Number</h3>
                            <p class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                                {{ __('numerology.personality.' . $data['numerology']['numbers']['personality'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Abbreviations Section -->
            <section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-slate-700">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold">
                        Abbreviations of {{ $data['nameDetails']->name }}
                    </h2>
                    <a href="javascript:" id="generate-abbreviations" class="group mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 dark:hover:text-indigo-200 dark:text-indigo-400 font-semibold transition-colors duration-300 flex items-center self-end">
                        Generate another
                        <svg class="fill-indigo-600 group-hover:fill-indigo-800 dark:fill-indigo-400 dark:group-hover:fill-indigo-200 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                    </a>
                </div>
                <div class="overflow-hidden">
                    <table class="w-full text-left text-slate-600 dark:text-slate-300">
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700" id="abbreviations">
                        @foreach ($data['abbreviations'] as $abbreviationData)
                            @foreach ($abbreviationData as $alphabet => $abbreviation)
                                <tr class="hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-300">
                                    <th class="text-lg p-4 font-semibold text-slate-800 dark:text-slate-100 bg-slate-100 dark:bg-slate-800 uppercase">{{ $alphabet }}</th>
                                    <td class="text-lg p-4 text-slate-900 dark:text-slate-100">{{ $abbreviation }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Username Section -->
            @include('partials.names._usernames')

            <!-- Wallpaper section -->
            <section class="text-slate-900 dark:text-slate-100 px-6 py-8 shadow rounded-lg border dark:border-slate-700">
                <div class="flex flex-col md:flex-row justify-between mb-6">
                    <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold">{{ $data['nameDetails']->name }} Name Wallpaper</h2>
                    <a href="{{ $data['wallpaperUrl'] }}" download class="group text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 font-semibold transition-colors duration-300 flex items-center self-end">
                        Download
                        <svg class="fill-indigo-600 group-hover:fill-indigo-800 dark:fill-indigo-400 dark:group-hover:fill-indigo-200 ml-2" xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    </a>
                </div>

                <div class="overflow-hidden rounded-lg shadow-lg dark:shadow-none my-8">
                    <img src="{{ $data['wallpaperUrl'] }}" class="w-full h-auto md:h-96 object-cover" id="name-wallpaper" alt="Stylish wallpaper with the name {{ $data['nameDetails']->name }}">
                </div>

                <p class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                    Discover the unique charm of the {{ $data['nameDetails']->name }} name wallpaper. Every curve and detail of the design captures the essence of the name, making it a perfect backdrop for your devices. Elevate your screens with this blend of artistry and elegance.
                </p>
            </section>

            <!-- Fancy Text Styles section -->
            <section class="px-6 py-10 my-10 text-slate-800 dark:text-slate-100 rounded-lg shadow dark:shadow-none border-t dark:border border-slate-100 dark:border-slate-700">
                <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold capitalize">
                    {{ $data['nameDetails']->name }} Name - Fancy Texts
                </h2>
                <p class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                    Experience the elegance of {{ $data['nameDetails']->name }}
                    presented in various distinctive text styles. Each style is crafted
                    to highlight the uniqueness of the name, adding a touch of sophistication
                    and charm to your content.
                </p>
                <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6">
                    <a href="javascript:" id="generate-fancy-texts" class="group mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 dark:hover:text-indigo-200 dark:text-indigo-400 font-semibold transition-colors duration-300 flex items-center">
                        Generate new styles
                        <svg class="fill-indigo-600 group-hover:fill-indigo-800 dark:fill-indigo-400 dark:group-hover:fill-indigo-200 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <ul class="divide-y divide-slate-200 dark:divide-slate-700" id="fancy-texts">
                        @foreach ($data['fancyTexts'] as $fancyText)
                            <li tabindex="0"
                                class="text-lg p-4 hover:bg-slate-100 dark:hover:bg-slate-800 transition ease-in-out duration-150 cursor-pointer copy-to-clipboard text-slate-900 dark:text-slate-100"
                                aria-label="Select {{ $fancyText }} style">
                                {{ $fancyText }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            @include('partials.names._faqs')

            @include('partials.names._share')

            @include('partials.names._comment')
        </main>

        @include('partials.names._sidebar')
    </section>
    </section>
@endsection

@pushonce('scripts')
    <script type="text/javascript" async defer data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
@endpushonce