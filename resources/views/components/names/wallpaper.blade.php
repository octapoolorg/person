<section class="text-base-900 dark:text-base-100 px-6 py-8 shadow rounded-lg border dark:border-base-700">
    <div class="flex flex-col md:flex-row justify-between mb-6">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-bold">
            {{ $data['nameDetails']->name }} Name Wallpaper</h2>
        <a href="{{ $data['wallpaperUrl'] }}" download
            class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center self-end">
            Download
            <i class="fas fa-download ml-2 text-primary-600 group-hover:text-primary-800 dark:text-primary-400 dark:group-hover:text-primary-200"></i>
        </a>
    </div>

    <div class="overflow-hidden rounded-lg shadow-lg dark:shadow-none my-8">
        <img
            src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
            data-src="{{ $data['wallpaperUrl'] }}" class="w-full h-auto md:h-96 object-cover lazy"
            id="name-wallpaper" alt="Stylish wallpaper with the name {{ $data['nameDetails']->name }}"
        >
    </div>

    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
        Discover the unique charm of the {{ $data['nameDetails']->name }} name wallpaper. Every curve and
        detail of the design captures the essence of the name, making it a perfect backdrop for your
        devices. Elevate your screens with this blend of artistry and elegance.
    </p>
</section>