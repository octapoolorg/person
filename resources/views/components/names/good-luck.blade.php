<section class="border dark:border-base-700 py-8 px-4 md:px-8 my-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800" id="good-luck">
    <div class="flex flex-row justify-between items-center relative">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 pe-5 mb-4 md:mb-10 font-semibold">
            {!! $name->name !!} Name Zodiac Details
        </h2>
        <span class="group absolute top-0 right-2" title="Based on Destiny Number.">
            <i class="cursor-pointer fas fa-info-circle text-primary-500 dark:text-primary-300 text-2xl group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300"></i>
        </span>
    </div>

    <x-names.box title="Zodiac Sign"
        description="{!! __('zodiac.' . strtolower($name->numerology['zodiac']['sign']) . '.zodiac_sign', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/signs/' . strtolower($name->numerology['zodiac']['sign']) . '.png') !!}"
        caption="{!! $name->numerology['zodiac']['sign'] !!}" />

    <hr class="dark:border-base-700">

    <x-names.box title="Auspicious Stones"
        description="{!! __('zodiac.' . strtolower($name->numerology['zodiac']['sign']) . '.auspicious_stones', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/stones/' . strtolower($name->numerology['zodiac']['attributes']['stone']) . '.png') !!}"
        caption="{!! $name->numerology['zodiac']['attributes']['stone'] !!}" />

    <hr class="dark:border-base-700">

    <x-names.box title="Auspicious Colors"
        description="{!! __('zodiac.' . strtolower($name->numerology['zodiac']['sign']) . '.auspicious_colors', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/colors/' . str($name->numerology['zodiac']['attributes']['color'])->slug() . '.png') !!}"
        caption="{!! $name->numerology['zodiac']['attributes']['color'] !!}" />
</section>