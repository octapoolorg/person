@extends('layouts.main')

@section('content')
    <section>
        <!-- Hero Section -->
        <div class="bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <h2 class="text-3xl leading-9 font-bold text-gray-800">
                        Welcome to Our Website
                    </h2>
                    <p class="mt-4 text-lg leading-7 text-gray-500">
                        The one-stop solution for your needs.
                    </p>
                    <a href="#" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out md:w-auto">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-12 bg-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <p class="text-base leading-6 text-green-600 font-semibold tracking-wide uppercase">Features</p>
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        A better way to send money
                    </h3>
                    <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
                        Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in, accusamus quisquam.
                    </p>
                </div>

                <div class="mt-10">
                    <ul class="md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <li>
                            <div class="flex">
                                <!-- Feature 1 -->
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                        <!-- Icon -->
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900">Competitive exchange rates</h4>
                                    <p class="mt-2 text-base leading-6 text-gray-500">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <!-- Repeat Feature Blocks as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
