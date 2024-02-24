@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12 bg-base-50 dark:bg-base-900 rounded-xl shadow-lg">
        <div class="bg-surface dark:bg-base-800 rounded-xl shadow-md overflow-hidden relative">
            <a href="{!! head($images) !!}" download id="download-link"
                class="inline-block px-3 py-2 bg-primary-800 hover:bg-primary-700 text-surface font-medium rounded-lg shadow transition-all duration-300 absolute top-5 right-5">
                <i class="text-lg fas fa-download"></i>
            </a>

            <img class="w-full object-cover transition-opacity duration-500 max-h-fit md:max-h-[500px] lazy"
                src="{!! head($images) !!}" id="main-wallpaper" alt="Main wallpaper">

            <div class="p-8">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5 mb-8">
                    @foreach ($images as $image)
                        <div
                            class="border border-base-200 dark:border-base-700 rounded-lg overflow-hidden shadow-sm transition-transform duration-300 cursor-pointer">
                            <img class="rounded-lg w-full h-32 object-cover transition-opacity duration-300 lazy"
                                src="{!! $image !!}?size=thumb"
                                onclick="changeWallpaper('{!! $image !!}')" alt="Thumbnail">
                        </div>
                    @endforeach
                </div>

                <div class="my-12">
                    <h1 class="text-lg font-semibold text-base-800 dark:text-surface mb-4">{!! $meta->title !!}</h1>
                    <p class="text-lg text-base-500 dark:text-base-400">
                        {!! $meta->description !!}
                    </p>
                </div>
            </div>
        </div>

    </section>

    <script>
        function changeWallpaper(url) {
            const mainWallpaper = document.getElementById('main-wallpaper');
            const downloadLink = document.getElementById('download-link');

            // Fade out effect
            mainWallpaper.classList.add('opacity-0');
            setTimeout(() => {
                mainWallpaper.src = url;
                downloadLink.href = url;
            }, 150);

            // Fade in effect
            mainWallpaper.onload = () => {
                mainWallpaper.classList.remove('opacity-0');
            };
        }
    </script>
@endsection
