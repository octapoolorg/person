<!-- Footer -->
<footer class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300">
    <section class="container mx-auto px-5 py-10">
        <!-- Social Media Links -->
        <div class="flex flex-wrap justify-between items-center border-b-2 dark:border-slate-700 pb-8 mb-10">
            <div class="lg:w-1/3 mb-6 lg:mb-0">
                <span class="text-sm dark:text-slate-300">Connect with us for name updates and facts:</span>
            </div>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/identeez/" target="_blank">
                    <svg class="fill-blue-800 dark:fill-slate-300 hover:fill-blue-900 dark:hover:fill-slate-500 h-5 w-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                </a>
                <a href="https://pinterest.com/identeez" target="_blank">
                    <svg class="fill-red-700 dark:fill-slate-300 hover:fill-red-800 dark:hover:fill-slate-500 h-5 w-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg>
                </a>
            </div>
        </div>

        <!-- Footer Links and Info -->
        <div class="flex flex-wrap mb-10">
            <!-- About Section -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3 dark:text-slate-300">
                    <img src="{!! asset('static/images/logo.png') !!}" alt="iDenteez Logo" class="w-10 h-10 inline-block">
                    About iDenteez
                </h6>
                <p class="text-sm dark:text-slate-300 pe-5">
                    iDenteez provides deep insights into names, their origins, meanings, and more. Discover the story behind your name.
                </p>
            </div>

            <!-- Popular Names -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3 dark:text-slate-300">Popular Names</h6>
                <ul class="space-y-2">
                    @foreach($popularNames as $name)
                        <li><a href="{!! route('names.show', $name->slug) !!}" class="text-sm hover:text-slate-900 dark:hover:text-slate-100">{{ $name->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Name Categories -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3 text-slate-900 dark:text-slate-100">Pages</h6>
                <ul class="space-y-2">
                    <li><a href="{!! route('home') !!}" class="text-sm hover:text-slate-900 dark:text-slate-100 dark:hover:text-slate-300">Home</a></li>
                    <li><a href="{!! route('names.index') !!}" class="text-sm hover:text-slate-900 dark:text-slate-100 dark:hover:text-slate-300">Names</a></li>
                    <li><a href="/pages/privacy-policy" class="text-sm hover:text-slate-900 dark:text-slate-100 dark:hover:text-slate-300">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3 text-slate-900 dark:text-slate-100">Reach Us</h6>
                <ul class="space-y-2">
                    <li><a href="mailto:info@identeez.com" class="text-sm hover:text-slate-900 dark:text-slate-100 dark:hover:text-slate-300">Email: info@iDenteez.com</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center py-4 bg-slate-100 dark:bg-slate-800">
        © {{ date('Y') }} Copyright:
        <a class="text-slate-700 dark:text-slate-100 font-bold hover:text-slate-900 dark:hover:text-slate-300" href="{!! route('home') !!}">iDenteez.com</a>
    </div>
</footer>
