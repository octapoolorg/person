<a id="copy" href="javascript:void(0)" class="text-surface share py-2 px-4 bg-primary-600 hover:bg-primary-700 text-center" title="{!! __('content.translator.tool.target.copy') !!} " x-data={} @click.prevent="TranslatorWidget.copy()">
    <i class="fas fa-copy text-lg"></i>
</a>
<a id="speak" href="javascript:void(0)" class="text-surface share py-2 px-4 bg-teal-500 hover:bg-teal-600 hidden text-center" x-data={} @click.prevent="SpeechManager.speak()">
    <i class="fa-solid fa-volume-up text-lg"></i>
</a>
<a id="whatsapp" href="https://api.whatsapp.com/send?text=" target="_blank" class="text-surface share bg-[#25D366] py-2 px-4 hover:bg-[#20b155] text-center" title="{!! __('content.translator.tool.target.whatsapp') !!} ">
    <i class="fab fa-whatsapp text-lg"></i>
</a>
<a id="telegram" href="https://t.me/share/url?url=" target="_blank" class="hidden text-surface share bg-[#0088cc] py-2 px-4 hover:bg-[#1d698f] text-center" title="{!! __('content.translator.tool.target.telegram') !!} ">
    <i class="fab fa-telegram text-lg"></i>
</a>
<a id="download" href="javascript:void(0)" class="text-surface share bg-sky-700 py-2 px-4 hover:bg-sky-800 text-center" title="{!! __('content.translator.tool.target.download') !!} " x-data={} @click.prevent="TranslatorWidget.download()">
    <i class="fas fa-download text-lg"></i>
</a>