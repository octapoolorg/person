<div class="flex flex-col md:flex-row items-center my-4 md:my-6 py-4">
    <div class="flex-grow md:ml-4 md:mr-6 mb-4 md:mb-0">
        <h3 class="text-xl mb-2">{{ $title }}</h3>
        <p class="text-base leading-relaxed">{{ $description }}</p>
    </div>
    <div class="flex-shrink-0 w-full md:w-28">
        <div class="aspect-w-4 aspect-h-3">
            <img src="{{ $img_src }}" class="object-cover rounded" alt="{{ $caption }} symbol">
        </div>
        <figcaption class="text-center font-bold text-black mt-2">
            {{ $caption }}
        </figcaption>
    </div>
</div>
