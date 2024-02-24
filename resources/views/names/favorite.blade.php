@extends('layouts.main')
@section('content')
<section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
    <section class="flex flex-col lg:flex-row mb-12 mt-8 md:mt-20">
        <main class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
            <h1 class="text-3xl font-semibold text-primary-800 dark:text-primary-100">Favorite Names</h1>
            <p class="mt-2 text-base text-base-600 dark:text-base-300">Here are the names you've favorited.</p>

            <!-- Improved Shareable link section with better focus and accessibility -->
            <div class="mt-8">
                <div class="flex items-center justify-between bg-surface dark:bg-base-800 p-4 rounded-lg shadow-md">
                    <div class="flex items-center w-10/12">
                        <i class="fas fa-link text-2xl text-primary-600 dark:text-primary-500"></i>
                        <input type="text" id="shareable-link" class="w-full ml-4 bg-transparent border-none text-base text-base-600 dark:text-base-300 focus:outline-none"
                        value="{!! route('names.favorites', ['favorite'=> request()->cookie('uuid')]) !!}"
                        readonly>
                    </div>
                    <button class="bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150" id="copy-link">
                        Copy
                    </button>
                </div>
            </div>

            <div id="search-results" class="space-y-4 mt-6">
                @forelse ($names as $name)
                <div class="p-4 shadow dark:shadow-md rounded-lg flex justify-between items-center bg-surface dark:bg-base-800 transition duration-300 ease-in-out">
                    <a href="{{ route('names.show', $name) }}" class="flex-grow">
                        <h2 class="text-xl font-semibold text-primary-800 dark:text-primary-100 capitalize">
                            {{ $name->name }} ({{ $name->gender }})
                        </h2>
                        <p class="text-md text-base-500 dark:text-base-300 overflow-hidden text-ellipsis whitespace-nowrap">{{ $name->meaning }}</p>
                    </a>
                    <button class="w-10 h-10 flex justify-center items-center text-pink-600 dark:text-pink-500 hover:text-pink-700 dark:hover:text-pink-600 focus:outline-none favorite-button" data-slug="{{ $name->slug }}">
                        <i class="fa-heart text-2xl fas" id="favorite-icon"></i>
                    </button>
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-base leading-7 text-base-600 dark:text-base-300">
                        Oops! We looked everywhere but couldn't find what you were looking for.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('names.search') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Explore Names <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            @if($names->count())
            <div class="mt-8">
                {{ $names->links() }}
            </div>
            @endif
        </main>

        <x-names.sidebar />
    </section>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('copy-link').addEventListener('click', function() {
    const linkInput = document.getElementById('shareable-link');
    linkInput.select();
    document.execCommand('copy');
});
</script>
@endpush
