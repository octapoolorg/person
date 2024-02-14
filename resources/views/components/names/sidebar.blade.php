<aside class="w-full lg:w-1/3 md:px-4">
    <!-- Explore Baby Names -->
    <div class="shadow mb-6 p-6 rounded-lg bg-surface dark:bg-base-800 sticky top-10">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-4 capitalize">
            Explore Names by gender
        </h5>
        <div class="flex flex-col gap-2">
            <a href="{!! route('names.gender', ['gender' => 'masculine']) !!}"
                class="flex items-center justify-between transition duration-300 ease-in-out bg-sky-600 hover:bg-sky-700 rounded-lg hover:shadow-md dark:bg-sky-700 dark:hover:bg-sky-800 p-3">
                <div class="flex items-center">
                    <span class="bg-surface dark:bg-base-700 text-sky-600 dark:text-sky-200 rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-mars text-xl"></i>
                    </span>
                    <span class="ml-3 font-semibold text-surface dark:text-base-200">Masculine Names</span>
                </div>
                <i class="fas fa-arrow-right text-surface dark:text-base-200"></i>
            </a>
            <a href="{!! route('names.gender', ['gender' => 'feminine']) !!}"
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
