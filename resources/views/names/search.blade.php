@extends('layouts.main')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-xl">
            <h2 class="text-2xl font-semibold leading-tight text-gray-900">Explore Names</h2>
            <p class="mt-2 text-md text-gray-600">Use the search filters below to refine your name search based on alphabet, origin, or gender.</p>
            <form action="{{ route('names.search') }}" method="GET" class="mt-10">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-6 gap-y-4">
                    <div class="lg:col-span-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="search" name="q" id="search" class="w-full pl-10 pr-4 py-3 border border-gray-300 bg-white text-gray-700 rounded-2xl shadow focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200 ease-in-out" placeholder="Type to search..." value="{{ request()->query('q') }}">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent shadow text-md font-medium rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                            Search
                        </button>
                    </div>
                </div>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label for="alphabet" class="block text-sm font-medium text-gray-700">Alphabet</label>
                        <select id="alphabet" name="alphabet" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                            <option value="">Select Alphabet</option>
                            @foreach(range('A', 'Z') as $char)
                                <option value="{{ $char }}" {{ request()->query('alphabet') == $char ? 'selected' : '' }}>{{ $char }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700">Origin</label>
                        <select id="origin" name="origin" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                            <option value="">Select Origin</option>
                            @foreach($origins as $origin)
                                <option value="{{ $origin->slug }}" {{ request()->query('origin') == $origin->slug ? 'selected' : '' }}>{{ $origin->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                            <option value="">Select Gender</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender->slug }}" {{ request()->query('gender') == $gender->slug ? 'selected' : '' }}>{{ $gender->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="mt-16">
                <h2 class="text-2xl font-semibold leading-tight text-gray-900">Search Results</h2>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($names as $name)
                        <a href="{{ route('names.show', $name) }}" class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $name->name }}</h3>
                            <p class="mt-2 text-base text-gray-600 truncate">{{ $name->meaning }}</p>
                            <span class="mt-4 block text-indigo-600 hover:text-indigo-700 transition duration-200 ease-in-out">Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <span class="text-lg text-gray-500">No names found. Try a different search.</span>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {!! $names->onEachSide(1)->links() !!}
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
