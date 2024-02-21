<!-- FAQ Section -->
<section class="px-6 py-10 mb-10 rounded-lg shadow dark:shadow-none border dark:border-base-700 bg-surface dark:bg-base-800"
itemscope itemtype="https://schema.org/FAQPage">
    <h2 class="text-2xl md:text-3xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold capitalize">
        Frequently Asked Questions about
        <span class="text-2xl leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
            ({!! $name->name !!})
        </span>
    </h2>

    <div class="mx-auto space-y-6 divide-y divide-base-200 dark:divide-base-700">

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-xl text-base-800 dark:text-base-100 font-semibold py-4">
                What is the meaning of {!! $name->name !!}?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    The meaning of {!! $name->name !!} is {!! $name->mainMeaning !!}.
                </p>
            </div>
        </div>

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-xl text-base-800 dark:text-base-100 font-semibold py-4">
                What is the gender association of {!! $name->name !!}?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    Typically, {!! $name->name !!} is associated with the {!! $name->gender->name !!} gender. This traditional identification may vary based on cultural and regional influences.
                </p>
            </div>
        </div>

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 itemprop="name" class="text-xl text-base-800 dark:text-base-100 font-semibold py-4">
                What are the key numerology insights for {!! $name->name !!}?
            </h3>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text" class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
                    In numerology, {!! $name->name !!} has a destiny number of {!! $data['numerology']['numbers']['destiny'] !!},
                    reflecting {!! trans('numerology.traits.destiny.' . $data['numerology']['numbers']['destiny']) !!}.
                    The soul urge number is {!! $data['numerology']['numbers']['soul_urge'] !!},
                    indicating {!! trans('numerology.traits.soul_urge.' . $data['numerology']['numbers']['soul_urge']) !!},
                    and the personality number is {!! $data['numerology']['numbers']['personality'] !!},
                    suggesting {!! trans('numerology.traits.personality.' . $data['numerology']['numbers']['personality']) !!}.
                </p>
            </div>
        </div>
    </div>
</section>