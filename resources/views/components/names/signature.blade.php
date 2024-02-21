<section class="px-4 py-10 md:p-8 border dark:border-base-700 mb-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800">
    <h2 class="text-2xl mb-6 text-base-900 dark:text-base-100">
        Signatures for {!! $name->name !!} Name
    </h2>
    @if ($name->is_popular)
        <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6">
            <a href="{{ route('names.signatures', $name->slug) }}" target="_blank"
                class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center">
                More signature styles for {!! $name->name !!}
                <i class="fas fa-arrow-right ml-2 text-primary-600 dark:text-primary-400 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
            </a>
        </div>
    @endif
    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
        @foreach ($data['signatureUrls'] as $font => $url)
            <img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
            data-src="{!! $url !!}" alt="{!! $name->name !!} name Signature"
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 dark:opacity-80 lazy">
        @endforeach
    </div>
</section>