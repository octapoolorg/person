<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" id="top">

<head>
    <x-head />
</head>

<body class="bg-white text-slate-900 h-full dark:bg-slate-900 selection:bg-indigo-600 selection:text-white">
    <x-header />

    <section class="">
        @yield('content')
    </section>

    <x-footer />
    <x-theme-switch />
</body>

</html>
