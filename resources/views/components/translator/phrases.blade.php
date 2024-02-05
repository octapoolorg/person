@props(['source', 'target', 'phrases'])

@foreach ($phrases as $category => $phraseGroup)
    <section class="max-w-7xl mx-auto mb-10 p-6 bg-surface dark:bg-base-800 rounded-lg shadow-lg relative" itemscope itemtype="http://schema.org/ItemList">
        <h2 class="text-xl md:text-2xl font-semibold text-base-800 dark:text-surface p-3" itemprop="name">
            <span class="text-base-600 dark:text-base-400 mr-2">
                {{ $loop->iteration }}.
            </span>
            {!! __("content.translator.phrases.$category.title", ['source' => $source->name, 'target' => $target->name]) !!}

            <div class="absolute text-2xl md:text-4xl text-base-300 dark:text-base-700 pointer-events-none ltr:right-5 rtl:left-5 top-2 md:top-5">
                {!! __("content.translator.phrases.$category.icon") !!}
            </div>
        </h2>

        <p class="mt-2 text-base-600 dark:text-base-400 text-md px-3" itemprop="description">
            {!! __("content.translator.phrases.$category.description", ['source' => $source->name, 'target' => $target->name]) !!}
        </p>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-base text-base-700 dark:text-base-200">
                <thead>
                    <tr class="bg-base-100 dark:bg-base-700">
                        <th scope="col" @class(['px-6 py-3', 'text-left' => !$source->isRtl(), 'text-right' => $source->isRtl()])>
                            {!! $source->name !!}
                        </th>
                        <th scope="col" @class(['px-6 py-3', 'text-left' => !$target->isRtl(), 'text-right' => $target->isRtl()])>
                            {!! $target->name !!}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 dark:divide-base-600" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    @foreach ($phraseGroup as $rootPhraseId => $phrases)
                        <tr class="hover:bg-base-50 dark:hover:bg-base-700">
                            <td class="px-6 py-4 whitespace-nowrap" dir="{!! $source->rootLanguage->dir !!}" itemprop="text">
                                {!! $phrases['source']->phrase !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" dir="{!! $target->rootLanguage->dir !!}" itemprop="text">
                                {!! $phrases['target']->phrase !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endforeach