<aside class="w-full lg:w-1/3 md:px-4">
    <div class="shadow mb-6 p-6 rounded-lg border dark:border-base-700">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">
            Generate Random Name
        </h5>
        <p class="text-base-600 dark:text-base-300 mb-6">
            Click to generate a list of random names to make a better choice.
        </p>
        <a href="{{ route('names.random') }}"
           class="inline-flex items-center justify-center bg-gradient-to-r from-primary-500 to-primary-600 text-surface font-medium py-3 px-6 rounded-full hover:bg-gradient-to-l transition duration-300 ease-in-out uppercase text-sm lg:text-base">
            <i class="fas fa-dice mr-2"></i>
            <span>Randomize</span>
        </a>
    </div>

    <!-- Explore Baby Names -->
    <div class="shadow my-6 p-6 rounded-lg  border dark:border-base-700">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">
            Explore Baby Names
        </h5>
        <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0 md:justify-between mt-4">
            <a href="{!! route('names.gender',['gender'=>'masculine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-sky-500 dark:bg-sky-400 text-surface rounded-r-full px-4 py-2">
                    <i class="fas fa-mars dark:text-base-800"></i>
                </span>
                <span class="ml-2 font-medium text-base-900 dark:text-base-100">Boy Names</span>
            </a>
            <a href="{!! route('names.gender',['gender'=>'feminine']) !!}" class="flex items-center transition duration-200 ease-in">
                <span class="bg-pink-500 dark:bg-pink-400 text-surface rounded-r-full px-4 py-2">
                    <i class="fas fa-venus dark:text-base-800"></i>
                </span>
                <span class="ml-2 font-medium text-base-900 dark:text-base-100">Girl Names</span>
            </a>
        </div>
    </div>
</aside>