@extends('layouts.main')

@section('content')
    <section class="flex flex-col lg:flex-row mb-12 pt-8 md:pt-20">
        <main class="w-full lg:w-2/3 p-4 md:ps-0 mb-4 lg:mb-0">
            <article>
                    @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full rounded-t-lg mb-6 object-cover">
                    @endif
                    <h1 class="text-4xl font-bold text-slate-800 dark:text-slate-100 mb-6">{{ $post->title }}</h1>
                    <div class="flex items-center text-slate-600 dark:text-slate-300 mb-6">
                        @if (!empty($post->author->avatar) && file_exists(public_path($post->author->avatar)))
                            <img src="{{ $post->author->avatar }}" alt="author {{ $post->author->name }}" class="h-12 w-12 rounded-full mr-4">
                        @endif
                        <div>
                            By <a href="#" class="text-indigo-600 hover:underline dark:text-indigo-400 dark:hover:text-indigo-200">{{ $post->author->name }}</a> on <time datetime="{{ $post->publish_date }}">{{ $post->publish_date->format('M d, Y') }}</time>
                        </div>
                    </div>
                    <div class="prose prose-slate max-w-none  dark:prose-invert">
                        {!! $post->content !!}
                    </div>
                </article>
        </main>
        <aside class="w-full lg:w-1/3 md:px-4">
            <div class="lg:sticky relative top-8">
                <section class="mb-8 overflow-hidden shadow dark:shadow-none rounded-lg p-6 dark:border dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-6">About the Author</h2>
                    <div class="flex items-center mb-6">
                        @if (!empty($post->author->avatar) && file_exists(public_path($post->author->avatar)))
                            <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}" class="h-16 w-16 rounded-full mr-4">
                        @endif
                        <div class="text-slate-600 dark:text-slate-300">
                            <p>{!! $post->author->bio !!}</p>
                        </div>
                    </div>
                </section>
                <section class="overflow-hidden shadow dark:shadow-none rounded-lg p-6 dark:border dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-6">Related Posts</h2>
                    <!-- Loop through related posts -->
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="mb-4 last:mb-0">
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="text-xl text-indigo-600 hover:underline dark:text-indigo-400 dark:hover:underline">{{ $relatedPost->title }}</a>
                        </div>
                    @endforeach
                </section>
            </div>
        </aside>
    </section>
@endsection