<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
class="scroll-smooth" id="top"
@yield('data-theme')
>

<head>
    <x-head />
</head>

<body class="bg-surface text-base-900 dark:bg-base-900 selection:bg-primary-600 selection:text-surface">
    <x-header />

    <section class="">
        @yield('content')
    </section>

    <x-footer />
    <x-theme-switch />
</body>

</html>
