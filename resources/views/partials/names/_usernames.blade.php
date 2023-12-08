<section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-slate-700">
    <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold">
        Usernames for {{ $data['nameDetails']->name }}
    </h2>
    <div class="mb-6">
        <p class="text-slate-600 dark:text-slate-300 text-base md:text-lg">
            Explore the availability of these usernames on various social media platforms. Click to check instantly.
        </p>
    </div>
    <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6">
        <a href="javascript:" id="generate-usernames" class="mt-4 md:mt-0 text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 font-semibold transition-colors duration-300 flex items-center">
            Generate new usernames
            <svg class="fill-indigo-600 hover:fill-indigo-800 ml-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
        </a>
    </div>
    <div class="flex flex-wrap gap-x-4 gap-y-8 mx-auto overflow-auto" id="usernames">
        @foreach ($data['userNames'] as $username)
             <span class="bg-slate-100 dark:bg-slate-900 dark:border dark:border-slate-800 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg text-lg font-medium text-slate-800 dark:text-slate-100 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4">
                {{ $username }}
            </span>
        @endforeach
    </div>
</section>

{{--    Identities        --}}
{{--    https://tailwindcss.com/docs/hover-focus-and-other-states#differentiating-nested-groups        --}}
