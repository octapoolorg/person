<div class="flex flex-col md:flex-row items-start md:items-center bg-gray-100 p-6 md:p-8 rounded shadow my-6 border">
    <!-- Icon/Image -->
    <div class="flex-shrink-0 w-full md:w-32 mb-4 md:mb-0 mr-0 md:mr-8">
        <div class="aspect-w-4 aspect-h-3">
            <img src="{{ $img_src }}" class="object-cover rounded" alt="{{ $caption }} symbol">
        </div>
        <figcaption class="text-center font-bold text-gray-900 mt-2">
            {{ $caption }}
        </figcaption>
    </div>

    <!-- Text Content -->
    <div class="flex-grow">
        <h3 class="text-2xl font-semibold mb-3">{{ $title }}</h3>
        <p class="text-lg leading-relaxed text-gray-700">{{ $description }}</p>
    </div>
</div>
