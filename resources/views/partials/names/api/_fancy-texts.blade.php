@foreach ($fancyTexts as $fancyText)
    <li tabindex="0"
        class="text-lg p-4 hover:bg-slate-100 dark:hover:bg-slate-700 focus:bg-slate-100 dark:focus:bg-slate-700 transition ease-in-out duration-150 cursor-pointer copy-to-clipboard text-slate-900 dark:text-slate-100"
        aria-label="Select {{ $fancyText }} style">
        {{ $fancyText }}
    </li>
@endforeach