<section
    class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700 bg-surface dark:bg-base-800">
    <div class="mb-8">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold capitalize">
            Quotes for {!! $name->name !!}
        </h2>
    </div>
    <div class="flex flex-col gap-8">
        @foreach ($data['quotes'] as $quote)
            <blockquote class="bg-primary-50 dark:bg-base-900 rounded-lg shadow dark:shadow-none">
                <div class="relative z-10 px-8 py-10">
                    <i class="fas fa-quote-left text-4xl absolute top-5 left-3 -start-8 size-16 text-primary-100 dark:text-base-700 -z-10"></i>
                    <p class="text-base-800 sm:text-xl dark:text-surface"><em>
                            {{ $quote }}
                        </em></p>
                </div>
            </blockquote>
        @endforeach
    </div>
</section>
