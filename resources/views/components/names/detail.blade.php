<div class="bg-primary-500 dark:bg-primary-800 text-center py-4 shadow rounded-t-xl">
    <p class="text-lg font-bold text-surface dark:text-base-300 px-4 flex items-center justify-start gap-2" id="gender">
        @if ($name->isMasculine())
            <i class="fas fa-mars text-xl"></i>
        @elseif ($name->isFeminine())
            <i class="fas fa-venus text-xl"></i>
        @endif
        {{ $name->gender->name }}
    </p>
</div>
<section
    class="max-w-4xl mx-auto border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800 overflow-hidden text-base-900 dark:text-base-100 p-8 md:py-16 relative">
    <article class="text-center">
        <div x-data>
            <h1 class="text-5xl md:text-7xl font-bold mb-4 dark:text-base-100 inline-block relative">
                <input type="hidden" id="name" value="{{ $name->name }}" x-ref="name">
                {{ $name->name }}
                <a href="javascript:;" @click.prevent="SpeechManager.speak($refs.name.value.trim())" id="speak"
                    class="hidden text-lg text-green-500 dark:text-green-400 hover:text-green-600 dark:hover:text-green-500 absolute top-0 -right-10">
                    <i class="fas fa-volume-up"></i>
                </a>
            </h1>
        </div>

        <div class="mt-8">
            <div class="text-base sm:text-lg mt-2 break-words dark:text-base-300 capitalize leading-relaxed">
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

    <a href="javascript:;" title="Add to favorites"
        class="absolute top-5 right-5 text-pink-500 dark:text-pink-500 hover:text-pink-600 dark:hover:text-pink-600 favorite-button"
        data-slug="{{ $name->slug }}">
        <i class="far fa-heart text-2xl md:text-3xl" id="favorite-icon"></i>
    </a>
</section>

@if (!$name->meanings->isEmpty())
<div id="accordion-collapse-meanings" data-accordion="collapse" data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
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

<div id="accordion-collapse-external-links" data-accordion="collapse" data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
    <h2 id="expand-external-links">
        <button type="button"
            class="flex items-center justify-between w-full py-4 px-5 font-medium rtl:text-right text-base-500 border border-t-0 border-base-200 dark:border-base-700 dark:text-base-400 gap-3 bg-base-50 dark:bg-base-800"
            data-accordion-target="#external-links"
            aria-expanded="false" aria-controls="external-links">
            <span>
                External links
            </span>
            <i data-accordion-icon class="fas fa-chevron-down" aria-hidden="true"></i>
        </button>
    </h2>
    <div id="external-links" class="hidden" aria-labelledby="expand-external-links">
        <div class="p-5 border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800">
            <ul class="flex flex-wrap gap-4 text-left text-base-500 list-none list-outside dark:text-base-400 p-3">
                <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                    <img src="{{ asset('static/images/wikipedia.png') }}" alt="WikiPedia" class="w-6 h-6">
                    <a href="https://en.wikipedia.org/w/index.php?search={{ $name->name }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-500 dark:hover:text-primary-400">
                        Wikipedia
                    </a>
                </li>
                <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                    <img src="{{ asset('static/images/ancestry.png') }}" alt="Ancestry" class="w-6 h-6">
                    <a href="https://www.ancestry.com/name-origin?surname={{ $name->slug }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-500 dark:hover:text-primary-400">
                        Ancestry
                    </a>
                </li>
                <!-- Wiktionary -->
                <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                    <i class="fab fa-wikipedia-w mt-1"></i>
                    <a href="https://en.wiktionary.org/w/index.php?search={{ $name->name }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary-500 dark:hover:text-primary-400">
                        Wiktionary
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
