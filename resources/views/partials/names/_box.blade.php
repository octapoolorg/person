<div class="d-flex flex-column flex-md-row align-items-md-center my-2 py-2">
    <div class="flex-grow-1 ms-md-3 me-md-4">
        <h3>{{ $title }}</h3>
        <p>{!! $description !!}</p>
    </div>
    <div class="flex-shrink-0">
        <div class="symbol d-flex align-items-center justify-content-center symbol-container">
            <figure class="figure">
                <img src="{!! $img_src !!}" class="figure-img img-fluid rounded" alt="{{ $caption }} symbol">
                <figcaption class="figure-caption text-center fw-bolder text-black">
                    {{ $caption }}
                </figcaption>
            </figure>
        </div>
    </div>
</div>
