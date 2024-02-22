<aside class="w-full lg:w-1/3 md:px-4 space-y-8">
    <!-- Explore Baby Names -->
    <div class="shadow mb-6 p-6 rounded-lg bg-surface dark:bg-base-800 border border-gray-200 dark:border-gray-700 transition-all">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-4">
            Explore Baby Names
        </h5>
        <p class="text-base-600 dark:text-base-300 mb-6">
            Find the perfect name for your baby with our comprehensive search.
        </p>
        <a href="{{ route('names.search') }}"
           class="inline-block bg-primary-500 dark:bg-primary-800 text-surface font-medium py-3 px-6 rounded-lg hover:bg-primary-600 dark:hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-700 transition duration-300 ease-in-out uppercase text-sm lg:text-base focus:outline-none">
            <span class="flex items-center justify-center">
                <i class="fas fa-search mr-2"></i>
                Explore Names
            </span>
        </a>
    </div>

    <!-- Trending Names -->
    <div class="shadow p-6 rounded-lg bg-surface dark:bg-base-800 border border-gray-200 dark:border-gray-700 transition-all sticky top-10">
        <h5 class="text-xl font-bold text-primary-600 dark:text-primary-500 mb-6">
            Trending Names
        </h5>
        <ul class="list-none pl-0 text-base-600 dark:text-base-300">
            @foreach($trendingNames->random(5) as $name)
                <li class="mb-4">
                    <a href="{{ route('names.show', $name->slug) }}" class="flex items-center justify-between text-lg font-medium hover:text-primary-600 dark:hover:text-primary-400 focus:text-primary-600 dark:focus:text-primary-400 transition duration-300 focus:outline-none">
                        {{ $name->name }}
                        <i class="fas fa-arrow-trend-up text-primary-500 dark:text-primary-400"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
