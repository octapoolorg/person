<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-cloak x-data="{darkMode: $persist(false)}" :class="{'dark': darkMode === true }"
    id="top" @yield('data-theme')>

<head>
    <x-head />
</head>

<body
class="bg-base-50 text-base-900 dark:bg-base-900 selection:bg-primary-600 selection:text-surface scroll-smooth"
>
    <x-header />

    <section class="">
        @yield('content')
    </section>

    <x-footer />
    <x-theme-switch />
</body>

</html>
