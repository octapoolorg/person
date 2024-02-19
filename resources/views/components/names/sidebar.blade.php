<aside class="w-full lg:w-1/3 md:px-4">
    <!-- Explore Baby Names -->
    <div class="shadow mb-6 p-6 rounded-lg bg-surface dark:bg-base-800">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-400 mb-4">
            Explore Baby Names
        </h5>
        <p class="text-base-600 dark:text-base-300 mb-6">
            Find the perfect name for your baby.
        </p>
        <a href="{{ route('names.search') }}"
           class="inline-flex items-center justify-center bg-gradient-to-r from-primary-500 to-primary-600 text-surface font-medium py-3 px-6 rounded-full hover:bg-gradient-to-l transition duration-300 ease-in-out uppercase text-sm lg:text-base">
            <i class="fas fa-search mr-2"></i>
            <span>
                Explore Names
            </span>
        </a>
    </div>

    <div class="shadow mb-6 p-6 rounded-lg bg-surface dark:bg-base-800 sticky top-10">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-4 capitalize">
            Explore Names by gender
        </h5>
        <div class="flex flex-col gap-2">
            <a href="{!! route('names.search', ['gender' => 'masculine']) !!}"
                class="flex items-center justify-between transition duration-300 ease-in-out bg-sky-600 hover:bg-sky-700 rounded-lg hover:shadow-md dark:bg-sky-700 dark:hover:bg-sky-800 p-3">
                <div class="flex items-center">
                    <span class="bg-surface dark:bg-base-700 text-sky-600 dark:text-sky-200 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-mars text-xl"></i>
                    </span>
                    <span class="ml-3 font-semibold text-surface dark:text-base-200">Masculine Names</span>
                </div>
                <i class="fas fa-arrow-right text-surface dark:text-base-200"></i>
            </a>
            <a href="{!! route('names.search', ['gender' => 'feminine']) !!}"
                class="flex items-center justify-between transition duration-300 ease-in-out bg-pink-600 hover:bg-pink-700 rounded-lg hover:shadow-md dark:bg-pink-700 dark:hover:bg-pink-800 p-3">
                <div class="flex items-center">
                    <span class="bg-surface dark:bg-base-700 text-pink-600 dark:text-pink-200 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-venus text-xl"></i>
                    </span>
                    <span class="ml-3 font-semibold text-surface dark:text-base-200">Feminine Names</span>
                </div>
                <i class="fas fa-arrow-right text-surface dark:text-base-200"></i>
            </a>
        </div>
    </div>
</aside>
