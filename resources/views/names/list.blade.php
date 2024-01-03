@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
            <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
                <div id="search-results" class="space-y-4">
                    @forelse ($names as $name)
                        <a href="{!! route('names.show', $name) !!}" class="p-4 shadow rounded-lg flex justify-start items-center hover:bg-slate-50 transition duration-300 ease-in-out">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold text-indigo-800 capitalize">{{ $name->name }}</h2>
                                <p class="text-md text-slate-500">{{ $name->meaning }}</p>
                            </div>
                            <span class="text-indigo-600 hover:text-indigo-900 transition duration-300 ease-in-out">Learn more</span>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <span class="text-lg text-slate-400">No names found. Try a different search.</span>
                        </div>
                    @endforelse
                </div>
            </main>

            @include('partials.names._sidebar')
        </section>
    </section>
@endsection