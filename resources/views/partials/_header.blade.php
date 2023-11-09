<header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm sm:py-0 dark:bg-gray-800 dark:border-gray-700">
    <nav class="relative max-w-7xl w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 py-5" aria-label="Global">
        <div class="flex items-center justify-between">
            <a class="flex-none text-xl font-semibold dark:text-white" href="{!! route('home') !!}" aria-label="Brand">NameCenter</a>
            <div class="sm:hidden">
                <button type="button" class="hs-collapse-toggle p-2 inline-flex items-center rounded-md border border-transparent text-gray-500 shadow-sm bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-600 transition text-sm dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:flex sm:items-center sm:justify-between">
            <!-- Search bar -->
            <div class="flex w-full ms-auto sm:w-auto sm:mr-6">
                <form class="relative flex items-center w-full" action="{!! route('names.search') !!}">
                    <label for="hero-input" class="sr-only">Search</label>
                    <input type="text" required id="hero-input" name="q" class="py-2 px-4 block w-full border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-700 dark:text-white" placeholder="Search a Name...">
                    <button type="submit" class="absolute right-3 inset-y-0 my-auto flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <i class="fas fa fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Links -->
            <div class="flex flex-col sm:flex-row gap-5 sm:gap-7 justify-end mt-4 sm:mt-0">
                <a class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 block py-2" href="{!! route('home') !!}" aria-current="page">Home</a>
                <a class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 block py-2" href="#">Names</a>
                <a class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 block py-2" href="#">Blog</a>
            </div>
        </div>
    </nav>
</header>
