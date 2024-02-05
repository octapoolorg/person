<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" id="top">

<head>
    <x-head />
</head>

<body class="bg-surface text-base-900 h-full dark:bg-base-900 selection:bg-primary-600 selection:text-surface">
    <x-header />

    <section class="">
        @yield('content')
    </section>

    <x-footer />
    <x-theme-switch />
</body>

</html>
