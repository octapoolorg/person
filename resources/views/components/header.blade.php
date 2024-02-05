@props(['class' => ''])
<nav class="bg-surface border-b border-base-200 dark:bg-base-800 dark:border-base-700 py-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4">
        <a href="{!! route('home') !!}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img class="h-14" src="{{ asset('/static/images/logo.png') }}" alt="{{ config('app.name') }}">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-surface">
                {{ config('app.name') }}
            </span>
        </a>
        <div class="inline-flex items-center justify-center md:hidden">
            <x-mode-switch />
            <button data-collapse-toggle="navbar-default" type="button"
                class=" p-2 w-10 h-10 text-sm text-base-500 rounded-lg hover:bg-base-100 focus:outline-none focus:ring-2 focus:ring-base-200 dark:text-base-400 dark:hover:bg-base-700 dark:focus:ring-base-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col items-center p-4 md:p-0 mt-4 border border-base-100 rounded-lg bg-base-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-surface dark:bg-base-800 dark:border-base-700">
                <li>
                    <a href="{!! route('home') !!}"
                       @class([
                           'block py-2 px-3 rounded md:p-0',
                           'text-primary-600' => request()->routeIs('home'),
                           'text-base-800 md:hover:text-primary-700 dark:text-surface md:dark:hover:text-primary-500' => ! request()->routeIs('home'),
                       ])
                       {{ request()->routeIs('home') ? 'aria-current=page' : '' }}
                    >
                        Home
                    </a>
                </li>
                <li>
                    <a href="{!! route('names.index') !!}"
                       @class([
                           'block py-2 px-3 rounded md:p-0',
                           'text-primary-600' => request()->routeIs('Names'),
                           'text-base-800 md:hover:text-primary-700 dark:text-surface md:dark:hover:text-primary-500' => ! request()->routeIs('about'),
                       ])
                       {{ request()->routeIs('Names') ? 'aria-current=page' : '' }}
                    >
                        Names
                    </a>
                <li>
                    <a href="{!! route('blog.index') !!}"
                       @class([
                           'block py-2 px-3 rounded md:p-0',
                           'text-primary-600' => request()->routeIs('blog'),
                           'text-base-800 md:hover:text-primary-700 dark:text-surface md:dark:hover:text-primary-500' => ! request()->routeIs('blog'),
                       ])
                       {{ request()->routeIs('blog') ? 'aria-current=page' : '' }}
                    >
                        Blog
                    </a>
                </li>
                <li class="hidden md:block">
                    <x-mode-switch />
                </li>
            </ul>
        </div>
    </div>
</nav>
