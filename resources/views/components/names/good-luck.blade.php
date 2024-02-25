<section class="border dark:border-base-700 py-8 px-4 md:px-8 my-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800" id="good-luck">
    <div class="flex flex-row justify-between items-center relative">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold relative">
            {!! $name->name !!} Name Zodiac Details
        </h2>
        <span class="group relative md:absolute top-0 right-0 mb-2 mr-2 flex items-center">
            <i class="cursor-pointer fas fa-info-circle text-primary-500 dark:text-primary-300 text-2xl group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300"></i>

            <!-- Tooltip Text -->
            <span
                class="absolute bottom-full mb-2 right-0 bg-black dark:bg-black text-surface dark:text-base-100 text-xs rounded py-1 px-3 w-28 hidden group-hover:block">
                Based on Destiny Number.
            </span>
        </span>
    </div>

    <x-names.box title="Zodiac Sign"
        description="{!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.zodiac_sign', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/signs/' . strtolower($data['numerology']['zodiac']['sign']) . '.png') !!}"
        caption="{!! $data['numerology']['zodiac']['sign'] !!}" />

    <hr class="dark:border-base-700">

    <x-names.box title="Auspicious Stones"
        description="{!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_stones', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/stones/' . strtolower($data['numerology']['zodiac']['attributes']['stone']) . '.png') !!}"
        caption="{!! $data['numerology']['zodiac']['attributes']['stone'] !!}" />

    <hr class="dark:border-base-700">

    <x-names.box title="Auspicious Colors"
        description="{!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_colors', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/colors/' . str($data['numerology']['zodiac']['attributes']['color'])->slug() . '.png') !!}"
        caption="{!! $data['numerology']['zodiac']['attributes']['color'] !!}" />
</section>