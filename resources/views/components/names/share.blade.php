<!-- Social Share Section -->
<section class="my-8 mb-10 px-6 py-10 shadow rounded-lg border dark:border-base-700">
    <div class="flex flex-wrap md:justify-start gap-2 sm:gap-4">
        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?text={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-base-900 dark:bg-base-950 text-surface rounded-full hover:bg-base-950 dark:hover:bg-base-700 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <i class="fab fa-x-twitter"></i>
            Share
        </a>
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-500 dark:bg-blue-600 text-surface rounded-full hover:bg-blue-600 dark:hover:bg-blue-700  flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <i class="fab fa-facebook-f"></i>
            Share
        </a>
        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/cws/share?url={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-700 dark:bg-blue-800 text-surface rounded-full hover:bg-blue-800 dark:hover:bg-blue-900 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <i class="fab fa-linkedin-in"></i>
            Share
        </a>
        <!-- Reddit -->
        <a href="http://www.reddit.com/submit?url={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-red-500 dark:bg-red-700 text-surface rounded-full hover:bg-red-600 dark:hover:bg-red-800 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <i class="fab fa-reddit-alien"></i>
            Share
        </a>
        <!-- Mail -->
        <a href="mailto:?subject={!! $data['nameDetails']->name !!} name details - all you need to know&amp;body={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-base-500 dark:bg-base-700 text-surface rounded-full hover:bg-base-600 dark:hover:bg-base-800 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow" title="Share via email">
            <i class="fas fa-envelope"></i>
            Share
        </a>
    </div>
</section>