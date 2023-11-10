@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12">
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
                    <p class="text-lg md:text-xl font-bold italic">
                        A {{ $data['nameDetails']->gender->name }} name.
                    </p>
                </footer>
            </section>

            <section class="shadow-sm my-10">
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

            <section class="p-4 md:p-8 border mb-10">
                <h2 class="text-2xl mb-6">Signatures for {{ $data['nameDetails']->name }}</h2>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    @foreach ($data['signatureUrls'] as $font => $url)
                        <img src="{{ $url }}" alt="Signature with font {{ $font }}"
                            class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1">
                    @endforeach
                </div>
            </section>

            <!-- Numerology Details with Illustrations -->
            <section class="bg-white p-10 rounded-lg shadow-lg mb-10 border border-gray-300">
                <h2 class="text-4xl text-gray-800 mb-8 font-bold">{{ $data['nameDetails']->name }} Name Numerology</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    Each numerology number is associated with a specific color to aid in quick identification and resonance. Here's a guide to these color associations, personalized for the name.
                </p>

                <div class="flex flex-wrap -mx-4 text-center">
                    <!-- Destiny Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="p-6 bg-indigo-50 rounded-xl shadow-inner">
                            <img src="{{ asset('static/images/zodiac/numerology/numerology-icon.png') }}" alt="Destiny Icon" class="w-12 h-12 mx-auto mb-4">
                            <h3 class="text-2xl font-semibold text-indigo-700 mb-4">Numerology Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Soul Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="p-6 bg-green-50 rounded-xl shadow-inner">
                            <img src="{{ asset('static/images/zodiac/numerology/soul-icon.png') }}" alt="Soul Icon" class="w-12 h-12 mx-auto mb-4">
                            <h3 class="text-2xl font-semibold text-green-700 mb-4">Soul Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.soul.' . $data['numerology']['numbers']['soul'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Personality Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="p-6 bg-yellow-50 rounded-xl shadow-inner">
                            <img src="{{ asset('static/images/zodiac/numerology/personality-icon.png') }}" alt="Personality Icon" class="w-12 h-12 mx-auto mb-4">
                            <h3 class="text-2xl font-semibold text-yellow-700 mb-4">Personality Number</h3>
                            <p class="text-gray-700">
                                {{ __('numerology.personality.' . $data['numerology']['numbers']['personality'], ['name' => $data['nameDetails']->name]) }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Abbreviation section -->
            <section class="">
                <div class="flex items-center justify-between md:justify-start">
                    <h2 class="text-3xl text-gray-700 my-6 capitalize font-bold">
                        Acronyms of {!! $data['nameDetails']->name !!}
                    </h2>
                    <span class="ml-5">
                        <a href="#" class="transition-colors duration-300 text-green-800 hover:text-green-900"
                            aria-label="Generate another acronym list">
                            Generate another <i class="fas fa-refresh" aria-hidden="true"></i>
                        </a>
                    </span>
                </div>
                <div class="rounded-lg shadow-md overflow-hidden mb-12">
                    <table class="w-full text-sm md:text-base">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($data['traits'] as $alphabet => $trait)
                                <tr class="bg-gray-50 hover:bg-gray-100">
                                    <th class="p-4 text-left font-semibold bg-gray-200 uppercase">{{ $alphabet }}</th>
                                    <td class="p-4 text-left">{{ $trait }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <table class="min-w-full my-12 bg-white border-collapse shadow rounded overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="border-b-2 border-gray-300 p-4 text-left">Image</th>
                        <th scope="col" class="border-b-2 border-gray-300 p-4 text-left">Attribute</th>
                        <th scope="col" class="border-b-2 border-gray-300 p-4 text-left">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows: Attributes -->
                    @foreach (['Ruling Hours', 'Lucky Days', 'Passion', 'Life Pursuit', 'Vibration'] as $index => $attribute)
                        <tr
                            class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-200 transition-colors duration-300">
                            <td class="border border-gray-300 p-4">
                                <div class="flex items-center justify-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="{{ $attribute }} icon"
                                        class="w-12 h-12 rounded-full" />
                                </div>
                            </td>
                            <td scope="row" class="border border-gray-300 p-4 text-gray-700">{{ $attribute }}</td>
                            <td class="border border-gray-300 p-4 text-indigo-500">indigo {{ $index }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Wallpaper section -->
            <section class="text-gray-900">
                <h2 class="text-3xl text-gray-700 font-bold my-6">{{ $data['nameDetails']->name }} Name Wallpaper</h2>
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
            <section class="text-gray-800">
                <h2 class="text-3xl text-gray-700 font-bold my-6">{{ $data['nameDetails']->name }} - Fancy Text Styles</h2>
                <p class="my-4 sm:my-8 text-lg leading-relaxed">
                    Experience the elegance of {{ $data['nameDetails']->name }}
                    presented in various distinctive text styles. Each style is crafted
                    to highlight the uniqueness of the name, adding a touch of sophistication
                    and charm to your content.
                </p>
                <div class="overflow-x-auto">
                    <div class="border border-gray-300 rounded shadow mb-12">
                        <ul class="divide-y divide-gray-200 bg-white hover:shadow-sm" id="fancyTextList">
                            @foreach ($data['fancyTexts'] as $key => $fancyText)
                                <li tabindex="0"
                                    class="text-lg p-6 hover:bg-gray-200 focus:bg-gray-200 transition ease-in-out duration-150 cursor-pointer"
                                    role="button" aria-label="Select {{ $fancyText }} style"
                                    onclick="copyToClipboard('{{ $fancyText }}')">
                                    {{ $fancyText }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>


            <!-- FAQ Section -->
            <section class="py-10" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="mb-8 text-3xl text-gray-700 font-bold">
                    Frequently Asked Questions about {{ $data['nameDetails']->name }}
                </h2>

                <div class="mx-auto bg-white p-6 rounded-lg shadow-lg space-y-6">
                    <!-- Question 1 -->
                    <div class="space-y-4">
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <h3 class="text-lg text-gray-800 flex items-center">
                                <i class="fas fa-question-circle text-indigo-500 mr-3" aria-hidden="true"></i>
                                What does the name {{ $data['nameDetails']->name }} mean?
                            </h3>
                        </div>
                        <p class="text-gray-600 pl-8" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            {{ $data['nameDetails']->meaning }}
                        </p>
                    </div>

                    <!-- Question 2 and others would follow the same structure -->
                </div>
            </section>


            <!-- Social Share Section -->
            <section class="my-8">
                <div class="flex flex-wrap justify-center md:justify-start gap-2 sm:gap-4">
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={!! request()->url() !!}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-900 text-white rounded-full hover:bg-gray-950"
                        target="_blank" rel="nofollow">
                        <i class="fab fa-x-twitter"></i> Share
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={!! request()->url() !!}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600"
                        target="_blank" rel="nofollow">
                        <i class="fab fa-facebook-f"></i> Share
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/cws/share?url={!! request()->url() !!}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800"
                        target="_blank" rel="nofollow">
                        <i class="fab fa-linkedin-in"></i> Share
                    </a>
                    <!-- Reddit -->
                    <a href="http://www.reddit.com/submit?url={!! request()->url() !!}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-red-500 text-white rounded-full hover:bg-red-600"
                        target="_blank" rel="nofollow">
                        <i class="fab fa-reddit-alien"></i> Share
                    </a>
                    <!-- Mail -->
                    <a href="mailto:?subject={!! $data['nameDetails']->name !!} name details - all you need to know&amp;body={!! request()->url() !!}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-500 text-white rounded-full hover:bg-gray-600"
                        target="_blank" rel="nofollow" title="Share via email">
                        <i class="fas fa-envelope"></i> Share
                    </a>
                </div>
            </section>

            <!-- Comments Section -->
            <section class="py-10 w-full"> <!-- Full width section -->
                <h2 class="mb-6 text-3xl font-semibold text-center text-gray-800 lg:text-4xl">Comments</h2>

                <div class="space-y-6 max-w-4xl mx-auto"> <!-- Centered with max width for large screens -->
                    <!-- Single Comment -->
                    <article class="flex space-x-4 p-4 bg-white rounded-xl shadow-md">
                        <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="User profile picture"
                            class="w-16 h-16 rounded-full">

                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-800">User Name</h3>
                            <p class="text-gray-600">This is a comment about the post. It's a sample text to show how the comment will look.</p>
                            <!-- Time and date of comment could also be included here -->
                        </div>
                    </article>
                    <!-- Additional comments will be similarly structured -->
                </div>

                <!-- Comment Form -->
                <div class="mt-10 p-6 bg-white rounded-xl shadow-md max-w-4xl mx-auto">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">
                        Leave a Comment:
                    </h3>

                    <form action="/post-comment" method="POST"> <!-- Action should lead to your comment handling route -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                                <input type="text" id="name" name="name"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"
                                    placeholder="Your name" required> <!-- Consider adding 'required' if name is mandatory -->
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email (won't be displayed):
                                </label>
                                <input type="email" id="email" name="email"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"
                                    placeholder="you@example.com" required> <!-- Consider adding 'required' if email is mandatory -->
                            </div>

                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
                                <textarea id="comment" name="comment" rows="4"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Add a comment..." required></textarea> <!-- Consider adding 'required' if comment is mandatory -->
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
