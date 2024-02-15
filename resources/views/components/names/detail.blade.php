<div class="bg-primary-500 dark:bg-primary-800 text-center py-4 rounded-t-xl">
    <p class="text-md text-surface font-bold text-lg text-start px-4 dark:text-base-300" id="gender">
        @if ($name->isMasculine())
            <i class="fas fa-mars"></i>
        @elsif ($name->isFeminine())
            <i class="fas fa-venus"></i>
        @endif
        {{ $name->gender->name }}
    </p>
</div>
<section
    class="max-w-4xl mx-auto border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800 overflow-hidden text-base-900 dark:text-base-100 p-8 md:py-16 relative">
    <article class="text-center">
        <div x-data>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 dark:text-base-100">
                <input type="hidden" id="name" value="{{ $name->name }}" x-ref="name">
                {{ $name->name }}
                <a href="javascript:;" @click.prevent="SpeechManager.speak($refs.name.value.trim())" id="speak"
                    class="hidden text-lg text-green-500 dark:text-green-400 hover:text-green-600 dark:hover:text-green-500">
                    <i class="fas fa-volume-up"></i>
                </a>
            </h1>
        </div>

        <div class="mt-8">
            <strong class="text-xl font-semibold uppercase dark:text-base-200">
                Means:
            </strong>
            <div class="text-base sm:text-lg mt-2 break-words dark:text-base-300 capitalize">
                {!! $name->mainMeaning !!}
            </div>
        </div>

        @if ($name->generated)
            <div class="flex justify-center mb-4">
                <div class="relative group">
                    <i class="fas fa-info-circle text-lg text-primary-500 dark:text-primary-400"></i>
                    <div
                        class="absolute bottom-full mb-2 hidden group-hover:block bg-base-900 dark:bg-base-700 text-surface text-xs rounded py-1 px-3">
                        Based on Numerology.
                    </div>
                </div>
            </div>
        @endif
    </article>

    <a href="javascript:;"
        class="absolute top-4 right-4 text-pink-600 dark:text-pink-500 hover:text-pink-700 dark:hover:text-pink-600 favorite-button"
        data-slug="{{ $name->slug }}">
        <i class="far fa-heart text-2xl" id="favorite-icon"></i>
    </a>
</section>

@if (!$name->meanings->isEmpty())
<div id="accordion-collapse" data-accordion="collapse" data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
    <h2 id="expand-meanings">
        <button type="button"
            class="flex items-center justify-between w-full py-4 px-5 font-medium rtl:text-right text-base-500 border border-t-0 border-base-200 dark:border-base-700 dark:text-base-400 gap-3 bg-base-50 dark:bg-base-800"
            data-accordion-target="#meanings"
            aria-expanded="false" aria-controls="meanings">
            <span>
                Other Meanings
            </span>
            <i data-accordion-icon class="fas fa-chevron-down" aria-hidden="true"></i>
        </button>
    </h2>
    <div id="meanings" class="hidden" aria-labelledby="expand-meanings">
        <div class="p-5 border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800">
            <ul
                class="text-left space-y-1 text-base-500 list-none list-outside dark:text-base-400 p-3">
                @foreach ($name->meanings as $meaning)
                    <li class="flex gap-2 text-base-500 dark:text-base-400 text-lg">
                        <i class="fas fa-check text-primary-500 dark:text-primary-400 mt-1"></i>
                        <p>
                            {!! $meaning !!}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="mt-8 border-0 border-base-200 dark:border-base-700">
    <div class="flex flex-wrap gap-2">
        @foreach ($name->origins->sortBy('name',SORT_NATURAL) as $origin)
            <a class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800 dark:bg-primary-800 dark:text-primary-100 hover:bg-primary-200 dark:hover:bg-primary-900"
            href="{!! route('names.origin', ['origin' => $origin->slug]) !!}">
                <i class="fas fa-globe mr-2"></i>
                {{ $origin->name }}
            </a>
        @endforeach
    </div>
</div>