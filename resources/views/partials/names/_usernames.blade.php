<section class="bg-white py-8 px-4 md:px-8 rounded-lg shadow my-10">
    <h2 class="text-4xl text-gray-800 font-bold capitalize mb-6">
        Usernames for {{ $data['nameDetails']->name }}
    </h2>
    <div class="mb-6">
        <p class="text-gray-600 text-base md:text-lg">
            Explore the availability of these usernames on various social media platforms. Click to check instantly.
        </p>
    </div>
    <div class="flex flex-col md:flex-row items-center justify-end mb-6">
        <a href="javascript:" id="generate-usernames" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-300 flex items-center">
            Generate new usernames
            <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
        </a>
    </div>
    <div class="flex flex-wrap gap-x-4 gap-y-8 mx-auto" id="usernames">
        @foreach ($data['userNames'] as $username)
            <div class="bg-gray-100 hover:bg-gray-200 rounded-lg px-5 py-4 flex items-center transition duration-300 w-full md:w-auto relative">
                <span class="text-lg font-medium text-gray-800 break-words mr-3 copy-to-clipboard">
                    {{ $username }}
                </span>
{{--                <form method="POST" class="flex items-center group">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="username" value="{{ $username }}">--}}
{{--                    <button type="submit" class="focus:outline-none flex items-center">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400 hover:fill-gray-600" viewBox="0 0 512 512">--}}
{{--                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>--}}
{{--                        </svg>--}}
{{--                        <span class="absolute bottom-full mb-2 ml-8 bg-black text-white text-xs rounded py-1 px-3 hidden group-hover:block w-32">--}}
{{--                            Check availability on top social media platforms--}}
{{--                        </span>--}}
{{--                    </button>--}}
{{--                </form>--}}
            </div>
        @endforeach
    </div>
</section>

{{--    Identities        --}}
{{--    https://tailwindcss.com/docs/hover-focus-and-other-states#differentiating-nested-groups        --}}
