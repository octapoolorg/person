<section id="numerology"
    class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700 bg-surface dark:bg-base-800">
    <div class="flex flex-row justify-between items-center relative">
        <h2 class="text-2xl md:text-3xl font-semibold text-base-800 dark:text-base-100 mb-4 md:mb-10 relative">
            Personality analysis for {!! $name->name !!}
        </h2>
        <span class="group absolute top-0 right-0 mb-2 mr-2" title="Based on Pythagorean Numerology.">
            <i class="cursor-pointer fas fa-info-circle text-primary-500 dark:text-primary-300 text-2xl group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300"></i>
        </span>
    </div>

    <div class="space-y-10">
        <!-- Numerology Explanation -->
        <p class="text-lg text-base-600 dark:text-base-300 leading-relaxed">
            {!! $name->name !!} is a name that is associated with
            the personality number {!! $name->numerology['numbers']['personality'] !!},
            destiny number {!! $name->numerology['numbers']['destiny'] !!},
            and soul urge number {!! $name->numerology['numbers']['soul_urge'] !!}.
            These numbers are used to determine a person's character, personality,
            and even the future.
        </p>

        <!-- Personality -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-green-50 dark:bg-green-900 rounded-xl shadow-inner dark:shadow-none p-6 relative">
            <span
                class="absolute top-0 left-0 bg-green-500 dark:bg-green-300 text-surface dark:text-base-900 text-xs font-semibold py-1 px-3 rounded-tl rounded-br">
                Based on Personality Number
            </span>
            {{-- <span class="absolute top-0 right-0 text-green-500 dark:text-green-300 text-2xl md:text-5xl font-semibold py-1 px-3 opacity-70">
                {!! $name->numerology['numbers']['personality'] !!}
            </span> --}}
            <div class="my-4 flex flex-col md:flex-row items-center md:items-start">
                <img src="{!! asset('static/images/zodiac/numerology/personality-icon.png') !!}" alt="Personality Icon"
                class="w-16 h-16 mb-4 md:mb-0 md:mr-6 pointer-events-none select-none">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-green-700 dark:text-green-300 mb-3">
                    Personality
                </h3>
                <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    {!! __('numerology.personality.' . $name->numerology['numbers']['personality'], ['name' => $name->name]) !!}
                </p>
            </div>
            </div>

        </div>

        <!-- Destiny -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-yellow-50 dark:bg-yellow-900 rounded-xl shadow-inner dark:shadow-none p-6 relative">
            <span
                class="absolute top-0 left-0 bg-yellow-500 dark:bg-yellow-300 text-surface dark:text-base-900 text-xs font-semibold py-1 px-3 rounded-tl rounded-br">
                Based on Destiny Number
            </span>
            <div class="my-4 flex flex-col md:flex-row items-center md:items-start">
                <img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
                data-src="{!! asset('static/images/zodiac/numerology/life-purpose-icon.png') !!}" alt="Destiny Icon"
                class="w-16 h-16 mb-4 md:mb-0 md:mr-6 lazy  pointer-events-none select-none">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-yellow-700 dark:text-yellow-300 mb-3">
                    Life Purpose
                </h3>
                <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    {!! __('numerology.destiny.' . $name->numerology['numbers']['destiny'], ['name' => $name->name]) !!}
                </p>
            </div>
            </div>
        </div>

        <!-- Soul -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-rose-50 dark:bg-rose-900 rounded-xl shadow-inner dark:shadow-none p-6 relative">
            <span
                class="absolute top-0 left-0 bg-rose-500 dark:bg-rose-300 text-surface dark:text-base-900 text-xs font-semibold py-1 px-3 rounded-tl rounded-br">
                Based on Soul Urge Number
            </span>
            <div class="my-4 flex flex-col md:flex-row items-center md:items-start">
                <img src="{!! asset('static/images/zodiac/numerology/soul-icon.png') !!}" alt="Soul Icon"
                    class="w-16 h-16 md:mb-0 md:mr-6 pointer-events-none select-none">
                <div class="text-center md:text-left">
                    <h3 class="text-2xl font-semibold text-rose-700 dark:text-rose-300 mb-3">
                        Heart Voice
                    </h3>
                    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                        {!! __('numerology.soul_urge.' . $name->numerology['numbers']['soul_urge'], ['name' => $name->name]) !!}
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
