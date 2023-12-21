<!-- FAQ Section -->
<section class="px-6 py-10 mb-10 rounded-lg shadow dark:shadow-none border dark:border-slate-700" itemscope itemtype="https://schema.org/FAQPage">
    <h2 class="text-2xl md:text-4xl text-slate-800 dark:text-slate-100 mb-4 md:mb-10 font-bold capitalize">
        Frequently Asked Questions about
        <span class="text-2xl leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
            ({{ $data['nameDetails']->name }})
        </span>
    </h2>

    <div class="mx-auto space-y-6 divide-y divide-slate-200 dark:divide-slate-700">

        @if(!empty($data['nameDetails']->meaning))
            <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 itemprop="name" class="text-xl text-slate-800 dark:text-slate-100 font-bold py-4">
                    What is the meaning of {{ $data['nameDetails']->name }}?
                </h3>
                <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text" class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                        The meaning of {{ $data['nameDetails']->name }} is "{{ $data['nameDetails']->meaning }}".
                    </p>
                </div>
            </div>
        @endif

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-xl text-slate-800 dark:text-slate-100 font-bold py-4">
                Is {{ $data['nameDetails']->name }} typically a male or female name?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                    Typically, {{ $data['nameDetails']->name }} is associated with the {{ $data['nameDetails']->gender->name }} gender. This traditional identification may vary based on cultural and regional influences.
                </p>
            </div>
        </div>

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-xl text-slate-800 dark:text-slate-100 font-bold py-4">
                What are the key numerology insights for {{ $data['nameDetails']->name }}?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 max-w-prose">
                    In numerology, {{ $data['nameDetails']->name }} has a destiny number of {{ $data['numerology']['numbers']['destiny'] }},
                    reflecting {{ trans('numerology.traits.destiny.' . $data['numerology']['numbers']['destiny']) }}.
                    The soul urge number is {{ $data['numerology']['numbers']['soul_urge'] }},
                    indicating {{ trans('numerology.traits.soul_urge.' . $data['numerology']['numbers']['soul_urge']) }},
                    and the personality number is {{ $data['numerology']['numbers']['personality'] }},
                    suggesting {{ trans('numerology.traits.personality.' . $data['numerology']['numbers']['personality']) }}.
                </p>
            </div>
        </div>
    </div>
</section>