@props(['class' => ''])
<nav class="bg-surface border-b border-base-200 dark:bg-base-800 dark:border-base-700 py-4">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4">
        <a href="{!! route('home') !!}" class="flex items-center rtl:space-x-reverse space-x-2">
            <span class="dark:hidden">
                <img src="{{ asset('static/images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
            </span>
            <span
                class="self-center text-xl md:text-2xl font-bold surfacespace-nowrap text-base-800 hover:text-primary-600 dark:text-base-200 dark:hover:text-primary-500">
                {{ config('app.name') }}
            </span>
        </a>
        <div class="inline-flex items-center justify-center lg:hidden">
            <a href="{!! route('names.search') !!}"
                class="p-2 text-base-500 rounded-lg hover:bg-base-100 focus:outline-none focus:ring-2 focus:ring-base-200 dark:text-base-400 dark:hover:bg-base-700 dark:focus:ring-base-600">
                <span class="sr-only">Search</span>
                <i class="fas fa-search" aria-hidden="true"></i>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class=" p-2 w-10 h-10 text-sm text-base-500 rounded-lg hover:bg-base-100 focus:outline-none focus:ring-2 focus:ring-base-200 dark:text-base-400 dark:hover:bg-base-700 dark:focus:ring-base-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <div class="hidden w-full lg:block lg:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col items-center p-4 lg:p-0 mt-4 border border-base-100 rounded-lg bg-base-50 lg:flex-row lg:space-x-8 rtl:space-x-reverse lg:mt-0 lg:border-0 lg:bg-surface dark:bg-base-800 dark:border-base-700 *:w-full *:lg:w-fit">
                <li class="text-right lg:hidden">
                    <x-darkmode-switch />
                </li>
                <li class="hidden lg:block">
                    <form class="relative flex items-center w-full" action="{!! route('names.search') !!}">
                        <label for="hero-input" class="sr-only">Search</label>
                        <input type="text" required="" id="hero-input" name="q"
                            class="py-2 pl-4 pr-10 block w-full border border-base-300 dark:border-base-700 rounded-md shadow-sm dark:bg-base-800 text-black dark:text-surface placeholder:text-md placeholder:font-normal placeholder-base-400 focus:ring-0 focus:border-primary-500 dark:focus:border-primary-500"
                            placeholder="Search a Name..."
                            {{ request()->filled('q') ? 'value=' . request()->input('q') : '' }}>
                        <button type="submit"
                            class="absolute right-3 inset-y-0 my-auto flex items-center justify-center text-primary-600 dark:text-primary-400">
                            <i class="fas fa-search text-primary-500 dark:text-primary-400 hover:text-primary-600 dark:hover:text-primary-500"
                                aria-hidden="true"></i>
                        </button>
                    </form>
                </li>
                <li>
                    <a href="{!! route('home') !!}" @class([
                        'block py-2 px-3 rounded lg:p-0',
                        'text-primary-600' => request()->routeIs('home'),
                        'text-base-800 lg:hover:text-primary-700 dark:text-surface lg:dark:hover:text-primary-500' => !request()->routeIs(
                            'home'),
                    ])
                        {{ request()->routeIs('home') ? 'aria-current=page' : '' }}>
                        Home
                    </a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="group flex items-center justify-between w-full py-2 px-3 text-base-900 hover:bg-base-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 lg:w-auto dark:text-surface lg:dark:hover:text-primary-500 dark:focus:text-surface dark:hover:bg-base-700 lg:dark:hover:bg-transparent">
                        Names
                        <i class="fas fa-chevron-down text-base-500 dark:text-base-400 ml-2 group-hover:text-primary-700"
                            aria-hidden="true"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar"
                        class="z-10 hidden font-normal bg-surface divide-y divide-base-100 rounded-lg shadow w-44 dark:bg-base-700 dark:divide-base-600">
                        <ul class="py-2 text-sm text-base-700 dark:text-base-200" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{!! route('names.search') !!}"
                                    class="block px-4 py-2 hover:bg-base-100 dark:hover:bg-base-600 dark:hover:text-surface">
                                    Explore
                                </a>
                            </li>
                            <li aria-labelledby="dropdownNavbarLink">
                                <button id="doubleDropdownButtonOrigin" data-dropdown-toggle="doubleDropdownOrigin" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-base-100 dark:hover:bg-base-600 dark:hover:text-surface">
                                    Origins
                                    <i class="fas fa-chevron-right text-base-500 dark:text-base-400 ml-2 group-hover:text-primary-700" aria-hidden="true"></i>
                                </button>
                                <div id="doubleDropdownOrigin"
                                    class="z-10 hidden bg-surface divide-y divide-base-100 rounded-lg shadow w-44 dark:bg-base-700">
                                    <ul class="py-2 text-sm text-base-700 dark:text-base-200"
                                        aria-labelledby="doubleDropdownButtonOrigin">
                                        @foreach ($origins->random(5)->sortBy('name') as $origin)
                                            <li>
                                                <a href="{!! route('names.search', ['origin'=>$origin->slug]) !!}"
                                                    class="block px-4 py-2 hover:bg-base-100 dark:hover:bg-base-600 dark:text-base-200 dark:hover:text-surface">
                                                    {{ $origin->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{!! route('names.search') !!}"
                                                class="block px-4 py-2 hover:bg-base-100 dark:hover:bg-base-600 dark:text-base-200 dark:hover:text-surface">
                                                More...
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{!! route('blog.index') !!}"
                        @class([
                            'block py-2 px-3 rounded lg:p-0',
                            'text-primary-600' => request()->routeIs('blog'),
                            'text-base-800 lg:hover:text-primary-700 dark:text-surface lg:dark:hover:text-primary-500' => !request()->routeIs('blog'),
                        ])
                        {{ request()->routeIs('blog') ? 'aria-current=page' : '' }}>
                        Blog
                    </a>
                </li>
                <li>
                    <!-- favorite button -->
                    <a href="{!! route('names.favorites') !!}" id="navbar-favorite"
                        @class([
                            'block py-2 px-3 rounded lg:p-0',
                            'text-primary-600' => request()->routeIs('favorites'),
                            'text-base-800 lg:hover:text-primary-700 dark:text-surface lg:dark:hover:text-primary-500' => !request()->routeIs('favorites'),
                        ])
                        {{ request()->routeIs('favorites') ? 'aria-current=page' : '' }}>
                        <div class="relative">
                            <span class=" lg:hidden">Favorites</span>
                            <div class="hidden lg:inline-block">
                                <i class="z-50 far fa-heart text-primary-500 dark:text-primary-400 text-2xl" aria-hidden="true" id="navbar-favorite-icon"></i>
                                <span id="navbar-favorite-indicator"
                                    @class([
                                        'absolute items-center justify-center size-3 text-xs font-bold text-surface bg-pink-500 border-2 border-surface rounded-full -top-1.5 -right-1.5 lg:-top-0 lg:-end-1 dark:border-base-900',
                                        'inline-flex' => $haveFavorites,
                                        'hidden' => ! $haveFavorites,
                                    ])
                                ></span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="hidden lg:block mr-2">
                    <x-darkmode-switch />
                </li>
            </ul>
        </div>
    </div>
</nav>