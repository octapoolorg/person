@foreach ($fancyTexts as $fancyText)
    <li tabindex="0"
        class="text-lg p-4 hover:bg-gray-100 focus:bg-gray-100 transition ease-in-out duration-150 cursor-pointer"
        aria-label="Select {{ $fancyText }} style">
        {{ $fancyText }}
    </li>
@endforeach
