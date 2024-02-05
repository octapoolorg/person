<section x-data="{ show: !localStorage.getItem('hasRated') }" x-cloak>
    <div class="max-w-7xl mx-auto bg-surface shadow rounded-lg p-6 dark:bg-base-800 mb-12" x-show="show">
        <!-- Rate review -->
        <div class="text-center" id="rate">
            <h3 class="text-base-800 dark:text-surface text-xl font-medium mb-2">
                {!! __('content.translator.rate.title') !!}
            </h3>

            <p class="text-base-600 dark:text-base-400 text-xs mb-2">
                {!! __('content.translator.rate.description') !!}
            </p>

            <!-- Rating -->
            <section x-data="{ rate: rate }">
                @csrf
                <div class="mt-2 flex justify-center items-center">
                    <form>
                        <input type="radio" id="rating1" name="rating" value="1" class="hidden">
                        <label for="rating1"
                            @click="Form.rate(1)"
                            class="w-10 h-10 inline-flex justify-center items-center text-2xl rounded-full hover:bg-base-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-base-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600 cursor-pointer">
                            😔
                        </label>
                    </form>

                    <form>
                        <input type="radio" id="rating2" name="rating" value="2" class="hidden">
                        <label for="rating2"
                            @click="Form.rate(2)"
                            class="w-10 h-10 inline-flex justify-center items-center text-2xl rounded-full hover:bg-base-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-base-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600 cursor-pointer">
                            😐️
                        </label>
                    </form>

                    <form>
                        <input type="radio" id="rating3" name="rating" value="3" class="hidden">
                        <label for="rating3"
                            @click="Form.rate(3)"
                            class="w-10 h-10 inline-flex justify-center items-center text-2xl rounded-full hover:bg-base-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-base-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-base-600 cursor-pointer">
                            🤩
                        </label>
                    </form>
                </div>
            </section>
            <!-- End Rating -->
        </div>
        <!-- End Rate review -->
    </div>
</section>