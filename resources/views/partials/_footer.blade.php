<!-- Footer -->
<footer class="bg-white text-gray-700">
    <section class="container mx-auto px-5 py-10">
        <!-- Social Media Links -->
        <div class="flex flex-wrap justify-between items-center border-b-2 pb-8 mb-10">
            <div class="lg:w-1/3 mb-6 lg:mb-0">
                <span class="text-sm">Connect with us for name updates and facts:</span>
            </div>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/identeez/" target="_blank" class="text-gray-700 hover:text-gray-900">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://pinterest.com/identeez" target="_blank" class="text-gray-700 hover:text-gray-900">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>

        <!-- Footer Links and Info -->
        <div class="flex flex-wrap mb-10">
            <!-- About Section -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3">
                    <i class="fas fa-info-circle mr-2"></i>
                    About iDenteez
                </h6>
                <p class="text-sm">
                    iDenteez provides deep insights into names, their origins, meanings, and more. Discover the story behind your name.
                </p>
            </div>

            <!-- Popular Names -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3">Popular Names</h6>
                <ul class="space-y-2">
                    @foreach($popularNames as $name)
                            <li><a href="{!! route('names.show', $name->slug) !!}" class="text-sm hover:text-gray-900">{{ $name->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Name Categories -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3">Pages</h6>
                <ul class="space-y-2">
                    <li><a href="{!! route('home') !!}" class="text-sm hover:text-gray-900">Home</a></li>
                    <li><a href="{!! route('names.index') !!}" class="text-sm hover:text-gray-900">Names</a></li>
                    <li><a href="https://identeez.com/pages/privacy-policy" class="text-sm hover:text-gray-900">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="lg:w-1/4 mb-6 lg:mb-0">
                <h6 class="text-lg font-semibold mb-3">Reach Us</h6>
                <ul class="space-y-2">
                    <li><a href="mailto:info@identeez.com" class="text-sm hover:text-gray-900">Email: info@iDenteez.com</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center py-4 bg-gray-100">
        © {{ date('Y') }} Copyright:
        <a class="text-gray-700 font-bold hover:text-gray-900" href="{!! route('home') !!}">iDenteez.com</a>
    </div>
</footer>
