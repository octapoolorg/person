@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8 bg-surface dark:bg-base-800">
        <section
            class="text-base-900 dark:text-base-100 px-6 py-8">
            <div class="flex flex-col md:flex-row justify-between mb-6">
                <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-0 font-bold">
                    Name Wallpaper
                </h2>
            </div>

            <div class="grid gap-4">
                <div>
                    <img class="h-auto max-w-full rounded-lg lazy"
                        src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
                        data-src="{!! head($images) !!}" id="main-wallpaper"
                        alt=""
                    >
                </div>
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($images as $image)
                    <div class="group border rounded-lg overflow-hidden">
                        <img
                            class="h-auto max-w-full rounded-lg lazy cursor-pointer"
                            src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaa%3Bstroke-width%3A1%22/%3E%3C/svg%3E"
                            data-src="{!! $image !!}?size=thumb"  onclick="changeWallpaper('{!! $image !!}')"
                            alt=""
                        >
                    </div>
                    @endforeach
                </div>
            </div>



            <!-- Download link for the currently displayed wallpaper -->
            <a href="#" download id="download-link"
                class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center justify-center mt-4">
                Download
                <i class="fas fa-download ml-2"></i>
            </a>

            <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 mt-4">
                Discover the unique charm of the name wallpaper. Every curve and
                detail of the design captures the essence of the name, making it a perfect backdrop for your
                devices. Elevate your screens with this blend of artistry and elegance.
            </p>
        </section>
    </section>

    <script>
        function changeWallpaper(url) {
            document.getElementById('main-wallpaper').src = url;
            document.getElementById('download-link').href = url;
        }
    </script>
@endsection
