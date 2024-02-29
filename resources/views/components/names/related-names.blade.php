@if (
    $name->is_popular &&
        $name->siblingNames->isNotEmpty() ||
        $name->similarNames->isNotEmpty() ||
        $name->nicknames->isNotEmpty())
    <section class="bg-surface dark:bg-base-800 py-12 my-10 shadow rounded-lg" id="related-names">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold capitalize">
                Explore More About {!! $name->name !!} Name
            </h2>

            <p class="mt-3 text-base-600 dark:text-base-400">
                Discover more about {!! $name->name !!} name, common sibling names, nicknames, and similar names.
            </p>

            <div class="mt-12 space-y-12">

                @if ($name->nicknames->isNotEmpty())
                    <!-- Nicknames Section -->
                    <div class="bg-yellow-50 dark:bg-yellow-800 rounded-lg shadow px-5 py-7">
                        <h3 class="text-2xl font-semibold text-yellow-600 dark:text-yellow-100">Nicknames</h3>
                        <p class="mt-3 text-base-600 dark:text-base-200">
                            Nicknames offer a personal touch to {!! $name->name !!}, showcasing affection and
                            individuality within your unique family dynamic.
                        </p>
                        <div x-data class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($name->nicknames as $nick)
                                <span
                                    class="inline-flex items-center justify-center px-4 py-2 bg-yellow-100 dark:bg-yellow-600 dark:hover:bg-yellow-700 text-base-800 dark:text-base-300 rounded-md shadow text-base font-medium">
                                    <a href="javascript:" class="speak hidden" @click.prevent="SpeechManager.speak($refs.nickname{!! $loop->index !!}.innerText.trim())">
                                        <i class="fas fa-volume-up mr-2 text-yellow-600 dark:text-yellow-100 text-xs cursor-pointer hover:text-yellow-800 dark:hover:text-yellow-200"></i>
                                    </a>
                                    <span x-ref="nickname{!! $loop->index !!}">{{ $nick->name }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($name->similarNames->isNotEmpty())
                    <!-- Similar Names Section -->
                    <div class="bg-green-50 dark:bg-green-900 rounded-lg shadow px-5 py-7">
                        <h3 class="text-2xl font-semibold text-green-600 dark:text-primary-100">Similar Names</h3>
                        <p class="mt-3 text-base-600 dark:text-base-200">
                            Discover names similar to {!! $name->name !!}, ideal for those who love the name but are
                            looking for alternatives with a unique twist.
                        </p>
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($name->similarNames as $similar)
                                <a href="{{ route('names.show', $similar->slug) }}" target="_blank"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-green-100 dark:bg-green-600 dark:hover:bg-green-700 text-base-800 dark:text-base-300 rounded-md shadow text-base font-medium">
                                    {{ $similar->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($name->siblingNames->isNotEmpty())
                <!-- Sibling Names Section -->
                <div class="bg-base-50 dark:bg-base-700 rounded-lg shadow px-5 py-7">
                    <h3 class="text-2xl font-semibold text-base-600 dark:text-base-200">Sibling Names</h3>
                    <p class="mt-3 text-base-600 dark:text-base-200">
                        Explore names that complement the unique personality of {!! $name->name !!}'s siblings.
                        Perfect for finding a harmonious balance in your family.
                    </p>
                    <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($name->siblingNames as $sibling)
                            <a href="{{ route('names.show', $sibling->slug) }}" target="_blank"
                                @class([
                                'inline-flex items-center justify-center px-4 py-2 rounded-md shadow text-base font-medium',
                                'bg-sky-200 dark:bg-sky-600 dark:hover:bg-sky-700 text-base-800 dark:text-base-300' => $sibling->isMasculine(),
                                'bg-pink-200 dark:bg-pink-600 dark:hover:bg-pink-700 text-base-800 dark:text-base-300' => $sibling->isFeminine(),
                                'bg-primary-200 dark:bg-primary-700 text-base-800 dark:text-base-300' => !( $sibling->isMasculine() || $sibling->isFeminine() ),
                            ])>
                                {{ $sibling->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            </div>
        </div>
    </section>
@endif
