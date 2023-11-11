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
                                {{ __('numerology.soul.' . $data['numerology']['numbers']['soul'], ['name' => $data['nameDetails']->name]) }}
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
                    <a href="#" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
                        Generate another
                        <i class="fas fa-refresh ml-2"></i>
                    </a>
                </div>
                <div class="overflow-hidden mb-12">
                    <table class="w-full text-left text-gray-600">
                        <tbody class="divide-y divide-gray-200">
                        @foreach ($data['traits'] as $alphabet => $trait)
                            <tr class="hover:bg-gray-50 transition-colors duration-300">
                                <th class="p-4 font-semibold text-gray-800 bg-gray-100 uppercase">{{ $alphabet }}</th>
                                <td class="p-4">{{ $trait }}</td>
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
                        <i class="fas fa-file-download ml-2"></i>
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
                <h2 class="text-4xl text-gray-800 font-bold mb-6">{{ $data['nameDetails']->name }} - Fancy Text Styles</h2>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Experience the elegance of {{ $data['nameDetails']->name }}
                    presented in various distinctive text styles. Each style is crafted
                    to highlight the uniqueness of the name, adding a touch of sophistication
                    and charm to your content.
                </p>
                <div class="overflow-x-auto">
                    <ul class="divide-y divide-gray-200 bg-white" id="fancyTextList">
                        @foreach ($data['fancyTexts'] as $fancyText)
                            <li tabindex="0"
                                class="text-lg p-4 hover:bg-gray-100 focus:bg-gray-100 transition ease-in-out duration-150 cursor-pointer"
                                aria-label="Select {{ $fancyText }} style"
                                onclick="copyToClipboard('{{ $fancyText }}')">
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
                    <!-- Question 1 -->
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

                    <!-- Question 2 -->
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

                    <!-- Question 3 -->
                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 itemprop="name" class="text-lg text-gray-800 font-bold py-4">
                            What are the numerology details of {{ $data['nameDetails']->name }}?
                        </h3>
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <p itemprop="text" class="text-gray-600">
                                According to numerology, the destiny number is {{ $data['numerology']['numbers']['destiny'] }}, the soul number is {{ $data['numerology']['numbers']['soul'] }}, and the personality number is {{ $data['numerology']['numbers']['personality'] }}.
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
