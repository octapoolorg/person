<div class="flex flex-col md:flex-row items-start md:items-center p-6 rounded-lg my-6 text-center md:text-start dark:bg-gray-800 dark:text-gray-100">
    <!-- Icon/Image -->
    <div class="flex-shrink-0 w-full md:w-32 mb-6 md:mb-0 mr-0 md:mr-12">
        <div class="aspect-w-4 aspect-h-3 flex justify-center">
            <img src="{{ $img_src }}" class="object-cover rounded-lg" alt="{{ $caption }} symbol">
        </div>
        <figcaption class="text-center font-semibold text-gray-800 dark:text-gray-100 mt-2">
            {{ $caption }}
        </figcaption>
    </div>

    <!-- Text Content -->
    <div class="flex-grow">
        <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ $title }}</h3>
        <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300 max-w-prose">{{ $description }}</p>
    </div>
</div>