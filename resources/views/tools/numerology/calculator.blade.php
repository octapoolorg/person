@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row gap-4 mb-12 mt-8 md:mt-10">
            <main role="main" class="w-full px-4 mb-4 lg:mb-0 lg:p-12 bg-surface dark:bg-base-800 dark:text-base-300 shadow rounded-lg">

                @isset($data)
                    <section class="py-10" id="insights">
                        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
                            <h2 class="text-4xl font-bold text-center mb-12">
                                Numerology Analysis for {{ $data['name'] }}
                            </h2>

                            <div class="space-y-12">
                                <!-- Life Path Number Section -->
                                <x-tools.numerology.analysis :data="$data" type="life_path" />

                                <!-- Soul Urge Number Section -->
                                <x-tools.numerology.analysis :data="$data" type="soul_urge" />

                                <!-- Personality Number Section -->
                                <x-tools.numerology.analysis :data="$data" type="personality"/>
                        </div>
                    </section>
                @endisset

                <div class="container mx-auto p-6 mb-5">
                    <header class="w-full mx-auto mb-10">
                        <h1 class="text-center text-3xl lg:text-5xl font-semibold mb-6">Discover Your Numerology</h1>
                        <p class="text-center text-lg text-balance">
                            Explore the mystical numbers that shape your life's path. Use our intuitive calculator to unlock
                            your unique numerological insights based on your name and birth date.
                        </p>
                    </header>

                    <section class="mx-auto max-w-2xl">
                        @if ($errors->any())
                            <div class="bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded relative mb-6"
                                role="alert">
                                <span class="block sm:inline">{{ $errors->first() }}</span>
                            </div>
                        @endif

                        <form action="{{ route('tools.numerology.calculator') }}" method="POST" class="space-y-10">
                            @csrf
                            <fieldset class="space-y-8">
                                <div class="flex flex-col mb-8">
                                    <label for="name" class="text-xl font-medium mb-3">
                                        Full Name:
                                    </label>
                                    <input type="text" name="name" id="name"
                                        class="form-input block w-full rounded-lg border-2 border-base-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-300 transition ease-in-out duration-300 px-4 py-3 placeholder:text-base-500"
                                        placeholder="e.g., Jane Doe" required aria-label="Full name"
                                        value="{!! old('name') ?? ($data['name'] ?? '') !!}">
                                </div>

                                <div class="flex flex-col mb-8">
                                    <label for="dob" class="text-xl font-medium mb-3">
                                        Date of Birth:
                                    </label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-input block w-full rounded-lg border-2 border-base-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-300 transition ease-in-out duration-300 px-4 py-3 placeholder:text-base-500 text-base-500"
                                        required aria-label="Date of birth" value="{!! old('dob') ?? ($data['dob'] ?? '') !!}">
                                </div>
                            </fieldset>

                            <button type="submit"
                                class="block w-full bg-primary-600 hover:bg-primary-700 text-surface text-xl font-bold py-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out shadow-md">Get
                                Insights</button>
                        </form>
                    </section>
                </div>


            </main>
        </section>
    </section>
@endsection
