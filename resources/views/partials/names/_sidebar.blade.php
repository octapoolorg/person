<aside class="w-full lg:w-1/3 md:px-4">
    <div class="shadow mb-6 p-6 rounded-lg border dark:border-base-700">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">Generate Random Name</h5>
        <p class="text-base-600 dark:text-base-300 mb-6">Click to generate a list of random names to make a better choice.</p>
        <a href="{{ route('names.random') }}"
           class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-primary-600 text-surface font-medium py-3 px-6 rounded-full hover:bg-gradient-to-l transition duration-300 ease-in-out uppercase text-sm lg:text-base">
            <svg class="fill-surface mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M274.9 34.3c-28.1-28.1-73.7-28.1-101.8 0L34.3 173.1c-28.1 28.1-28.1 73.7 0 101.8L173.1 413.7c28.1 28.1 73.7 28.1 101.8 0L413.7 274.9c28.1-28.1 28.1-73.7 0-101.8L274.9 34.3zM200 224a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM96 200a24 24 0 1 1 0 48 24 24 0 1 1 0-48zM224 376a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM352 200a24 24 0 1 1 0 48 24 24 0 1 1 0-48zM224 120a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm96 328c0 35.3 28.7 64 64 64H576c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H461.7c11.6 36 3.1 77-25.4 105.5L320 413.8V448zM480 328a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
            <span>Randomize</span>
        </a>
    </div>

    <div class="shadow my-6 p-6 rounded-lg  border dark:border-base-700">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">Follow Us on Social</h5>
        <div class="flex justify-around mt-4 space-x-4">
            <a href="https://www.facebook.com/identeezofficial/" class="group hover:opacity-70 transition duration-200 ease-in"
               title="Follow us on Facebook" target="_blank">
                <img src="{!! asset('static/images/facebook-new.png') !!}" alt="Facebook"
                     class="group-hover:scale-110 transform transition-transform duration-150" />
            </a>
            <a href="https://pinterest.com/identeez" class="group hover:opacity-70 transition duration-200 ease-in"
               title="Follow us on Pinterest" target="_blank">
                <img src="{!! asset('static/images/pinterest--v1.png') !!}" alt="Pinterest"
                     class="group-hover:scale-110 transform transition-transform duration-150" />
            </a>
        </div>
    </div>

    <!-- Explore Baby Names -->
    <div class="shadow my-6 p-6 rounded-lg  border dark:border-base-700">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">
            Explore Baby Names
        </h5>
        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0 md:justify-between mt-4">
            <a href="{!! route('names.gender',['gender'=>'masculine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-teal-500 dark:bg-teal-400 text-surface rounded-r-full px-4 py-2">
                    <svg class="fill-surface dark:fill-base-800 w-5 h-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z"/></svg>
                </span>
                <span class="ml-2 font-medium text-base-900 dark:text-base-100">Boy Names</span>
            </a>
            <a href="{!! route('names.gender',['gender'=>'feminine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-pink-500 dark:bg-pink-400 text-surface rounded-r-full px-4 py-2">
                    <svg class="fill-surface dark:fill-base-800 w-5 h-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 0c35.346 0 64 28.654 64 64s-28.654 64-64 64c-35.346 0-64-28.654-64-64S92.654 0 128 0m119.283 354.179l-48-192A24 24 0 0 0 176 144h-11.36c-22.711 10.443-49.59 10.894-73.28 0H80a24 24 0 0 0-23.283 18.179l-48 192C4.935 369.305 16.383 384 32 384h56v104c0 13.255 10.745 24 24 24h32c13.255 0 24-10.745 24-24V384h56c15.591 0 27.071-14.671 23.283-29.821z"/></svg>
                </span>
                <span class="ml-2 font-medium text-base-900 dark:text-base-100">Girl Names</span>
            </a>
        </div>
    </div>
</aside>
