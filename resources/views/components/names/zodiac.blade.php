<section class="border dark:border-base-700 my-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800">
    <x-names.box title="Zodiac Sign"
        description="{!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.zodiac_sign', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/signs/' . strtolower($data['numerology']['zodiac']['sign']) . '.png') !!}"
        caption="{!! $data['numerology']['zodiac']['sign'] !!}" />

    <hr class="dark:border-base-700">

    <x-names.box title="Auspicious Stones"
        description="{!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_stones', ['name' => $name->name]) !!}"
        image="{!! asset('static/images/zodiac/stones/' . strtolower($data['numerology']['zodiac']['attributes']['stone']) . '.png') !!}"
        caption="{!! $data['numerology']['zodiac']['attributes']['stone'] !!}" />
</section>