@extends('layouts.main')

@section('content')
    <section class="flex flex-wrap mb-12">
        <main class="lg:w-2/3 px-4">

            <section class="bg-gray-100 p-8 md:p-16 rounded shadow overflow-hidden relative text-gray-900 border">
                <article class="text-center">
                    <!-- Name -->
                    <header>
                        <h1 class="text-4xl md:text-7xl font-bold mb-8 md:mb-14 tracking-tight">
                            {{ $data['nameDetails']->name }}
                        </h1>
                    </header>

                    <!-- Meaning -->
                    <div class="flex flex-col items-center space-y-4 mt-8 mb-14">
                        <span class="text-xl md:text-3xl font-semibold uppercase">Means:</span>
                        <p class="text-xl md:text-2xl leading-relaxed">
                            {{ $data['nameDetails']->meaning }}
                        </p>
                    </div>
                </article>

                <footer class="absolute bottom-0 left-0 w-full bg-blue-700 text-gray-100 text-center py-6 border-t border-blue-800">
                    <p class="text-lg md:text-2xl font-bold italic">
                        A {{ $data['nameDetails']->gender->name }} name.
                    </p>
                </footer>
            </section>

            <section class="p-4 border shadow-sm my-10">
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
                    'img_src' => asset('static/images/zodiac/stones/citrine.png'),
                    'caption' => $data['numerology']['zodiac']['attributes']['stone'],
                ])
            </section>

            <section class="p-4 border mb-10">
                <h3 class="mb-6">Signatures for {{$data['nameDetails']->name}}</h3>
                <div class="flex justify-between">
                    @foreach ($data['signatureUrls'] as $font => $url)
                        <img src="{{ $url }}" alt="Signature with font {{ $font }}" class="w-1/4">
                    @endforeach
                </div>
            </section>

            <section class="bg-gray-100 p-8 rounded shadow mb-10 border">
                <h2 class="text-3xl font-bold mb-6">Details about {!! $data['nameDetails']->name !!} name</h2>

                <div class="my-6">
                    <h3 class="text-2xl font-semibold mb-4">{!! $data['nameDetails']->name !!} Name Numerology</h3>
                    <p class="text-lg leading-relaxed mb-4">
                        Assigning a specific color to each number can help users quickly identify and resonate with
                        their numerology number. Here's a potential color association, though the choices are subjective
                        and can be adjusted.
                    </p>
                </div>

                <!-- Numerology Details with Icons/Illustrations -->
                <div class="flex flex-wrap -mx-4">

                    <!-- Destiny Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8 flex flex-col justify-between">
                        <div class="flex items-start mb-4">
                            <img src="https://static-00.iconduck.com/assets.00/destiny-icon-512x475-qi0g8ih3.png" alt="Destiny Icon" class="w-12 h-12 mr-4">
                            <h3 class="text-2xl font-medium">Numerology Number</h3>
                        </div>
                        <div>
                            <p class="bg-blue-200 p-5 rounded text-gray-700">
                                {!! __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], [
                                    'name' => $data['nameDetails']->name,
                                ]) !!}
                            </p>
                        </div>
                    </div>

                    <!-- Soul Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8 flex flex-col justify-between">
                        <div class="flex items-start mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1820/1820124.png" alt="Soul Icon" class="w-12 h-12 mr-4">
                            <h3 class="text-2xl font-medium">Soul Number</h3>
                        </div>
                        <div>
                            <p class="bg-blue-200 p-5 rounded text-gray-700">
                                {!! __('numerology.soul.' . $data['numerology']['numbers']['soul'], ['name' => $data['nameDetails']->name]) !!}
                            </p>
                        </div>
                    </div>

                    <!-- Personality Number -->
                    <div class="w-full md:w-1/3 px-4 mb-8 flex flex-col justify-between">
                        <div class="flex items-start mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/6556/6556130.png" alt="Personality Icon" class="w-12 h-12 mr-4">
                            <h3 class="text-2xl font-medium">Personality Number</h3>
                        </div>
                        <div>
                            <p class="bg-blue-200 p-5 rounded text-gray-700">
                                {!! __('numerology.personality.' . $data['numerology']['numbers']['personality'], [
                                    'name' => $data['nameDetails']->name,
                                ]) !!}
                            </p>
                        </div>
                    </div>

                </div>
            </section>

            <section>
                <!-- Abbreviation section -->
                <h2 class="my-6 text-xl font-bold">Abbreviation of {!! $data['nameDetails']->name !!}</h2>
                <div class="rounded shadow mb-12">
                    <table class="min-w-full divide-y">
                        <tbody class="bg-white">
                        <tr class="bg-gray-50">
                            <th class="p-4 text-left border">A</th>
                            <td class="p-4 text-left border">Awesome</td>
                        </tr>
                        <tr class="bg-white">
                            <th class="p-4 text-left border">L</th>
                            <td class="p-4 text-left border">Lion</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <th class="p-4 text-left border">I</th>
                            <td class="p-4 text-left border">Intelligent</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </section>

            <table class="min-w-full my-12 bg-white border-collapse shadow rounded overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="border-b-2 border-gray-300 p-4">Image</th>
                    <th class="border-b-2 border-gray-300 p-4">Attribute</th>
                    <th class="border-b-2 border-gray-300 p-4">Detail</th>
                </tr>
                </thead>
                <tbody>
                <!-- Row 1: Ruling Hours -->
                <tr class="text-center bg-white hover:bg-gray-200 transition-colors duration-300">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Ruling Hours</td>
                    <td class="border border-gray-300 p-4 text-blue-500">7am ~ 9am</td>
                </tr>
                <!-- Row 2: Lucky Days -->
                <tr class="text-center bg-gray-50 hover:bg-gray-200 transition-colors duration-300">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="" class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Lucky Days</td>
                    <td class="border border-gray-300 p-4 text-blue-500">Tuesday, Thursday</td>
                </tr>
                <!-- Row 3: Passion -->
                <tr class="text-center bg-white hover:bg-gray-200 transition-colors duration-300">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" alt="" class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Passion</td>
                    <td class="border border-gray-300 p-4 text-blue-500">To lead the way for others</td>
                </tr>
                <!-- Row 4: Life Pursuit -->
                <tr class="text-center bg-gray-50 hover:bg-gray-200 transition-colors duration-300">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Life Pursuit</td>
                    <td class="border border-gray-300 p-4 text-blue-500">The thrill of the moment</td>
                </tr>
                <!-- Row 5: Vibration -->
                <tr class="text-center bg-white hover:bg-gray-200 transition-colors duration-300">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="" class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Vibration</td>
                    <td class="border border-gray-300 p-4 text-blue-500">Enthusiastic</td>
                </tr>
                </tbody>
            </table>

            <section class="text-gray-900">
                <!-- Wallpaper section -->
                <h2 class="font-bold text-xl my-6">{!! $data['nameDetails']->name !!} Name Wallpaper</h2>
                <img src="{!! route('nameWallpaper',['name'=>$data['nameDetails']->slug]) !!}"
                     class="rounded-lg my-8 shadow-lg w-full object-cover h-96"
                     alt="{!! $data['nameDetails']->name !!}">
                <p class="my-8">Discover the unique charm of the {!! $data['nameDetails']->name !!} name wallpaper. Every curve and detail of the design captures the essence of the name, making it a perfect backdrop for your devices. Elevate your screens with this blend of artistry and elegance.</p>
            </section>


            <section class="text-gray-800">
                <!-- Fancy Text Styles section -->
                <h2 class="font-bold text-xl my-6 text-left">{!! $data['nameDetails']->name !!} - Fancy Text Styles</h2>
                <p class="my-8 text-left">Experience the elegance of {!! $data['nameDetails']->name !!} presented in various distinctive text styles. Each style is crafted to highlight the uniqueness of the name, adding a touch of sophistication and charm to your content.</p>

                <div class="border border-gray-300 rounded shadow mb-12">
                    <table class="min-w-full divide-y divide-gray-200 cursor-pointer bg-white hover:shadow-sm" id="fancyTextTable">
                        <tbody>
                        @foreach ($data['fancyTexts'] as $key => $fancyText)
                            <tr onclick="copyToClipboard(event)">
                                <th scope="row" class="text-lg p-4 text-left border hover:bg-gray-200 transition ease-in-out duration-150">
                                    {{ $fancyText }}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>


            <!-- FAQ Section -->
            <section class="py-10" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="mb-8 text-3xl text-gray-700">
                    Frequently Asked Questions about {!! $data['nameDetails']->name !!}
                </h2>

                <div class="mx-auto bg-white p-6 rounded shadow space-y-6">
                    <!-- Question 1 -->
                    <div class="space-y-4">
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <h3 class="text-lg text-gray-800 flex items-center">
                                <i class="fas fa-question text-blue-500 mr-3"></i>
                                What does the name {!! $data['nameDetails']->name !!} mean?
                            </h3>
                        </div>
                        <p class="text-gray-600 pl-8" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            {!! $data['nameDetails']->meaning !!}
                        </p>
                    </div>

                    <!-- Question 2 -->
                    <div class="space-y-4">
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <h3 class="text-lg text-gray-800 flex items-center">
                                <i class="fas fa-question text-blue-500 mr-3"></i>
                                What does the name {!! $data['nameDetails']->name !!} mean?
                            </h3>
                        </div>
                        <p class="text-gray-600 pl-8" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            {!! $data['nameDetails']->meaning !!}
                        </p>
                    </div>

                    <!-- More questions can be added following the same structure -->
                </div>
            </section>


            <!-- Social Share Section -->
            <section class="space-y-4 my-8">
                <div class="flex space-x-4">
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text=url-current-page"
                       class="px-4 py-2 bg-gray-900 text-white rounded-full hover:bg-gray-950"
                       target="_blank" rel="nofollow">
                        <i class="fab fa-x-twitter"></i> Share
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=url-current-page"
                       class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600"
                       target="_blank" rel="nofollow">
                        <i class="fab fa-facebook-f"></i> Share
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/cws/share?url=url-current-page"
                       class="px-4 py-2 bg-blue-700 text-white rounded-full hover:bg-blue-800"
                       target="_blank" rel="nofollow">
                        <i class="fab fa-linkedin-in"></i> Share
                    </a>
                    <!-- Reddit -->
                    <a href="http://www.reddit.com/submit?url=url-current-page"
                       class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600"
                       target="_blank" rel="nofollow">
                        <i class="fab fa-reddit-alien"></i> Share
                    </a>
                    <!-- Mail -->
                    <a href="mailto:?subject={!! $data['nameDetails']->name !!} name - all you need to know&amp;body=url-current-page"
                       class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-600"
                       target="_blank" rel="nofollow" title='via email'>
                        <i class="fas fa-envelope"></i> Share
                    </a>
                </div>
            </section>

            <!-- Comments Section -->
            <section class="py-10 w-full"> <!-- full width section -->
                <h2 class="mb-6 text-3xl font-semibold text-center text-gray-800 lg:text-4xl">Comments</h2>

                <!-- Comment List -->
                <div class="space-y-6 max-w-4xl mx-auto"> <!-- Centered with max width for large screens -->
                    <!-- Individual Comment -->
                    <article class="flex space-x-4 p-4 bg-white rounded-xl shadow-md"> <!-- Semantic element for comment -->
                        <!-- Avatar -->
                        <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="User profile picture" class="w-16 h-16 rounded-full"> <!-- Descriptive alt text -->

                        <!-- Comment Content -->
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-800">User Name</h3>
                            <p class="text-gray-600">This is a comment about the post. It's a sample text to show how the comment will look.</p>
                        </div>
                    </article>
                    <!-- More comments -->
                </div>

                <!-- Comment Form -->
                <div class="mt-10 p-6 bg-white rounded-xl shadow-md max-w-4xl mx-auto"> <!-- Centered with max width for large screens -->
                    <h3 class="text-xl font-medium text-gray-800 mb-4">Leave a Comment:</h3>

                    <form action="" method="POST">
                        <div class="space-y-4">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Your name">
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email (won't be displayed):</label>
                                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" placeholder="you@example.com">
                            </div>

                            <!-- Comment Input -->
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
                                <textarea id="comment" name="comment" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Add a comment..."></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                                    Post Comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </main>

        <aside class="lg:w-1/3 px-4">
            <!-- Generate Random Name -->
            <div class="bg-white shadow-md my-6 p-6 rounded">
                <h5 class="text-xl font-bold text-blue-600 mb-4">Generate Random Name</h5>
                <p class="text-gray-500 mb-4">Click to generate a list of random names to make a better choice.</p>
                <a href="#" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-6 rounded-full inline-flex items-center hover:from-blue-600 hover:to-blue-700 transition duration-200 ease-in uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Randomize</span>
                </a>
            </div>

            <!-- Follow Us on Social -->
            <div class="bg-white shadow-md my-6 p-6 rounded">
                <h5 class="text-xl font-bold text-blue-600 mb-4">Follow Us on Social</h5>
                <div class="flex justify-around mt-4 space-x-4">
                    <a href="#" class="group hover:opacity-70 transition duration-200 ease-in" title="Follow us on Facebook">
                        <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook" class="group-hover:scale-110 transform transition-transform duration-150"/>
                    </a>
                    <a href="#" class="group hover:opacity-70 transition duration-200 ease-in" title="Follow us on Instagram">
                        <img src="https://img.icons8.com/color/48/000000/instagram-new--v1.png" alt="Instagram" class="group-hover:scale-110 transform transition-transform duration-150"/>
                    </a>
                    <a href="#" class="group hover:opacity-70 transition duration-200 ease-in" title="Follow us on Pinterest">
                        <img src="https://img.icons8.com/color/48/000000/pinterest--v1.png" alt="Pinterest" class="group-hover:scale-110 transform transition-transform duration-150"/>
                    </a>
                </div>
            </div>

            <!-- Popular Baby Names -->
            <div class="bg-white shadow-md my-6 p-6 rounded">
                <h5 class="text-xl font-bold text-blue-600 mb-4">Popular Baby Names</h5>
                <div class="flex flex-wrap justify-around mt-4">
                    <a href="#" class="flex items-center hover:underline hover:text-blue-500 transition duration-200 ease-in mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.121A8.015 8.015 0 0121 12H3"/>
                        </svg>
                        <span>Boy Names</span>
                    </a>
                    <a href="#" class="flex items-center hover:underline hover:text-blue-500 transition duration-200 ease-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-7 7-7-7"/>
                        </svg>
                        <span>Girl Names</span>
                    </a>
                </div>
            </div>
        </aside>

    </section>



@endsection
