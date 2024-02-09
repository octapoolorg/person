<section class="px-4 py-10 md:p-8 border dark:border-base-700 mb-10 rounded-lg shadow dark:shadow-none">
    <h2 class="text-2xl mb-6 text-base-900 dark:text-base-100">Signatures for
        {{ $data['nameDetails']->name }}</h2>
    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
        @foreach ($data['signatureUrls'] as $font => $url)
            <img src="{{ $url }}" alt="{{ $data['nameDetails']->name }} name Signature"
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 dark:opacity-80">
        @endforeach
    </div>
</section>