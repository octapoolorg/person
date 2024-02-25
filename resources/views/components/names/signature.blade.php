<section class="px-4 py-10 md:p-8 border dark:border-base-700 my-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800">
    <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 font-semibold">
        Signature styles for {!! $name->name !!}
    </h2>
    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
        A signature is a personalized representation of your name. It is a unique and stylish way to
        express your identity. Choose from a variety of signature styles to find the one that best suits
        you.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center md:justify-start mt-8 md:mt-16">
        @foreach ($data['signatureUrls']->random(3) as $url)
            <img
                src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
                data-src="{!! $url !!}" alt="{!! $name->name !!} name Signature"
                class="p-1 dark:opacity-80 lazy object-contain"
            >
        @endforeach
    </div>

    @if ($name->is_popular)
        <div class="flex flex-col md:flex-row items-end md:items-center justify-end my-6 md:mt-16">
            <a href="{{ route('names.signatures', $name->slug) }}" target="_blank"
                class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center">
                More signature styles for {!! $name->name !!}
                <i class="fas fa-arrow-right ml-2 text-primary-600 dark:text-primary-400 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
            </a>
        </div>
    @endif
</section>