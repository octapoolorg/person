<span class="flex items-center gap-1">
    <a id="increase" href="javascript:void(0)" class="text-base-600 hover:text-base-800 py-2 px-4 bg-base-100 hover:bg-base-200 rounded-bl dark:bg-base-700 dark:hover:bg-base-600 dark:text-base-300 select-none" x-data={} @click.prevent="TranslatorWidget.increaseFontSize()" title="{!! __('content.translator.tool.source.increase') !!} ">
        <i class="fas fa-font text-lg"></i> +
    </a>
    <a id="decrease" href="javascript:void(0)" class="text-base-600 hover:text-base-800 py-2 px-4 bg-base-100 hover:bg-base-200 rounded-br lg:rounded-none dark:bg-base-700 dark:hover:bg-base-600 dark:text-base-300 select-none" x-data={} @click.prevent="TranslatorWidget.decreaseFontSize()" title="{!! __('content.translator.tool.source.decrease') !!} ">
        <i class="fas fa-font text-lg"></i> -
    </a>
</span>
<span class="flex items-center gap-1">
    <span id="sourceTextCount" class="text-base-600 dark:text-base-300 select-none px-4 py-2 bg-base-100 dark:bg-base-700 rounded-bl rounded-br">
        <span id="sourceTextCountValue">0</span> / 1000
    </span>
</span>