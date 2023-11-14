@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <div class="container mx-auto bg-gradient-to-br from-purple-600 to-blue-400 p-6 rounded-lg shadow-xl">
                <h1 class="text-4xl font-extrabold mb-10 text-white text-center lg:text-left">Unlock Your Numerology Insights</h1>
                <p class="text-lg text-white mb-8">
                    Unveil the secrets of your personality and destiny through the ancient art of numerology. Our calculator provides a deep dive into your Life Path, Destiny Number, and more, using the mystical wisdom of numbers derived from your name and date of birth.
                </p>

                <div class="bg-white rounded-lg shadow-2xl p-10">
                    <form action="{{ route('tools.numerology.calculate.post') }}" method="POST" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-lg font-medium mb-2">Enter Your Full Name:</label>
                                <input type="text" name="name" id="name" class="form-input block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="e.g., Jane Doe" required>
                            </div>

                            <div>
                                <label for="dob" class="block text-lg font-medium mb-2">Your Date of Birth:</label>
                                <input type="date" name="dob" id="dob" class="form-input block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 ease-in-out">Get Your Reading</button>
                    </form>
                </div>
            </div>
        </main>

        @include('partials.tools.numerology._sidebar')
    </section>

    @isset($data)
        <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-4xl font-extrabold text-center text-blue-600 mb-10">In-Depth Numerology Insights</h2>

            <div class="space-y-8 md:space-y-0 md:grid md:grid-cols-3 md:gap-8">
                <!-- Numerology Number -->
                <div class="bg-white rounded-xl shadow-xl p-8 border-t-4 border-blue-400">
                    <h3 class="text-2xl font-semibold mb-5">Life Path Number ({{ 1 }})</h3>
                    <p class="text-md text-gray-600">
                        Your Life Path Number, {{ 1 }}, is a powerful indicator of your life's purpose and journey. It sheds light on the path you're destined to walk, revealing unique talents, challenges, and opportunities. As number {{ 1 }}, you possess...
                        <!-- Add more specific insights based on the calculated number -->
                    </p>
                </div>

                <!-- Soul Urge Number -->
                <div class="bg-white rounded-xl shadow-xl p-8 border-t-4 border-purple-400">
                    <h3 class="text-2xl font-semibold mb-5">Soul Urge Number ({{ 2 }})</h3>
                    <p class="text-md text-gray-600">
                        The Soul Urge Number, also known as the Heart's Desire, speaks to what you truly value and desire at your core. Number {{ 2 }} suggests a deep connection to...
                        <!-- Detailed interpretation for the Soul Urge Number -->
                    </p>
                </div>

                <!-- Personality Number -->
                <div class="bg-white rounded-xl shadow-xl p-8 border-t-4 border-green-400">
                    <h3 class="text-2xl font-semibold mb-5">Personality Number (3)</h3>
                    <p class="text-md text-gray-600">
                        Your Personality Number, {{ 3 }}, reveals the external you—the face you show to the world. It highlights how others perceive you and the impression you make. As a {{ 3 }}, you are likely seen as...
                        <!-- More insights about the Personality Number -->
                    </p>
                </div>
            </div>
        </div>
    </section>
    @endisset
@endsection
