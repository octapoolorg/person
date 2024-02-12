<footer class="bg-base-900 w-full">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 break-all">
            <div class="col-span-full lg:col-span-2">
                <a class="flex items-center text-xl font-semibold text-surface dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                    href="{!! route('home') !!}" aria-label="Brand">
                    <img
                        class="w-10 h-10 lazy" src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cline%20x1%3D%220%22%20y1%3D%220%22%20x2%3D%22100%25%22%20y2%3D%220%22%20style%3D%22stroke%3Aaaaaaa%3Bstroke-width%3A1%22/%3E%0A%3C/svg%3E"
                        data-src="{!! asset('/static/images/logo.png') !!}"
                        alt="{{ config('app.name') }} Logo"
                    >
                    <span>
                        {{ config('app.name') }}
                    </span>
                </a>
                <p class="mt-3 text-base-400">
                    {!! __('content.footer.description') !!}
                </p>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.popular-names') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    @foreach ($popularNames as $name)
                        <p>
                            <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                                href="{!! route('names.show', $name->slug) !!}">
                                {{ $name->name }}
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.legal') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/privacy-policy">
                            {!! __('content.link.privacy') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/terms-of-service">
                            {!! __('content.link.terms') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/disclaimer">
                            {!! __('content.link.disclaimer') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/cookies-policy">
                            {!! __('content.link.cookies') !!}
                        </a>
                    </p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-base-100">
                    {!! __('content.heading.pages') !!}
                </h4>

                <div class="mt-3 grid space-y-3">
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="{!! route('home') !!}"> {!! __('content.link.home') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/page/faqs"> {!! __('content.link.faqs') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/pages/about-us"> {!! __('content.link.about') !!}
                        </a>
                    </p>
                    <p>
                        <a class="inline-flex gap-x-2 text-base-400 hover:text-primary-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600"
                            href="/page/contact-us"> {!! __('content.link.contact') !!}
                        </a>
                    </p>
                </div>
            </div>
            <!-- End Col -->

        </div>
        <!-- End Grid -->

        <div class="flex flex-col lg:flex-row lg:justify-between items-center mt-5 sm:mt-12">

            <p class="text-sm text-base-400">
                © {!! date('Y') !!} {{ config('app.name') }}. All rights reserved.
            </p>

            <!-- Social Brands -->
            <div>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-surface hover:bg-surface/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-base-600"
                    href="https://www.facebook.com/identeezofficial" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-surface hover:bg-surface/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-base-600"
                    href="https://pinterest.com/identeez" target="_blank">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>

            <!-- Scroll to top -->
            <div class="fixed bottom-4 right-4 z-50">
                <a href="#top"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-800 hover:bg-primary-700 dark:bg-base-700 dark:hover:bg-base-600 focus:outline-none focus:ring-1 focus:ring-base-600 transition duration-300 ease-in-out">
                    <i class="fas fa-chevron-up text-surface"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

@stack('scripts')
