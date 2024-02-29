@foreach ($fancyTexts as $fancyText)
<li @click.prevent="Utility.copyTextToClipboard($event.target.innerText,$event)"
    class="text-lg p-4 hover:bg-base-100 dark:hover:bg-base-700 transition ease-in-out duration-150 cursor-pointer copy-to-clipboard text-base-900 dark:text-base-100 whitespace-nowrap select-all"
    aria-label="Select {!! $fancyText !!} style">
    {!! $fancyText !!}
</li>
@endforeach