<section class="text-base-900 dark:text-base-100 px-6 py-8 shadow rounded-lg border dark:border-base-700">
    <div class="flex flex-col md:flex-row justify-between mb-6">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-bold">
            {{ $data['nameDetails']->name }} Name Wallpaper</h2>
        <a href="{{ $data['wallpaperUrl'] }}" download
            class="group text-primary-600 hover:text-primary-800 dark:text-primary-400 dark:hover:text-primary-200 font-semibold transition-colors duration-300 flex items-center self-end">
            Download
            <svg class="fill-primary-600 group-hover:fill-primary-800 dark:fill-primary-400 dark:group-hover:fill-primary-200 ml-2"
                xmlns="http://www.w3.org/2000/svg" height="16" width="12"
                viewBox="0 0 384 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
            </svg>
        </a>
    </div>

    <div class="overflow-hidden rounded-lg shadow-lg dark:shadow-none my-8">
        <img src="{{ $data['wallpaperUrl'] }}" class="w-full h-auto md:h-96 object-cover"
            id="name-wallpaper" alt="Stylish wallpaper with the name {{ $data['nameDetails']->name }}">
    </div>

    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
        Discover the unique charm of the {{ $data['nameDetails']->name }} name wallpaper. Every curve and
        detail of the design captures the essence of the name, making it a perfect backdrop for your
        devices. Elevate your screens with this blend of artistry and elegance.
    </p>
</section>