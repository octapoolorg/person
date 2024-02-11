<section class="bg-base-100 dark:bg-base-800 px-4 py-10 sm:p-10 md:p-16 lg:p-20 rounded-lg shadow-lg overflow-hidden relative text-base-900 dark:text-base-100 border dark:border-base-700">
    <article class="text-center" x-data="{}">
        <header>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-6 lg:mb-8 tracking-tight text-base-900 dark:text-base-100" id="actual-name" x-ref="actualname">
                {{ $name->name }}
                <span class="text-xl md:text-2xl lg:text-4xl font-normal text-primary-500 dark:text-primary-300" @click.prevent="SpeechManager.speak($refs.actualname.innerText.trim())">
                    <i class="fas fa-volume-up cursor-pointer hover:text-primary-600 dark:hover:text-primary-300"></i>
                </span>
            </h1>
        </header>

        <div class="flex flex-col items-center space-y-4 sm:space-y-5 md:space-y-6 mt-8 md:mt-10 lg:mt-12 mb-16 md:mb-18 lg:mb-20 relative">
            <strong class="text-lg md:text-xl lg:text-3xl font-semibold uppercase text-base-900 dark:text-base-100">
                    Means:
            </strong>
            <p id="actual-meaning" class="text-md md:text-lg lg:text-2xl capitalize text-base-900 dark:text-base-100 break-all">
                {{ $name->meaning }}
            </p>
            @if ($name->generated)
                <div class="group absolute -bottom-4 md:-bottom-5 lg:-bottom-10 right-0 mb-2 mr-2 flex items-center">
                    <i class="fas fa-circle-info cursor-pointer text-primary-500 dark:text-primary-300"></i>

                    <!-- Tooltip Text -->
                    <span class="absolute bottom-full mb-2 right-0 bg-black text-surface text-xs rounded py-1 px-3 hidden group-hover:block">
                        Based on Numerology.
                    </span>
                </div>
            @endif
        </div>
    </article>

    <footer class="absolute bottom-0 left-0 w-full bg-primary-700 dark:bg-primary-800 text-base-100 text-center py-3 md:py-4 lg:py-6 border-t border-primary-800 dark:border-primary-700">
        <p class="text-md md:text-lg lg:text-xl font-bold md:text-end lg:text-end md:mr-5">
            <span class="font-normal not-italic">Gender:</span> {{ $name->gender->name }}
        </p>
    </footer>

    <!-- Favorite Icon -->
    <div class="absolute top-0 right-0 mt-4 mr-4 flex items-center space-x-3 md:space-x-4">
        <a href="javascript:;" id="favorite-button" class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center">
            <i class="far fa-heart text-lg md:text-xl group-hover:text-primary-800 dark:group-hover:text-primary-200" id="favorite-icon"></i>
        </a>
    </div>
</section>