@props(['label', 'id', 'languages', 'select'])

<label for="{!! $id !!}" class="block text-sm font-medium mb-2 text-base-700 dark:text-base-300">
    {!! $label !!}
</label>
<select id="{!! $id !!}"
    class="w-full px-4 py-2 rounded-md text-base-800 dark:text-base-300 border border-base-300 dark:border-base-600 bg-surface dark:bg-base-800 outline-none focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-800 focus:border-transparent"
    x-data={}
    x-on:change="TranslatorWidget.update()">
    @foreach ($languages as $language)
        <option value="{!! $language->rootLanguage->code !!}"
                data-route="{!! $language->slug !!}"
                data-dir="{!! $language->rootLanguage->dir !!}"
                data-script="{!! $language->rootLanguage->script !!}"
                @selected($language->id == $select->id)
                class="checked:bg-primary-600 checked:text-surface dark:checked:bg-primary-500 dark:checked:text-surface"
        >
            {!! $language->name !!}
        </option>
    @endforeach
</select>