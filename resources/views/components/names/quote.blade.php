<section
    class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700 bg-surface dark:bg-base-800">
    <div class="mb-8">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold capitalize">
            Quotes for {!! $name->name !!}
        </h2>
    </div>
    <div class="flex flex-col gap-8">
        @foreach($data['quotes'] as $quote)
            <div class="bg-surface border-l-4 border-primary-500 rounded-lg shadow-sm p-6">
                <p class="text-base-600 text-lg">
                    {!! $quote !!}
                </p>
            </div>
        @endforeach
    </div>
</section>