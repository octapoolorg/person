<header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full border-b border-slate-200 dark:border-slate-700 text-sm sm:py-0">
    <nav class="relative max-w-7xl w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 py-5" aria-label="Global">
        <div class="flex items-center justify-between">
            <a class="flex items-center text-2xl font-bold text-slate-800 hover:text-indigo-600 dark:text-white dark:hover:text-indigo-500" href="{!! route('home') !!}" aria-label="iDenteez">
                <img src="{!! asset('static/images/logo.png') !!}" class="w-8 md:w-10" alt="iDenteez Logo">
                <span>iDenteez</span>
            </a>
            <div class="sm:hidden">
                <!-- Mobile menu button -->
                <button type="button" class="hs-collapse-toggle p-2 inline-flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 text-slate-500 shadow-sm bg-white dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" data-hs-collapse="#navbar-collapse-with-animation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon for menu open -->
                    <svg class="hs-collapse-open:hidden w-6 h-6 fill-slate-500 dark:fill-slate-400" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                    <!-- Icon for menu close, hidden by default -->
                    <svg class="hs-collapse-open:block hidden w-6 h-6 fill-slate-500 dark:fill-slate-400"  xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                </button>
            </div>
        </div>
        <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:flex sm:items-center sm:justify-between mt-10 md:mt-0">
            <!-- Search bar -->
            <div class="flex w-full ms-auto sm:w-auto sm:mr-6">
                <form class="relative flex items-center w-full" action="{!! route('names.search') !!}">
                    <label for="hero-input" class="sr-only">Search</label>
                    <input
                          type="text" required id="hero-input" name="q"
                          class="py-2 pl-4 pr-10 block w-full border border-slate-300 dark:border-slate-700 rounded-md shadow-sm bg-white dark:bg-slate-800 text-black dark:text-white placeholder-slate-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:border-indigo-500"
                          placeholder="Search a Name...">
                    <button type="submit" class="absolute right-3 inset-y-0 my-auto flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="fill-indigo-800 dark:fill-indigo-400" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    </button>
                </form>
            </div>

            <!-- Links -->
            <div class="flex flex-col sm:flex-row gap-5 sm:gap-7 justify-end mt-4 sm:mt-0">
                <a class="block py-2 font-medium {!! request()->routeIs('home') ? 'text-indigo-800 dark:text-indigo-500' : 'text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white' !!}" href="{!! route('home') !!}">Home</a>
                <a class="block py-2 font-medium {!! request()->routeIs('names.*') ? 'text-indigo-800 dark:text-indigo-500' : 'text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white' !!}" href="{!! route('names.index') !!}">Names</a>
                <a class="block py-2 font-medium {!! request()->routeIs('blog.*') ? 'text-indigo-800 dark:text-indigo-500' : 'text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white' !!}" href="{!! route('blog.index') !!}">Blog</a>
            </div>

            <div class="flex flex-col justify-center ml-3">
                <input type="checkbox" name="light-switch" id="light-switch" class="light-switch sr-only" />
                <label class="relative cursor-pointer p-2" for="light-switch">

                    <svg class="dark:hidden" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-slate-300" d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.413-1.414zM14 7h2v2h-2zM12.95 14.433l-1.414-1.413 1.413-1.415 1.415 1.414zM7 14h2v2H7zM2.98 14.364l-1.413-1.415 1.414-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.706 4.463 3.12 3.05 4.535 1.636 3.12z" />
                        <path class="fill-slate-400" d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
                    </svg>

                    <svg class="hidden dark:block" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-slate-400" d="M6.2 1C3.2 1.8 1 4.6 1 7.9 1 11.8 4.2 15 8.1 15c3.3 0 6-2.2 6.9-5.2C9.7 11.2 4.8 6.3 6.2 1Z" />
                        <path class="fill-slate-500" d="M12.5 5a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 5Z" />
                    </svg>
                    <span class="sr-only">Switch to light / dark version</span>
                </label>
            </div>
        </div>
    </nav>
</header>
