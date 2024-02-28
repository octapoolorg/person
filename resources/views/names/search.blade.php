@extends('layouts.main')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-surface dark:bg-base-800 p-8 rounded-lg shadow-lg dark:text-base-100">
            @if(! request()->anyFilled(['q', 'origin','gender']))
                <h2 class="text-3xl font-bold leading-tight text-base-900 dark:text-base-200">Find Your Perfect Name</h2>
                <p class="mt-4 text-lg text-base-600 dark:text-base-300 mb-12">Start your search by typing a name, selecting an origin, or gender.</p>
            @endisset
            <form action="{{ route('names.search') }}" method="GET" class="">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <i class="fas fa-search text-base-400 text-lg" aria-hidden="true"></i>
                            </div>
                            <input type="search" name="q" id="search" class="w-full pl-14 pr-4 py-2 bg-base-50 dark:bg-base-700 dark:placeholder:text-base-300 border border-base-300 dark:border-base-500 dark:focus:border-primary-500 text-base-700 dark:text-base-300 rounded-lg transition duration-300 ease-in-out focus:bg-surface focus:border-primary-500 focus:ring-0" placeholder="Search here ..."
                            value="{{ request()->query('q') }}">
                        </div>
                    </div>
                    <div class="lg:col-span-4">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 bg-primary-500 dark:bg-primary-600 text-surface font-medium rounded-lg shadow hover:shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-4 focus:ring-primary-300 focus:ring-opacity-50">
                            Search
                        </button>
                    </div>
                </div>
                <div class="mt-8 grid sm:grid-cols-2 grid-cols-1 gap-6">
                    <x-names.search-filters />
                </div>
            </form>

            <div class="mt-16">
                <h2 class="text-2xl font-semibold leading-tight text-base-900 dark:text-base-300">
                    Search Results
                </h2>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($names as $name)
                        <a href="{{ route('names.show', $name) }}" class="bg-surface hover:bg-primary-50/70 dark:bg-base-700 rounded-lg shadow hover:shadow-md p-6 relative">
                            <h3 class="text-xl font-semibold text-base-900 dark:text-base-100">{{ $name->name }}</h3>
                            <div class="absolute top-5 right-5">
                                @if($name->isMasculine())
                                <i class="fas fa-mars text-blue-500 text-xl" title="Male"></i>
                                @elseif($name->isFeminine())
                                <i class="fas fa-venus text-pink-500 text-xl" title="Female"></i>
                                @else
                                <i class="fas fa-genderless text-gray-400 text-xl" title="{!! $name->gender !!}"></i>
                                @endif
                            </div>
                            <p class="mt-2 text-base text-base-600 dark:text-base-300 truncate">{{ $name->meaning }}</p>
                            <span class="mt-4 block text-primary-600 dark:text-primary-300 hover:text-primary-700 dark:hover:text-primary-400 transition duration-200 ease-in-out">Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <span class="text-lg text-base-500">No names found. Try a different search.</span>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {!! $names->links() !!}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

