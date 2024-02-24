<section class="shadow" x-data>
    <div class="bg-primary-500 dark:bg-primary-800 py-4 shadow rounded-t-xl flex items-center justify-between px-5">
        <p class="text-lg font-bold text-surface dark:text-base-300" id="gender">
            <i @class([
                'fas text-xl',
                'fa-mars' => $name->isMasculine(),
                'fa-venus' => $name->isFeminine(),
            ])>
            </i>
            {{ $name->gender }}
        </p>
    </div>
    <section
        class="max-w-4xl mx-auto border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800 overflow-hidden text-base-900 dark:text-base-100 p-8 md:py-16 relative">
        <article class="text-center">
            <div class="md:px-10">
                <h1
                    class="text-3xl text-center md:text-6xl font-bold py-10 md:py-4 dark:text-base-100 leading-relaxed break-words">
                    <input type="hidden" id="name" value="{{ $name->name }}" x-ref="name">
                    {{ $name->name }}
                </h1>

                @isset($name->pronunciation)
                    <!-- IPA Pronunciation -->
                    <div class="flex items-center justify-center gap-2">
                        {{-- <i class="fas fa-volume-up text-green-500 dark:text-green-400 text-lg"></i> --}}
                        <p class="text-base-500 dark:text-base-400">
                            {{ $name->pronunciation }}
                        </p>
                    </div>
                @endisset
            </div>

            <div class="mt-8">
                <div class="text-base sm:text-lg mt-2 break-words dark:text-base-300 capitalize leading-relaxed">
                    {!! $name->mainMeaning !!}
                </div>
            </div>
        </article>

        <div class="flex justify-center items-center gap-6 mt-8">
            <a href="javascript:;" title="Add to favorites"
                class="text-pink-500 dark:text-pink-500 hover:text-pink-600 dark:hover:text-pink-600 favorite-button"
                data-slug="{{ $name->slug }}">
                <i class="far fa-heart text-xl md:text-2xl" id="favorite-icon"></i>
            </a>

            <a href="javascript:;" @click.prevent="SpeechManager.speak($refs.name.value.trim())" id="speak"
                class="text-lg md:text-2xl text-green-500 hover:text-green-600">
                <i class="fas fa-volume-up"></i>
            </a>
        </div>
    </section>

    @if (!$name->origins->isEmpty())
        <div id="accordion-collapse-origin" data-accordion="collapse"
            data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
            <h2 id="expand-origin">
                <button type="button"
                    class="flex items-center justify-between w-full py-4 px-5 font-medium rtl:text-right text-base-500 border border-t-0 border-base-200 dark:border-base-700 dark:text-base-400 gap-3 bg-base-50 dark:bg-base-800"
                    data-accordion-target="#origin" aria-expanded="false" aria-controls="origin">
                    <span>
                        Meanings by Origin
                    </span>
                    <i data-accordion-icon class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
            </h2>
            <div id="origin" class="hidden" aria-labelledby="expand-origin">
                <div class="p-8 bg-base-100 dark:bg-base-800">
                    <div @class([
                        'grid grid-cols-1 gap-6 items-stretch',
                        'md:grid-cols-2' => $name->origins->count() > 1,
                    ])>
                        @foreach ($name->origins as $origin)
                            <div class="bg-surface dark:bg-base-700 rounded-lg shadow p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <i class="fas fa-atlas text-primary-500 dark:text-primary-300 text-3xl"></i>
                                    <h3 class="text-xl font-semibold text-base-800 dark:text-base-200">
                                        <a href="{{ route('names.search', ['origin' => $origin->slug]) }}"
                                            class="hover:text-primary-500 dark:hover:text-primary-400">
                                            {{ $origin->name }}
                                        </a>
                                    </h3>
                                </div>
                                <ul class="text-base-600 dark:text-base-400 text-lg list-inside">
                                    @foreach ($origin->meanings as $meaning)
                                        <li>{{ $meaning->text }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @elseif (!$name->meanings->isEmpty())
        <div id="accordion-collapse-meanings" data-accordion="collapse"
            data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
            <h2 id="expand-meanings">
                <button type="button"
                    class="flex items-center justify-between w-full py-4 px-5 font-medium rtl:text-right text-base-500 border border-t-0 border-base-200 dark:border-base-700 dark:text-base-400 gap-3 bg-base-50 dark:bg-base-800"
                    data-accordion-target="#meanings" aria-expanded="false" aria-controls="meanings">
                    <span>
                        Other Meanings
                    </span>
                    <i data-accordion-icon class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
            </h2>
            <div id="meanings" class="hidden" aria-labelledby="expand-meanings">
                <div class="p-5 border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800">
                    <ul class="text-left space-y-1 text-base-500 list-none list-outside dark:text-base-400 p-3">
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

    @if ($name->is_simple or $name->is_popular)
        <div id="accordion-collapse-external-links" data-accordion="collapse"
            data-inactive-classes="bg-base-50 dark:bg-base-800" data-active-classes="bg-base-100 dark:bg-base-700">
            <h2 id="expand-external-links">
                <button type="button"
                    class="flex items-center justify-between w-full py-4 px-5 font-medium rtl:text-right text-base-500 border border-t-0 border-base-200 dark:border-base-700 dark:text-base-400 gap-3 bg-base-50 dark:bg-base-800"
                    data-accordion-target="#external-links" aria-expanded="false" aria-controls="external-links">
                    <span>
                        External links
                    </span>
                    <i data-accordion-icon class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
            </h2>
            <div id="external-links" class="hidden" aria-labelledby="expand-external-links">
                <div class="p-5 border border-base-200 dark:border-base-700 bg-base-50 dark:bg-base-800">
                    <ul
                        class="flex flex-wrap gap-4 text-left text-base-500 list-none list-outside dark:text-base-400 p-3">
                        <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                            <img src="{{ asset('static/images/wikipedia.png') }}" alt="WikiPedia" class="w-6 h-6">
                            <a href="https://en.wikipedia.org/w/index.php?search={{ $name->name }}" target="_blank"
                                rel="noopener noreferrer" class="hover:text-primary-500 dark:hover:text-primary-400">
                                Wikipedia
                            </a>
                        </li>
                        <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                            <img src="{{ asset('static/images/ancestry.png') }}" alt="Ancestry" class="w-6 h-6">
                            <a href="https://www.ancestry.com/name-origin?surname={{ $name->slug }}" target="_blank"
                                rel="noopener noreferrer" class="hover:text-primary-500 dark:hover:text-primary-400">
                                Ancestry
                            </a>
                        </li>
                        <!-- Wiktionary -->
                        <li class="flex items-center gap-2 text-base-500 dark:text-base-400 text-lg">
                            <i class="fab fa-wikipedia-w mt-1"></i>
                            <a href="https://en.wiktionary.org/w/index.php?search={{ $name->name }}"
                                target="_blank" rel="noopener noreferrer"
                                class="hover:text-primary-500 dark:hover:text-primary-400">
                                Wiktionary
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

</section>
