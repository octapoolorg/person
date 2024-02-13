<section class="text-base-900 dark:text-base-100 px-6 py-8 shadow rounded-lg border dark:border-base-700 bg-surface dark:bg-base-800">
    <div class="flex flex-col md:flex-row justify-between mb-6">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-0 font-bold">
            {!! $name->name !!} Name Wallpaper</h2>
    </div>

    <!-- Main displayed wallpaper -->
    <div class="overflow-hidden rounded-lg shadow-lg dark:shadow-none my-8">
        <img
            src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
            data-src="{!! head($data['wallpaperUrls']) !!}"            class="w-full h-auto md:h-96 object-cover lazy"
            id="main-wallpaper" alt="Stylish wallpaper with the name {!! $name->name !!}"
        >
    </div>


    <!-- Thumbnails container -->
    <div class="flex flex-wrap gap-4 justify-center">
        @foreach ($data['wallpaperUrls'] as $key => $url)
        <img
            src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
            data-src="{!! $url !!}?size=thumb"
            class="w-24 h-24 cursor-pointer object-cover rounded-lg lazy"
            onclick="changeWallpaper('{!! $url !!}')"
            alt="Thumbnail"
        >
        @endforeach
    </div>

    <!-- Download link for the currently displayed wallpaper -->
    <a href="#" download id="download-link" class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center justify-center mt-4">
        Download
        <i class="fas fa-download ml-2"></i>
    </a>

    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose mt-4">
        Discover the unique charm of the {!! $name->name !!} name wallpaper. Every curve and
        detail of the design captures the essence of the name, making it a perfect backdrop for your
        devices. Elevate your screens with this blend of artistry and elegance.
    </p>
</section>

<script>
    function changeWallpaper(url) {
        document.getElementById('main-wallpaper').src = url;
        document.getElementById('download-link').href = url;
    }
</script>
