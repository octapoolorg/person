@props(['class' => ''])
<!-- Translate Button -->
<div class="text-center {!! $class !!}">
    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-surface font-bold py-3 px-6 rounded-full transition duration-300 select-none submit-button dark:bg-primary-500 dark:hover:bg-primary-600">
        {!! __('content.translator.tool.translate') !!}
        <i id="icon" class="fas fa-language ml-2"></i>
    </button>
</div>
