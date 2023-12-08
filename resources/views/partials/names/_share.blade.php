<!-- Social Share Section -->
<section class="my-8 mb-10 px-6 py-10 shadow rounded-lg border dark:border-slate-700">
    <div class="flex flex-wrap md:justify-start gap-2 sm:gap-4">
        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?text={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-slate-900 dark:bg-slate-900 text-white rounded-full hover:bg-slate-950 dark:hover:bg-slate-700 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
            Share
        </a>
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-500 dark:bg-blue-600 text-white rounded-full hover:bg-blue-600 dark:hover:bg-blue-700  flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
            Share
        </a>
        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/cws/share?url={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-blue-700 dark:bg-blue-800 text-white rounded-full hover:bg-blue-800 dark:hover:bg-blue-900 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
            Share
        </a>
        <!-- Reddit -->
        <a href="http://www.reddit.com/submit?url={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-red-500 dark:bg-red-700 text-white rounded-full hover:bg-red-600 dark:hover:bg-red-800 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M440.3 203.5c-15 0-28.2 6.2-37.9 15.9-35.7-24.7-83.8-40.6-137.1-42.3L293 52.3l88.2 19.8c0 21.6 17.6 39.2 39.2 39.2 22 0 39.7-18.1 39.7-39.7s-17.6-39.7-39.7-39.7c-15.4 0-28.7 9.3-35.3 22l-97.4-21.6c-4.9-1.3-9.7 2.2-11 7.1L246.3 177c-52.9 2.2-100.5 18.1-136.3 42.8-9.7-10.1-23.4-16.3-38.4-16.3-55.6 0-73.8 74.6-22.9 100.1-1.8 7.9-2.6 16.3-2.6 24.7 0 83.8 94.4 151.7 210.3 151.7 116.4 0 210.8-67.9 210.8-151.7 0-8.4-.9-17.2-3.1-25.1 49.9-25.6 31.5-99.7-23.8-99.7zM129.4 308.9c0-22 17.6-39.7 39.7-39.7 21.6 0 39.2 17.6 39.2 39.7 0 21.6-17.6 39.2-39.2 39.2-22 .1-39.7-17.6-39.7-39.2zm214.3 93.5c-36.4 36.4-139.1 36.4-175.5 0-4-3.5-4-9.7 0-13.7 3.5-3.5 9.7-3.5 13.2 0 27.8 28.5 120 29 149 0 3.5-3.5 9.7-3.5 13.2 0 4.1 4 4.1 10.2.1 13.7zm-.8-54.2c-21.6 0-39.2-17.6-39.2-39.2 0-22 17.6-39.7 39.2-39.7 22 0 39.7 17.6 39.7 39.7-.1 21.5-17.7 39.2-39.7 39.2z"/></svg>
            Share
        </a>
        <!-- Mail -->
        <a href="mailto:?subject={!! $data['nameDetails']->name !!} name details - all you need to know&amp;body={!! request()->url() !!}"
           class="px-3 py-2 sm:px-4 sm:py-2 bg-slate-500 dark:bg-slate-700 text-white rounded-full hover:bg-slate-600 dark:hover:bg-slate-800 flex items-center gap-2 transition-colors duration-300"
           target="_blank" rel="nofollow" title="Share via email">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
            Share
        </a>
    </div>
</section>
