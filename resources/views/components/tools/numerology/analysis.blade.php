@php
    $colors = [
        'life_path' => 'primary',
        'soul_urge' => 'rose',
        'personality' => 'green',
    ];
    $color = $colors[$type];
@endphp

{{--
    Tailwind CSS JIT: Include these classes
    border-primary-600 bg-primary-50 dark:bg-primary-950 text-primary-700 dark:text-primary-300 dark:text-primary-200
    border-rose-600 bg-rose-50 dark:bg-rose-950 text-rose-700 dark:text-rose-300 dark:text-rose-200
    border-green-600 bg-green-50 dark:bg-green-950 text-green-700 dark:text-green-300 dark:text-green-200
--}}

<div
    class="rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden border-l-4 dark:border-none border-{!! $color !!}-600">
    <div class="px-10 py-8 bg-{!! $color !!}-50 dark:bg-{!! $color !!}-950 shadow-inner text-base-700 relative">
        <h3 class="text-3xl font-semibold text-{!! $color !!}-700 dark:text-{!! $color !!}-300">
            {!! str($type)->headline() !!} Number
            <span class="absolute top-5 right-5 text-{!! $color !!}-600 dark:text-surface text-5xl font-bold">{{ $data['numerology']['numbers'][$type] }}</span>
        </h3>
        <div class="dark:text-{!! $color !!}-200">
            <p class="text-md my-4 font-bold dark:text-base-50">
                {!! __(
                    "tools/numerology/calculator/result.$type." . $data['numerology']['numbers'][$type] . '.title',
                    ['name' => $data['name']],
                ) !!}
            </p>
            <p class="text-md">
                {!! __(
                    "tools/numerology/calculator/result.$type." . $data['numerology']['numbers'][$type] . '.description',
                    ['name' => $data['name']],
                ) !!}
            </p>

            <!-- Details Accordion -->
            <details class="group py-5">
                <summary class="cursor-pointer text-lg font-semibold">
                    <span class="outline-none focus:outline-none dark:text-surface">Check Details</span>
                </summary>
                <div class="mt-4 space-y-4">
                    <div>
                        <h4 class="text-xl font-semibold dark:text-base-100">Advice</h4>
                        <p class="">
                            {!! __(
                                "tools/numerology/calculator/result.$type." . $data['numerology']['numbers'][$type] . '.advice',
                                ['name' => $data['name']],
                            ) !!}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold dark:text-base-100">Challenges</h4>
                        <p class="">
                            {!! __(
                                "tools/numerology/calculator/result.$type." . $data['numerology']['numbers'][$type] . '.challenges',
                                ['name' => $data['name']],
                            ) !!}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold dark:text-base-100">Affirmation</h4>
                        <p class="italic">
                            {!! __(
                                "tools/numerology/calculator/result.$type." . $data['numerology']['numbers'][$type] . '.affirmation',
                                ['name' => $data['name']],
                            ) !!}
                        </p>
                    </div>
                </div>
            </details>
        </div>
    </div>
</div>