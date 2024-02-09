<section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700">
    <div class="flex flex-row justify-between items-center relative">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-bold relative">
            {{ $data['nameDetails']->name }} Name Numerology
        </h2>
        <span class="group relative md:absolute top-0 right-0 mb-2 mr-2 flex items-center">
            <!-- SVG Icon -->
            <svg class="fill-primary-500 dark:fill-primary-300 cursor-pointer"
                xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
            </svg>

            <!-- Tooltip Text -->
            <span
                class="absolute bottom-full mb-2 right-0 bg-black dark:bg-black text-surface dark:text-base-100 text-xs rounded py-1 px-3 hidden group-hover:block">
                Based on Pythagorean Numerology.
            </span>
        </span>
    </div>

    <div class="space-y-10">
        <!-- Numerology Explanation -->
        <p class="text-lg text-base-600 dark:text-base-300 leading-relaxed">
            Numerology numbers, each associated with a unique color, offer insights into personality and
            destiny. Discover the colors and meanings personalized for {{ $data['nameDetails']->name }}.
        </p>

        <!-- Numerology Details -->
        <!-- Destiny -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-primary-50 dark:bg-primary-900 rounded-xl shadow-inner dark:shadow-none p-6">
            <img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
             data-src="{{ asset('static/images/zodiac/numerology/numerology-icon.png') }}"
                alt="Destiny Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6 lazy">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-primary-700 dark:text-primary-300 mb-3">Destiny
                    Number</h3>
                <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    {{ __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], ['name' => $data['nameDetails']->name]) }}
                </p>
            </div>
        </div>

        <!-- Soul -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-green-50 dark:bg-green-900 rounded-xl shadow-inner dark:shadow-none p-6">
            <img src="{{ asset('static/images/zodiac/numerology/soul-icon.png') }}" alt="Soul Icon"
                class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-green-700 dark:text-green-300 mb-3">Soul Number</h3>
                <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    {{ __('numerology.soul_urge.' . $data['numerology']['numbers']['soul_urge'], ['name' => $data['nameDetails']->name]) }}
                </p>
            </div>
        </div>

        <!-- Personality -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start bg-yellow-50 dark:bg-yellow-900 rounded-xl shadow-inner dark:shadow-none p-6">
            <img src="{{ asset('static/images/zodiac/numerology/personality-icon.png') }}"
                alt="Personality Icon" class="w-16 h-16 mb-4 md:mb-0 md:mr-6">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-yellow-700 dark:text-yellow-300 mb-3">Personality
                    Number</h3>
                <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    {{ __('numerology.personality.' . $data['numerology']['numbers']['personality'], ['name' => $data['nameDetails']->name]) }}
                </p>
            </div>
        </div>
    </div>
</section>