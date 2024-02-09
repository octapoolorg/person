<section
    class="bg-base-100 dark:bg-base-800 px-4 py-10 md:p-16 rounded-lg shadow-lg overflow-hidden relative text-base-900 dark:text-base-100 border dark:border-base-700">
    <article class="text-center">
        <header>
            <h1 class="text-4xl md:text-7xl font-bold mb-6 tracking-tight text-base-900 dark:text-base-100"
                id="actual-name">
                {{ $data['nameDetails']->name }}
            </h1>
        </header>

        <div class="flex flex-col items-center space-y-6 mt-10 mb-20 md:mb-16 relative">
            <strong
                class="text-xl md:text-3xl font-semibold uppercase text-base-900 dark:text-base-100">Means:</strong>
            <p
                class="text-xl md:text-2xl leading-relaxed md:mx-6 capitalize text-base-900 dark:text-base-100">
                {{ $data['nameDetails']->meaning }}
            </p>
            @if ($data['nameDetails']->generated > 0)
                <div class="group absolute -bottom-5 md:-bottom-10 right-0 mb-2 mr-2 flex items-center">
                    <!-- SVG Icon -->
                    <svg class="fill-primary-500 dark:fill-primary-300 cursor-pointer"
                        xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                    </svg>

                    <!-- Tooltip Text -->
                    <span
                        class="absolute bottom-full mb-2 right-0 bg-black text-surface text-xs rounded py-1 px-3 hidden group-hover:block">
                        Based on Numerology.
                    </span>
                </div>
            @endif
        </div>
    </article>

    <footer
        class="absolute bottom-0 left-0 w-full bg-primary-700 dark:bg-primary-800 text-base-100 text-center py-4 md:py-6 border-t border-primary-800 dark:border-primary-700">
        <p class="text-lg md:text-xl font-bold md:text-end md:mr-5">
            <span class="font-normal not-italic">Gender:</span> {{ $data['nameDetails']->gender->name }}
        </p>
    </footer>

    <!-- Favorite Icon -->
    <div class="absolute top-0 right-0 mt-4 mr-4 flex items-center space-x-4">
        <a href="javascript:" id="favorite-name"
            class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center">
            <span class="hidden group-hover:inline-block px-2">Add to favorites</span>
            <i
                class="far fa-heart text-xl group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
        </a>
    </div>
</section>