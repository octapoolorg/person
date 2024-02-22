<section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700 bg-surface dark:bg-base-800">
    <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold">
        Usernames for {!! $name->name !!}
    </h2>
    <div class="mb-6">
        <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
            Explore the availability of these usernames on various social media platforms. Click to check instantly.
        </p>
    </div>
    <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6">
        <a href="javascript:" id="generate-usernames" class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center">
            Generate new
            <i class="fas fa-sync-alt ml-2 text-primary-600 dark:text-primary-400 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
        </a>
    </div>
    <div class="flex flex-wrap gap-x-4 gap-y-8 mx-auto overflow-auto" id="usernames">
        @foreach ($data['userNames'] as $username)
             <span class="bg-base-100 dark:bg-base-900 dark:border dark:border-base-800 hover:bg-base-200 dark:hover:bg-base-800 rounded-lg text-lg font-medium text-base-800 dark:text-base-100 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4">
                {!! $username !!}
            </span>
        @endforeach
    </div>
</section>

{{--    Identities        --}}
{{--    https://tailwindcss.com/docs/hover-focus-and-other-states#differentiating-nested-groups--}}