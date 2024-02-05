<div class="flex flex-col md:flex-row items-start md:items-center p-6 rounded-lg my-6 text-center md:text-start">
    <!-- Icon/Image -->
    <div class="flex-shrink-0 w-full md:w-32 mb-6 md:mb-0 mr-0 md:mr-12">
        <div class="aspect-w-4 aspect-h-3 flex justify-center">
            <img src="{{ $img_src }}" class="object-cover rounded-lg h-32 w-32" alt="{{ $caption }} symbol">
        </div>
        <figcaption class="text-center font-semibold text-base-800 dark:text-base-100 mt-2">
            {{ $caption }}
        </figcaption>
    </div>

    <!-- Text Content -->
    <div class="flex-grow">
        <h3 class="text-2xl font-semibold mb-4 text-base-900 dark:text-base-100">{{ $title }}</h3>
        <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">{{ $description }}</p>
    </div>
</div>