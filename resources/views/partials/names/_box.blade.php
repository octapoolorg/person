<div class="flex flex-col md:flex-row items-start md:items-center bg-gray-100 p-6 md:p-10 rounded-lg shadow-lg my-6 border border-gray-200">
    <!-- Icon/Image -->
    <div class="flex-shrink-0 w-full md:w-32 mb-6 md:mb-0 mr-0 md:mr-12">
        <div class="aspect-w-4 aspect-h-3">
            <img src="{{ $img_src }}" class="object-cover rounded-lg" alt="{{ $caption }} symbol">
        </div>
        <figcaption class="text-center font-semibold text-gray-800 mt-2">
            {{ $caption }}
        </figcaption>
    </div>

    <!-- Text Content -->
    <div class="flex-grow">
        <h3 class="text-2xl font-semibold mb-4">{{ $title }}</h3>
        <p class="text-lg leading-relaxed text-gray-700 max-w-prose">{{ $description }}</p>
    </div>
</div>
