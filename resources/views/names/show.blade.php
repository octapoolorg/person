@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <section class="bg-gray-100 p-8 md:p-16 rounded-lg shadow-lg overflow-hidden relative text-gray-900 border">
                <article class="text-center">
                    <!-- Name -->
                    <header>
                        <h1 class="text-4xl md:text-7xl font-bold mb-6 md:mb-12 tracking-tight">
                            {{ $data['nameDetails']->name }}
                        </h1>
                    </header>

                    <!-- Meaning -->
                    <div class="flex flex-col items-center space-y-4 my-8 md:my-12">
                        <strong class="text-xl md:text-3xl font-semibold uppercase">Means:</strong>
                        <p class="text-xl md:text-2xl leading-relaxed mx-4 capitalize">
                            {{ $data['nameDetails']->meaning }}
                        </p>
                    </div>
                </article>

                <footer
                    class="absolute bottom-0 left-0 w-full bg-indigo-700 text-gray-100 text-center py-4 md:py-6 border-t border-indigo-800">
                    <p class="text-lg md:text-xl font-bold italic ">
                        A {{ $data['nameDetails']->gender->name }} name.
                    </p>
                </footer>
            </section>

            <section class="border my-10 rounded-lg shadow">
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

                <hr>

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

            <section class="p-4 md:p-8 border mb-10 rounded-lg shadow">
                <h2 class="text-2xl mb-6">Signatures for {{ $data['nameDetails']->name }}</h2>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    @foreach ($data['signatureUrls'] as $font => $url)
                        <img src="{{ $url }}" alt="{{ $data['nameDetails']->name }} name Signature"
                             class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1">
                    @endforeach
                </div>
            </section>

            <!-- Numerology Details Section -->
            <section class="bg-white p-10 rounded-lg shadow mb-10 border border-gray-300">
                <h2 class="text-4xl text-gray-800 mb-10 font-bold">{{ $data['nameDetails']->name }} Name Numerology</h2>

                <div class="space-y-10">
                    <!-- Numerology Explanation -->
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Numerology numbers, each associated with a unique color, offer insights into personality and destiny. Discover the colors and meanings personalized for {{ $data['nameDetails']->name }}.
                    </p>

                    <!-- Numerology Details -->
                    <!-- Destiny -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-indigo-50 rounded-xl shadow-inner p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/numerology-icon.png') }}" alt="Destiny Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Destiny Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Soul -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-green-50 rounded-xl shadow-inner p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/soul-icon.png') }}" alt="Soul Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-green-700 mb-3">Soul Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.soul_urge.' . $data['numerology']['numbers']['soul_urge'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Personality -->
                    <div class="flex flex-col md:flex-row items-center md:items-start bg-yellow-50 rounded-xl shadow-inner p-6">
                        <img src="{{ asset('static/images/zodiac/numerology/personality-icon.png') }}" alt="Personality Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-semibold text-yellow-700 mb-3">Personality Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.personality.' . $data['numerology']['numbers']['personality'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Abbreviation Section -->
            <section class="bg-white py-8 px-4 md:px-8 rounded-lg shadow my-10">
                <div class="flex flex-col md:flex-row items-center justify-between mb-6">
                    <h2 class="text-4xl text-gray-800 font-bold capitalize">
                        Acronyms of {{ $data['nameDetails']->name }}
                    </h2>
                    <a href="javascript:" id="generate-acronyms" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
                        Generate another
                        <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                    </a>
                </div>
                <div class="overflow-hidden mb-12">
                    <table class="w-full text-left text-gray-600">
                        <tbody class="divide-y divide-gray-200" id="acronyms">
                        @foreach ($data['acronyms'] as $alphabet => $acronym)
                            <tr class="hover:bg-gray-50 transition-colors duration-300">
                                <th class="p-4 font-semibold text-gray-800 bg-gray-100 uppercase">{{ $alphabet }}</th>
                                <td class="p-4">{{ $acronym }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Usernames Section -->
            <section class="bg-white py-8 px-4 md:px-8 rounded-lg shadow my-10">
                <div class="flex flex-col md:flex-row items-center justify-between mb-6">
                    <h2 class="text-4xl text-gray-800 font-bold capitalize">
                        Usernames of {{ $data['nameDetails']->name }}
                    </h2>
                    <a href="javascript:" id="generate-usernames" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
                        Generate another
                        <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                    </a>
                </div>
                <div class="overflow-hidden mb-12">
                    <table class="w-full text-left text-gray-600">
                        <tbody class="divide-y divide-gray-200" id="usernames">
                        @foreach ($data['userNames'] as $username)
                            <tr class="hover:bg-gray-50 transition-colors duration-300">
                                <td class="p-4">{{ $username }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Wallpaper section -->
            <section class="text-gray-900">
                <div class="flex flex-col md:flex-row items-center justify-between mb-6">
                    <h2 class="text-3xl text-gray-700 font-bold my-6">{{ $data['nameDetails']->name }} Name Wallpaper</h2>
                    <a href="{{ $data['wallpaperUrl'] }}" download="{{ $data['nameDetails']->name }} Name Wallpaper" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
                        Download
                        <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    </a>
                </div>

                <div class="overflow-hidden rounded-lg shadow-lg my-8">
                    <img src="{{ $data['wallpaperUrl'] }}"
                         class="w-full h-auto md:h-96 object-cover"
                         alt="Stylish wallpaper with the name {{ $data['nameDetails']->name }} symbolizing [qualities/themes of the wallpaper].">
                </div>
                <p class="text-lg my-8 leading-relaxed">
                    Discover the unique charm of the {{ $data['nameDetails']->name }} name wallpaper.
                    Every curve and detail of the design captures the essence of the name, making it a perfect backdrop for
                    your devices. Elevate your screens with this blend of artistry and elegance.
                </p>
            </section>

            <!-- Fancy Text Styles section -->
            <section class="px-6 py-10 mb-10 text-gray-800 rounded-lg shadow">
                <div class="flex flex-col md:flex-row items-center justify-between mb-6">
                    <h2 class="text-4xl text-gray-800 font-bold capitalize">
                        {{ $data['nameDetails']->name }} - Fancy Text Styles
                    </h2>
                    <a href="javascript:" id="generate-fancy-texts" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
                        Generate another
                        <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                    </a>
                </div>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Experience the elegance of {{ $data['nameDetails']->name }}
                    presented in various distinctive text styles. Each style is crafted
                    to highlight the uniqueness of the name, adding a touch of sophistication
                    and charm to your content.
                </p>
                <div class="overflow-x-auto">
                    <ul class="divide-y divide-gray-200 bg-white" id="fancy-texts">
                        @foreach ($data['fancyTexts'] as $fancyText)
                            <li tabindex="0"
                                class="text-lg p-4 hover:bg-gray-100 focus:bg-gray-100 transition ease-in-out duration-150 cursor-pointer"
                                aria-label="Select {{ $fancyText }} style">
                                {{ $fancyText }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="px-6 py-10 mb-10 rounded-lg shadow" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="mb-8 text-3xl text-gray-700 font-bold">
                    Frequently Asked Questions about {{ $data['nameDetails']->name }}
                </h2>

                <div class="mx-auto bg-white space-y-6 divide-y divide-gray-200">

                    @if(!empty($data['nameDetails']->meaning))
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <h3 itemprop="name" class="text-lg text-gray-800 font-bold py-4">
                                What does the name {{ $data['nameDetails']->name }} mean?
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <p itemprop="text" class="text-gray-600">
                                    {{ $data['nameDetails']->meaning }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 itemprop="name" class="text-lg text-gray-800 font-bold py-4">
                            Is {{ $data['nameDetails']->name }} typically a male or female name?
                        </h3>
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <p itemprop="text" class="text-gray-600">
                                {{ $data['nameDetails']->gender->name }} is the gender typically associated with the name {{ $data['nameDetails']->name }}.
                            </p>
                        </div>
                    </div>

                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 itemprop="name" class="text-lg text-gray-800 font-bold py-4">
                            What are the numerology details of {{ $data['nameDetails']->name }}?
                        </h3>
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <p itemprop="text" class="text-gray-600">
                                According to numerology, the destiny number is {{ $data['numerology']['numbers']['destiny'] }}, the soul number is {{ $data['numerology']['numbers']['soul_urge'] }}, and the personality number is {{ $data['numerology']['numbers']['personality'] }}.
                            </p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Social Share Section -->
            <section class="my-8 mb-10 ">
                <div class="flex flex-wrap justify-center md:justify-start gap-2 sm:gap-4">
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={!! request()->url() !!}"
                       class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-900 text-white rounded-full hover:bg-gray-950 flex items-center gap-2 transition-colors duration-300"
                       target="_blank" rel="nofollow">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                        Share
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={!! request()->url() !!}"
                       class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600  flex items-center gap-2 transition-colors duration-300"
                       target="_blank" rel="nofollow">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                        Share
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/cws/share?url={!! request()->url() !!}"
                       class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 flex items-center gap-2 transition-colors duration-300"
                       target="_blank" rel="nofollow">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
                        Share
                    </a>
                    <!-- Reddit -->
                    <a href="http://www.reddit.com/submit?url={!! request()->url() !!}"
                       class="px-3 py-2 sm:px-4 sm:py-2 bg-red-500 text-white rounded-full hover:bg-red-600 flex items-center gap-2 transition-colors duration-300"
                       target="_blank" rel="nofollow">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M440.3 203.5c-15 0-28.2 6.2-37.9 15.9-35.7-24.7-83.8-40.6-137.1-42.3L293 52.3l88.2 19.8c0 21.6 17.6 39.2 39.2 39.2 22 0 39.7-18.1 39.7-39.7s-17.6-39.7-39.7-39.7c-15.4 0-28.7 9.3-35.3 22l-97.4-21.6c-4.9-1.3-9.7 2.2-11 7.1L246.3 177c-52.9 2.2-100.5 18.1-136.3 42.8-9.7-10.1-23.4-16.3-38.4-16.3-55.6 0-73.8 74.6-22.9 100.1-1.8 7.9-2.6 16.3-2.6 24.7 0 83.8 94.4 151.7 210.3 151.7 116.4 0 210.8-67.9 210.8-151.7 0-8.4-.9-17.2-3.1-25.1 49.9-25.6 31.5-99.7-23.8-99.7zM129.4 308.9c0-22 17.6-39.7 39.7-39.7 21.6 0 39.2 17.6 39.2 39.7 0 21.6-17.6 39.2-39.2 39.2-22 .1-39.7-17.6-39.7-39.2zm214.3 93.5c-36.4 36.4-139.1 36.4-175.5 0-4-3.5-4-9.7 0-13.7 3.5-3.5 9.7-3.5 13.2 0 27.8 28.5 120 29 149 0 3.5-3.5 9.7-3.5 13.2 0 4.1 4 4.1 10.2.1 13.7zm-.8-54.2c-21.6 0-39.2-17.6-39.2-39.2 0-22 17.6-39.7 39.2-39.7 22 0 39.7 17.6 39.7 39.7-.1 21.5-17.7 39.2-39.7 39.2z"/></svg>
                        Share
                    </a>
                    <!-- Mail -->
                    <a href="mailto:?subject={!! $data['nameDetails']->name !!} name details - all you need to know&amp;body={!! request()->url() !!}"
                       class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-500 text-white rounded-full hover:bg-gray-600 flex items-center gap-2 transition-colors duration-300"
                       target="_blank" rel="nofollow" title="Share via email">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        Share
                    </a>
                </div>
            </section>

            <!-- Comments Section -->
            <section class="py-10 w-full"> <!-- Full width section -->
                <h2 class="mb-6 text-3xl font-semibold text-gray-800 lg:text-4xl">Comments</h2>

                <div class="space-y-6 max-w-4xl mx-auto">
                    @foreach ($data['nameDetails']->comments as $comment)
                        <article class="flex space-x-4 p-4 bg-white rounded-lg shadow">
                            <img src="{!! Avatar::create($comment->email)->toGravatar(['d' => 'identicon']); !!}" alt="User profile picture"
                                 class="w-16 h-16 rounded-full">

                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800">{{$comment->name}}</h3>
                                <p class="text-gray-600">{{$comment->content}}</p>
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Comment Form -->
                <div class="mt-10 p-6 bg-white rounded-lg shadow max-w-4xl mx-auto">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">
                        Leave a Comment:
                    </h3>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                             role="alert">
                            <ul class="list-disc">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('names.comments.store', $data['nameDetails']) }}" method="POST">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                                <input type="text" id="name" name="name"
                                       class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"
                                       placeholder="Your name" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email (won't be displayed):
                                </label>
                                <input type="email" id="email" name="email"
                                       class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"
                                       placeholder="you@example.com" required>
                            </div>

                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
                                <textarea id="comment" name="content" rows="4"
                                          class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Add a comment..." required></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow-sm">
                                    Post Comment
                                </button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </section>

        </main>

        @include('partials.names._sidebar')
    </section>
@endsection

@php
    $generators = [
        'acronyms' => [
            'title' => 'Acronyms',
            'description' => 'Generate acronyms of the name.',
            'url' => route('api.names.generate.acronyms')
        ],
        'usernames' => [
            'title' => 'Usernames',
            'description' => 'Generate usernames of the name.',
            'url' => route('api.names.generate.usernames')
        ],
        'fancy-texts' => [
            'title' => 'Fancy Texts',
            'description' => 'Generate fancy texts of the name.',
            'url' => route('api.names.generate.fancy-texts')
        ],
    ];
@endphp

@pushonce('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            @foreach($generators as $key=>$generator)
                $('#generate-{{$key}}').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '/api/names/generate/{{$key}}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: '{{ $data['nameDetails']->name }}'
                        },
                        success: function(response) {
                            $('#{{$key}}').html(response);
                        }
                    });
                });
            @endforeach
        });
    </script>
@endpushonce
