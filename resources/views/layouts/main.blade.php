<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {!! SEO::generate() !!}
</head>

<body class="bg-white text-gray-900">
@include('partials._header')

<div class="container mx-auto mt-8 md:mt-20">
    @yield('content')
</div>

@include('partials._footer')
@vite('resources/js/app.js')
</body>
</html>
