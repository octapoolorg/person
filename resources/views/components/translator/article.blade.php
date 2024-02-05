@props(['source', 'target'])

<section class="max-w-7xl mx-auto bg-surface rounded-xl shadow-lg overflow-hidden mb-14 p-8 hover:shadow-xl transition-shadow duration-300 dark:bg-base-800 dark:text-base-200" itemscope itemtype="https://schema.org/Article">
    <article class="prose prose-base dark:prose-invert max-w-full lg:max-w-none">
        <h2 class="text-2xl font-bold text-base-800 dark:text-surface" itemprop="headline">
            {!! __('content.translator.article.title', ['source' => $source->name, 'target' => $target->name]) !!}
        </h2>
        <section>
            <h3 class="text-lg font-semibold text-base-800 dark:text-surface">
                {!! $source->name !!}
            </h3>
            <p class="text-base-600 dark:text-base-300">
                {!! $source->about !!}
            </p>
            <h3 class="text-lg font-semibold text-base-800 dark:text-surface">
                {!! $target->name !!}
            </h3>
            <p class="text-base-600 dark:text-base-300">
                {!! $target->about !!}
            </p>
        </section>
        <section itemprop="articleBody">
            <p>
                {!! __('content.translator.article.intro.part1', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>
            <p>
                {!! __('content.translator.article.intro.part2', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.features.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.features.intro', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>
            <ul class="list-disc pl-5 space-y-2">
                @foreach( __('content.translator.article.features.list') as $feature)
                    <li class="font-medium">
                        <strong>{!! $feature['title'] !!}</strong> - {!! $feature['description'] !!}
                    </li>
                @endforeach
            </ul>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.technology.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.technology.description', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.testimonials.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.testimonials.intro') !!}
            </p>
            @foreach(__('content.translator.article.testimonials.quotes') as $quote)
                <div class="px-2 my-5 italic ltr:border-l-4 rtl:border-r-4 border-primary-500">
                    "{!! $quote['quote'] !!}" - <span class="font-semibold">{!! $quote['author'] !!}</span>
                </div>
            @endforeach

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.comparison.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.comparison.description', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.updates.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.updates.description') !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.tips.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.tips.description') !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.privacy.title') !!}
            </h3>
            <p>
                {!! __('content.translator.article.privacy.description') !!}
            </p>

            <h3 class="text-xl font-semibold mt-6">
                {!! __('content.translator.article.faqs.title', ['source' => $source->name, 'target' => $target->name]) !!}
            </h3>
            <p>
                {!! __('content.translator.article.faqs.description', ['source' => $source->name, 'target' => $target->name]) !!}
            </p>

            <section itemscope itemtype="https://schema.org/FAQPage">
                @foreach(__('content.translator.article.faqs.items', ['source' => $source->name, 'target' => $target->name]) as $question)
                    <div itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
                        <h4 class="mt-4 font-semibold text-base-800 dark:text-surface" itemprop="name">
                            <i class="fas fa-question-circle mr-2 text-primary-500"></i>
                            {!! $question['question'] !!}
                        </h4>
                        <div itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
                            <p class="text-base-600 dark:text-base-300" itemprop="text">{!! $question['answer'] !!} </p>
                        </div>
                    </div>
                @endforeach
            </section>
        </section>
    </article>
</section>