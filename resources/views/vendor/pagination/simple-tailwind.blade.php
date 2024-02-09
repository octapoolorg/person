@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-base-500 bg-surface border border-base-300 cursor-default leading-5 rounded-md dark:text-base-600 dark:bg-base-800 dark:border-base-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-base-700 bg-surface border border-base-300 leading-5 rounded-md hover:text-base-500 focus:outline-none focus:ring ring-base-300 focus:border-blue-300 active:bg-base-100 active:text-base-700 transition ease-in-out duration-150 dark:bg-base-800 dark:border-base-600 dark:text-base-300 dark:focus:border-blue-700 dark:active:bg-base-700 dark:active:text-base-300">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-base-700 bg-surface border border-base-300 leading-5 rounded-md hover:text-base-500 focus:outline-none focus:ring ring-base-300 focus:border-blue-300 active:bg-base-100 active:text-base-700 transition ease-in-out duration-150 dark:bg-base-800 dark:border-base-600 dark:text-base-300 dark:focus:border-blue-700 dark:active:bg-base-700 dark:active:text-base-300">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-base-500 bg-surface border border-base-300 cursor-default leading-5 rounded-md dark:text-base-600 dark:bg-base-800 dark:border-base-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
