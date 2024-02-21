<section
    class="px-6 py-10 my-10 text-base-800 dark:text-base-100 rounded-lg shadow dark:shadow-none border-t dark:border border-base-100 dark:border-base-700 bg-surface dark:bg-base-800">
    <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-bold capitalize">
        {!! $name->name !!} Name - Fancy Texts
    </h2>
    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
        Experience the elegance of {!! $name->name !!}
        presented in various distinctive text styles. Each style is crafted
        to highlight the uniqueness of the name, adding a touch of sophistication
        and charm to your content.
    </p>
    <div class="flex flex-col md:flex-row items-end md:items-center justify-end mb-6">
        <a href="javascript:" id="generate-fancy-texts"
            class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center">
            Generate new styles
            <i class="fas fa-sync-alt ml-2 text-primary-600 dark:text-primary-400 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <ul class="divide-y divide-base-200 dark:divide-base-700" id="fancy-texts">
            @foreach ($data['fancyTexts'] as $fancyText)
                <li tabindex="0"
                    class="text-lg p-4 hover:bg-base-100 dark:hover:bg-base-800 transition ease-in-out duration-150 cursor-pointer copy-to-clipboard text-base-900 dark:text-base-100"
                    aria-label="Select {!! $fancyText !!} style">
                    {!! $fancyText !!}
                </li>
            @endforeach
        </ul>
    </div>
</section>