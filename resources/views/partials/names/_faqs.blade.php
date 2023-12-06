<!-- FAQ Section -->
<section class="px-6 py-10 mb-10 rounded-lg shadow dark:shadow-none dark:bg-gray-800" itemscope itemtype="https://schema.org/FAQPage">
    <h2 class="mb-8 text-3xl text-gray-700 dark:text-gray-100 font-bold">
        Frequently Asked Questions about <span class="text-gray-600 dark:text-gray-300">({{ $data['nameDetails']->name }})</span>
    </h2>

    <div class="mx-auto bg-white dark:bg-gray-800 space-y-6 divide-y divide-gray-200 dark:divide-gray-700">

        @if(!empty($data['nameDetails']->meaning))
            <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 itemprop="name" class="text-lg text-gray-800 dark:text-gray-100 font-bold py-4">
                    What is the meaning of {{ $data['nameDetails']->name }}?
                </h3>
                <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text" class="text-gray-600 dark:text-gray-300">
                        The meaning of {{ $data['nameDetails']->name }} is "{{ $data['nameDetails']->meaning }}".
                    </p>
                </div>
            </div>
        @endif

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-lg text-gray-800 dark:text-gray-100 font-bold py-4">
                Is {{ $data['nameDetails']->name }} typically a male or female name?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-gray-600 dark:text-gray-300">
                    Typically, {{ $data['nameDetails']->name }} is associated with the {{ $data['nameDetails']->gender->name }} gender. This traditional identification may vary based on cultural and regional influences.
                </p>
            </div>
        </div>

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-lg text-gray-800 dark:text-gray-100 font-bold py-4">
                What are the key numerology insights for {{ $data['nameDetails']->name }}?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-gray-600 dark:text-gray-300">
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