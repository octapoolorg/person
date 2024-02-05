<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>

</head>

<body class="bg-white text-slate-900 h-full dark:bg-slate-900 selection:bg-indigo-600 selection:text-white">
    @include('partials._header')

    <div class="">
        @yield('content')
    </div>

    @include('partials._footer')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
