@foreach ($fancyTexts as $fancyText)
    <li tabindex="0"
        class="text-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 transition ease-in-out duration-150 cursor-pointer copy-to-clipboard text-gray-900 dark:text-gray-100"
        aria-label="Select {{ $fancyText }} style">
        {{ $fancyText }}
    </li>
@endforeach