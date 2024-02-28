<section class="text-base-900 dark:text-base-100 px-6 py-8 shadow rounded-lg border dark:border-base-700 bg-surface dark:bg-base-800" id="wallpapers">
    <div class="flex flex-col md:flex-row justify-between mb-6">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-0 font-semibold">
            Wallpapers for {!! $name->name !!}
        </h2>
    </div>

    <!-- Download link for the currently displayed wallpaper -->
    <a download id="download-link" class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center justify-end mt-4" href="{!! $name->wallpapers->first() !!}" target="_blank">
        Download
        <i class="fas fa-download ml-2"></i>
    </a>

    <!-- Main displayed wallpaper -->
    <div class="overflow-hidden rounded-lg shadow-lg dark:shadow-none my-8">
        <img
            src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
            data-src="{!! $name->wallpapers->first() !!}"
            class="w-full h-auto md:h-96 object-cover lazy"
            id="main-wallpaper" alt="Stylish wallpaper with the name {!! $name->name !!}"
        >
    </div>

    <!-- Thumbnails container -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 justify-center">
        @foreach ($name->wallpapers->random(2) as $url)
        <img
            src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaa%3Bstroke-width%3A1%22/%3E%3C/svg%3E"
            data-src="{!! $url !!}?size=thumb"
            class="cursor-pointer object-contain rounded-lg lazy"
            onclick="changeWallpaper('{!! $url !!}')"
            alt="Stylish wallpaper with the name {!! $name->name !!}"
        >
        @endforeach
    </div>

    @if ($name->is_popular)
        <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6 md:mt-16">
            <a href="{{ route('names.wallpapers', $name->slug) }}" target="_blank"
                class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center">
                More wallpapers for {!! $name->name !!}
                <i class="fas fa-arrow-right ml-2 text-primary-600 dark:text-primary-400 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
            </a>
        </div>
    @endif
</section>

<script>
    function changeWallpaper(url) {
        document.getElementById('main-wallpaper').src = url;
        document.getElementById('download-link').href = url;
    }
</script>
