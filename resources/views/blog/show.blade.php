@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="container mb-12 pt-8">
            <main class="p-4 md:ps-0 mb-4 lg:mb-0 bg-surface dark:bg-base-800 shadow rounded-lg">
                <article class="md:p-10 prose prose-base max-w-none dark:prose-invert">
                    @if (!empty($post->featured_image) && file_exists(public_path($post->featured_image)))
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                            class="w-full rounded-t-lg mb-6 object-cover">
                    @endif
                    <h1 class="text-3xl lg:text-5xl font-semibold text-base-800 dark:text-base-100 mb-6">{{ $post->title }}</h1>
                    <div class="flex flex-col md:flex-row items-start md:items-center text-base-600 dark:text-base-300 mb-6">
                        @if (!empty($post->author->avatar) && file_exists(public_path($post->author->avatar)))
                            <img src="{{ $post->author->avatar }}" alt="author {{ $post->author->name }}"
                                class="h-12 w-12 rounded-full mr-4">
                        @endif
                        <div>
                            By <a href="#"
                                class="text-primary-600 hover:underline dark:text-primary-400 dark:hover:text-primary-200">{{ $post->author->name }}</a>
                            on <time datetime="{{ $post->publish_date }}">{{ $post->publish_date->format('M d, Y') }}</time>
                        </div>
                    </div>
                    <div class="">
                        {!! $post->content !!}
                    </div>
                </article>
            </main>
        </section>
    </section>
@endsection
