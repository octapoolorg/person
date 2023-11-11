<aside class="w-full lg:w-1/3 px-4">
    <div class="bg-white shadow-md mb-6 p-6 rounded-lg">
        <h5 class="text-xl font-bold text-indigo-600 mb-4">Generate Random Name</h5>
        <p class="text-gray-600 mb-6">Click to generate a list of random names to make a better choice.</p>
        <a href="{{ route('names.random') }}"
           class="inline-flex items-center justify-center bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium py-3 px-6 rounded-full hover:bg-gradient-to-l transition duration-300 ease-in-out uppercase text-sm lg:text-base">
            <i class="fas fa-dice mr-2"></i>
            <span>Randomize</span>
        </a>
    </div>

    <div class="bg-white shadow-md my-6 p-6 rounded">
        <h5 class="text-xl font-bold text-indigo-600 mb-4">Follow Us on Social</h5>
        <div class="flex justify-around mt-4 space-x-4">
            <a href="https://www.facebook.com/identeez/" class="group hover:opacity-70 transition duration-200 ease-in"
               title="Follow us on Facebook" target="_blank">
                <img src="{!! asset('static/images/facebook-new.png') !!}" alt="Facebook"
                     class="group-hover:scale-110 transform transition-transform duration-150" />
            </a>
            {{-- <a href="#" class="group hover:opacity-70 transition duration-200 ease-in"
               title="Follow us on Instagram">
                <img src="{!! asset('static/images/instagram-new--v1.png') !!}" alt="Instagram"
                     class="group-hover:scale-110 transform transition-transform duration-150" target="_blank"/>
            </a> --}}
            <a href="https://pinterest.com/identeez" class="group hover:opacity-70 transition duration-200 ease-in"
               title="Follow us on Pinterest" target="_blank">
                <img src="{!! asset('static/images/pinterest--v1.png') !!}" alt="Pinterest"
                     class="group-hover:scale-110 transform transition-transform duration-150" />
            </a>
        </div>
    </div>

    <!-- Explore Baby Names -->
    <div class="bg-white shadow-md my-6 p-6 rounded">
        <h5 class="text-xl font-bold text-indigo-600 mb-4">
            Explore Baby Names
        </h5>
        <div class="flex justify-between mt-4">
            <a href="{!! route('names.gender',['gender'=>'masculine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-teal-500 text-white rounded-r-full px-4 py-2">
                    <i class="fas fa-male fa-lg"></i>
                </span>
                <span class="ml-2 font-medium">Boy Names</span>
            </a>
            <a href="{!! route('names.gender',['gender'=>'feminine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-pink-500 text-white rounded-r-full px-4 py-2">
                    <i class="fas fa-female fa-lg"></i>
                </span>
                <span class="ml-2 font-medium">Girl Names</span>
            </a>
        </div>
    </div>
</aside>
