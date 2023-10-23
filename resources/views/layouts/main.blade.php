<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ Vite::asset('resources/scss/app.scss') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    {!! SEO::generate() !!}
</head>

<body>
    @include('partials._header')

    <div class="container mt-md-5">
        @yield('content')
    </div>

    @include('partials._footer')
</body>
</html>
