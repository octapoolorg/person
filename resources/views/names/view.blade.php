@extends('layouts.main')

@section('content')
    <section class="flex flex-wrap mb-12">
        <main class="lg:w-2/3">
            <section>
                <div class="p-12 bg-gradient-to-r from-[#YourTertiaryBodyColorStart] to-[#YourTertiaryBodyColorEnd] text-gray-800 rounded-lg shadow-lg">
                    <div class="container py-12 text-center">
                        <!-- Title -->
                        <h1 class="text-6xl font-extrabold text-blue-500 mb-4 capitalize tracking-wider">
                            {!! $data['nameDetails']->name !!}
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-2xl text-gray-600 mb-6 italic">Means</p>

                        <!-- Decorative Elements -->
                        <div class="mb-8 flex justify-center space-x-4">
                            <span class="text-4xl text-blue-500">❀</span>
                            <span class="text-4xl text-blue-500">❀</span>
                            <span class="text-4xl text-blue-500">❀</span>
                        </div>

                        <!-- Name Meaning -->
                        <h2 class="text-4xl text-green-500 mb-8 font-semibold tracking-wide">
                            {!! $data['nameDetails']->meaning !!}
                        </h2>
                    </div>

                    <!-- Gender -->
                    <div class="text-right pr-8">
                        <p class="text-2xl font-medium italic text-gray-600">
                            It is a {!! $data['nameDetails']->gender->name !!} name.
                        </p>
                    </div>
                </div>
            </section>

            <section class="p-4 border shadow-sm mb-10">
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

            <section class="mb-10">
                <h2 class="text-2xl font-semibold mb-6">Details about {!! $data['nameDetails']->name !!} name</h2>

                <h3 class="text-xl font-medium my-4">{!! $data['nameDetails']->name !!} Name Numerology</h3>
                <p class="text-base leading-relaxed mb-4">
                    Assigning a specific color to each number can help users quickly identify and resonate with
                    their numerology number. Here's a potential color association, though the choices are subjective
                    and can be adjusted.
                </p>

                <h3 class="text-lg font-medium my-4">Numerology Number - {!! $data['numerology']['numbers']['destiny'] !!}</h3>
                <p class="bg-blue-100 p-4 rounded mb-4">
                    {!! __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], [
                        'name' => $data['nameDetails']->name,
                    ]) !!}
                </p>

                <h3 class="text-lg font-medium my-4">Soul Number - {!! $data['numerology']['numbers']['soul'] !!}</h3>
                <p class="bg-blue-100 p-4 rounded mb-4">
                    {!! __('numerology.soul.' . $data['numerology']['numbers']['soul'], ['name' => $data['nameDetails']->name]) !!}
                </p>

                <h3 class="text-lg font-medium my-4">Personality Number - {!! $data['numerology']['numbers']['personality'] !!}</h3>
                <p class="bg-blue-100 p-4 rounded mb-4">
                    {!! __('numerology.personality.' . $data['numerology']['numbers']['personality'], [
                        'name' => $data['nameDetails']->name,
                    ]) !!}
                </p>
            </section>


            <table class="min-w-full my-12 bg-white border-collapse">
                <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-4">Image</th>
                    <th class="border border-gray-300 p-4">Attribute</th>
                    <th class="border border-gray-300 p-4">Detail</th>
                </tr>
                </thead>
                <tbody>
                <!-- Row 1: Ruling Hours -->
                <tr class="text-center bg-white">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                 class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Ruling Hours</td>
                    <td class="border border-gray-300 p-4 text-blue-500">7am ~ 9am</td>
                </tr>
                <!-- Row 2: Lucky Days -->
                <tr class="text-center bg-gray-50">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt=""
                                 class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Lucky Days</td>
                    <td class="border border-gray-300 p-4 text-blue-500">Tuesday, Thursday</td>
                </tr>
                <!-- Row 3: Passion -->
                <tr class="text-center bg-white">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" alt=""
                                 class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Passion</td>
                    <td class="border border-gray-300 p-4 text-blue-500">To lead the way for others</td>
                </tr>
                <!-- Row 4: Life Pursuit -->
                <tr class="text-center bg-gray-50">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                 class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Life Pursuit</td>
                    <td class="border border-gray-300 p-4 text-blue-500">The thrill of the moment</td>
                </tr>
                <!-- Row 5: Vibration -->
                <tr class="text-center bg-white">
                    <td class="border border-gray-300 p-4">
                        <div class="flex items-center justify-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt=""
                                 class="w-12 h-12 rounded-full"/>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-4">Vibration</td>
                    <td class="border border-gray-300 p-4 text-blue-500">Enthusiastic</td>
                </tr>
                </tbody>
            </table>

            <!-- Abbreviation section -->
            <h2 class="my-6 text-xl font-bold">Abbreviation of {!! $data['nameDetails']->name !!}</h2>
            <div class="border border-gray-300 rounded-md shadow-md mb-12">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white">
                    <tr class="bg-gray-50">
                        <th class="p-4 text-left border border-gray-300">A</th>
                        <td class="p-4 text-left border border-gray-300">Awesome</td>
                    </tr>
                    <tr class="bg-white">
                        <th class="p-4 text-left border border-gray-300">L</th>
                        <td class="p-4 text-left border border-gray-300">Lion</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-4 text-left border border-gray-300">I</th>
                        <td class="p-4 text-left border border-gray-300">Intelligent</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Wallpaper section -->
            <h2 class="font-bold text-blue-500 text-xl my-6">{!! $data['nameDetails']->name !!} Name Wallpaper</h2>
            <img src="{!! route('nameWallpaper',['name'=>$data['nameDetails']->slug]) !!}"
                 class="rounded-lg my-8 shadow-lg w-full object-cover h-60" alt="{!! $data['nameDetails']->name !!}">
            <p class="text-gray-400 my-8">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus repellat,
                quis consequatur totam earum numquam cumque quas. Fugit, quasi minima.</p>

            <!-- Fancy Text Styles section -->
            <h2 class="font-bold text-blue-500 text-xl my-6">{!! $data['nameDetails']->name !!} - Fancy Text Styles</h2>
            <p class="text-gray-400 my-8">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, fugiat!</p>

            <div class="border border-gray-300 rounded-md shadow-md mb-12">
                <table class="min-w-full divide-y divide-gray-200 cursor-pointer bg-white hover:shadow-lg" id="fancyTextTable">
                    <tbody>
                    @foreach ($data['fancyTexts'] as $key => $fancyText)
                        <tr onclick="copyToClipboard(event)" class="{{ $key % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                            <th scope="row" class="text-lg p-4 hover:bg-gray-200 transition ease-in-out duration-150">
                                {{ $fancyText }}
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- FAQ Section -->
            <div class="space-y-6" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="my-8 text-2xl font-semibold">
                    Frequently asked questions (FAQ) about {!! $data['nameDetails']->name !!}
                </h2>
                <div class="space-y-2 mb-6 border-l-4 border-blue-500 pl-2">
                    <div class="flex items-center" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span class="text-lg font-bold pr-2">Q:</span>
                        <span itemprop="name">What does the name {!! $data['nameDetails']->name !!} specifically mean?</span>
                    </div>
                    <div class="flex items-center pl-8" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span class="text-lg font-bold pr-2">A:</span>
                        <span itemprop="text">{!! $data['nameDetails']->meaning !!}</span>
                    </div>
                </div>
            </div>

            <!-- Social Share Section -->
            <section class="space-y-4 my-8">
                <div class="flex space-x-4">
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text=url-current-page"
                       class="px-4 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600"
                       target="_blank" rel="nofollow">
                        <i class="fab fa-twitter"></i> Tweet
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
                       class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600"
                       target="_blank" rel="nofollow" title='via email'>
                        <i class="fas fa-envelope"></i> Share
                    </a>
                </div>
            </section>


            <!-- User Comments Section -->
            <section class="space-y-8 bg-gray-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold mb-4 flex items-center text-blue-600">
                    <i class="fas fa-comments mr-2 text-blue-500"></i>
                    User Comments About {!! $data['nameDetails']->name !!}
                </h4>

                <!-- Single Comment -->
                <div class="flex space-x-4 my-2 bg-white p-4 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/50x50" alt="User Image" class="rounded-full">
                    </div>
                    <div class="flex-grow">
                        <h6 class="text-md font-semibold flex items-center text-gray-700">
                            <i class="fas fa-user mr-2"></i>
                            {!! $data['nameDetails']->name !!}
                        </h6>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-comment mr-2"></i>
                            This is some content from a media component.
                            You can replace this with any content and
                            adjust it as needed.
                        </p>
                    </div>
                </div>

                <!-- Add a Comment -->
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div class="bg-gray-200 text-lg font-semibold p-2 rounded-t-lg flex items-center text-gray-700">
                        <i class="fas fa-pencil-alt mr-2"></i>
                        Add a comment
                    </div>
                    <div class="p-4">
                        <form class="space-y-4">
                            <!-- Name -->
                            <div class="flex flex-col">
                                <label for="name" class="block text-sm font-medium text-gray-600 mb-1">
                                    <i class="fas fa-user mr-2 text-gray-500"></i> Name
                                </label>
                                <input type="text" id="name" placeholder="Enter your name" class="form-input block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col">
                                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">
                                    <i class="fas fa-envelope mr-2 text-gray-500"></i> Email
                                </label>
                                <input type="email" id="email" placeholder="Enter your email" class="form-input block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Comment -->
                            <div class="flex flex-col">
                                <label for="comment" class="block text-sm font-medium text-gray-600 mb-1">
                                    <i class="fas fa-comment-dots mr-2 text-gray-500"></i> Comment
                                </label>
                                <textarea id="comment" placeholder="Enter your comment" class="form-textarea block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="3"></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="col-12">
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring-blue-500 focus:ring-opacity-50">
                                    <i class="fas fa-paper-plane mr-2"></i> Submit comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </main>
        <aside class="lg:w-1/4">
            <!-- Generate Random Name -->
            <div class="bg-white shadow-md my-6 p-6 rounded-lg">
                <h5 class="text-xl font-bold text-blue-600 mb-2">Generate Random Name</h5>
                <p class="text-gray-500 mb-3">Click to generate a list of random names to make a better choice.</p>
                <a href="#" class="bg-blue-500 text-white p-3 rounded-full inline-flex items-center hover:bg-blue-600 transition duration-200 ease-in uppercase">
                    <!-- Insert shuffle icon here -->
                    <span class="ml-2">Randomize</span>
                </a>
            </div>

            <!-- Follow Us on Social -->
            <div class="bg-white shadow-md my-6 p-6 rounded-lg">
                <h5 class="text-xl font-bold text-blue-600 mb-2">Follow Us on Social</h5>
                <div class="flex justify-around mt-3">
                    <a href="" class="hover:opacity-70 transition duration-200 ease-in">
                        <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook"/>
                    </a>
                    <a href="" class="hover:opacity-70 transition duration-200 ease-in">
                        <img src="https://img.icons8.com/color/48/000000/instagram-new--v1.png" alt="Instagram"/>
                    </a>
                    <a href="" class="hover:opacity-70 transition duration-200 ease-in">
                        <img src="https://img.icons8.com/color/48/000000/pinterest--v1.png" alt="Pinterest"/>
                    </a>
                </div>
            </div>

            <!-- Popular Baby Names -->
            <div class="bg-white shadow-md my-6 p-6 rounded-lg">
                <h5 class="text-xl font-bold text-blue-600 mb-2">Popular Baby Names</h5>
                <div class="flex flex-wrap justify-around mt-3">
                    <a href="" class="flex items-center hover:underline hover:text-blue-500 transition duration-200 ease-in">
                        <!-- Insert male icon here with custom background -->
                        <span class="text-center ml-3">Boy Names</span>
                    </a>
                    <a href="" class="flex items-center hover:underline hover:text-blue-500 transition duration-200 ease-in">
                        <!-- Insert female icon here with custom background -->
                        <span class="text-center ml-3">Girl Names</span>
                    </a>
                </div>
            </div>
        </aside>
    </section>
@endsection
