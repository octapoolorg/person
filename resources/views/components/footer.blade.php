<footer class="bg-base-900 w-full">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 break-all">
            <div class="col-span-full lg:col-span-2">
                <a class="flex items-center text-xl font-semibold text-surface dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                    href="{!! localized_route('home') !!}" aria-label="Brand">
                    <x-logo class="w-10 h-10 ltr:mr-2 rtl:ml-2" />
                    <span>
                        {!! __('content.brand') !!}
                    </span>
                </a>
                <p class="mt-3 text-base-400">
                    {!! __('content.footer.description') !!}
                </p>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.services') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="{!! localized_route('translator') !!}">{!! __('content.link.translate') !!}
                        </a>
                    </p>
                    {{-- <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600" href="#">{!! __('content.link.dictionary') !!}</a></p> --}}
                    {{-- <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600" href="#">{!! __('content.link.phrasebook') !!}</a></p> --}}
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.legal') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/privacy-policy"> {!! __('content.link.privacy') !!}</a></p>
                    <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/terms-of-service"> {!! __('content.link.terms') !!}</a></p>
                    <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/disclaimer"> {!! __('content.link.disclaimer') !!}</a></p>
                    <p><a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/cookies-policy"> {!! __('content.link.cookies') !!}</a></p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.pages') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="{!! localized_route('home') !!}"> {!! __('content.link.home') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/page/faqs"> {!! __('content.link.faqs') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/about-us"> {!! __('content.link.about') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/page/contact-us"> {!! __('content.link.contact') !!}
                        </a>
                    </p>
                </div>
            </div>
            <!-- End Col -->

        </div>
        <!-- End Grid -->

        <div class="flex flex-col lg:flex-row lg:justify-between items-center mt-5 sm:mt-12">

            <p class="text-sm text-base-400">© {!! date('Y') !!} {!! __('content.brand') !!}.
                {!! __('content.footer.rights') !!}
            </p>

            <!-- Social Brands -->
            <div>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-surface hover:bg-surface/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-base-600"
                    href="https://www.facebook.com/langlix" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-surface hover:bg-surface/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-base-600"
                    href="https://www.x.com/langlix" target="_blank">
                    <i class="fab fa-x-twitter"></i>
                </a>
            </div>

            {{-- <button id="switch-language-link" data-dropdown-toggle="dropdown-switch-language"
                class="flex items-center justify-between w-full py-2 px-3 mt-4 lg:mt-0 lg:w-auto lg:ml-4 text-sm font-semibold text-base-400 hover:text-base-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600">
                <i class="fas fa-globe text-base-400 mr-2"></i>
                <span class="text-sm font-semibold">
                    Language
                </span>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown-switch-language"
                class="z-10 hidden font-normal bg-surface divide-y divide-base-100 shadow w-44 dark:bg-base-700 dark:divide-base-600">
                <ul class="py-2 text-sm text-base-700 dark:text-base-200" aria-labelledby="dropdownLargeButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-base-100 dark:hover:bg-base-600 dark:hover:text-surface">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div> --}}

        <!-- Scroll to top -->
        <div class="fixed bottom-4 right-4 z-50">
            <a href="#top"
                class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-800 hover:bg-primary-700 dark:bg-base-700 dark:hover:bg-base-600 focus:outline-none focus:ring-1 focus:ring-base-600">
                <i class="fas fa-chevron-up text-surface"></i>
            </a>
        </div>
</footer>