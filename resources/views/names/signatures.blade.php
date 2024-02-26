@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 mb-4 lg:mb-0 bg-surface dark:bg-base-800 rounded-lg shadow-md overflow-hidden p-4 md:p-8">

                <div class="">
                    <h1 class="text-lg font-semibold text-base-800 dark:text-surface mb-4">{!! $meta->title !!}</h1>
                    <p class="text-lg text-base-500 dark:text-base-400">
                        {!! $meta->description !!}
                    </p>
                </div>

                @foreach ($signatures as $signature)
                    <div class="border border-base-200 dark:border-base-700 rounded-lg overflow-hidden shadow-sm transition-transform duration-300 cursor-pointer my-5">
                        <img
                            class="inline-block rounded-lg w-full h-52 object-cover transition-opacity duration-300 lazy hover:opacity-80 dark:opacity-80 dark:hover:opacity-90"
                            src="{!! $signature !!}"
                            alt="{{ $name->name }} Signature"
                        >
                    </div>
                @endforeach
            </main>

            <aside class="w-full lg:w-1/3 md:px-4 space-y-8">

            </aside>
        </section>
    </section>
@endsection
