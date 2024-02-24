@if ($name->is_popular || $name->siblingNames->isNotEmpty() || $name->similarNames->isNotEmpty() || $name->nicknames->isNotEmpty())
    <section class="bg-base-50 dark:bg-base-900 py-12 my-10 shadow rounded-lg">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-semibold text-base-900 dark:text-surface">
                Explore More About {!! $name->name !!} Name
            </h2>

            <p class="mt-3 text-base-600 dark:text-base-400">
                Discover more about {!! $name->name !!} name, common sibling names, nicknames, and similar names.
            </p>

            <div class="mt-12 space-y-12">
                @if($name->siblingNames->isNotEmpty())
                    <!-- Sibling Names Section -->
                    <div class="bg-surface dark:bg-base-800 rounded-lg shadow px-5 py-7">
                        <h3 class="text-2xl font-semibold text-primary-600">Sibling Names</h3>
                        <p class="mt-3 text-base-600 dark:text-base-400">
                            Explore names that complement the unique personality of {!! $name->name !!}'s siblings.
                            Perfect for finding a harmonious balance in your family.
                        </p>
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($name->siblingNames as $sibling)
                                <a href="{{ route('names.show', $sibling->slug) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-surface rounded-md shadow text-base font-medium">
                                    {{ $sibling->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($name->similarNames->isNotEmpty())
                    <!-- Similar Names Section -->
                    <div class="bg-surface dark:bg-base-800 rounded-lg shadow px-5 py-7">
                        <h3 class="text-2xl font-semibold text-green-600">Similar Names</h3>
                        <p class="mt-3 text-base-600 dark:text-base-400">
                            Discover names similar to {!! $name->name !!}, ideal for those who love the name but are
                            looking for alternatives with a unique twist.
                        </p>
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($name->similarNames as $similar)
                                <a href="{{ route('names.show', $similar->slug) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-surface rounded-md shadow text-base font-medium">
                                    {{ $similar->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($name->nicknames->isNotEmpty())
                    <!-- Nicknames Section -->
                    <div class="bg-surface dark:bg-base-800 rounded-lg shadow px-5 py-7">
                        <h3 class="text-2xl font-semibold text-yellow-600">Nicknames</h3>
                        <p class="mt-3 text-base-600 dark:text-base-400">
                            Nicknames offer a personal touch to {!! $name->name !!}, showcasing affection and
                            individuality within your unique family dynamic.
                        </p>
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($name->nicknames as $nick)
                                <span
                                    class="inline-flex items-center justify-center px-4 py-2 bg-base-200 dark:bg-base-700 text-base-800 dark:text-base-300 rounded-md shadow text-base font-medium">
                                    {{ $nick->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
