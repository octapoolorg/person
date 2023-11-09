@extends('layouts.main')

@section('content')
    <section class="container mx-auto px-4 pt-8 pb-16">
        <div class="flex flex-wrap -mx-4">
            <main class="w-full lg:w-2/3 px-4 mb-12">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <article class="p-8">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full rounded-t-lg mb-6 object-cover">
                        @endif
                        <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $post->title }}</h1>
                        <div class="flex items-center text-gray-600 mb-6">
                            <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}" class="h-12 w-12 rounded-full mr-4">
                            <div>
                                By <a href="#" class="text-indigo-600 hover:underline">{{ $post->author->name }}</a> on <time datetime="{{ $post->publish_date }}">{{ $post->publish_date->format('M d, Y') }}</time>
                            </div>
                        </div>
                        <div class="prose prose-slate max-w-none">
                            {!! $post->content !!}
                        </div>
                    </article>
                </div>
            </main>
            <aside class="w-full lg:w-1/3 px-4">
                <div class="lg:sticky relative top-8">
                    <section class="mb-8 bg-white overflow-hidden shadow rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">About the Author</h2>
                        <div class="flex items-center mb-6">
                            <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}" class="h-16 w-16 rounded-full mr-4">
                            <div class="text-gray-600">
                                <p>{{ $post->author->bio }}</p>
                            </div>
                        </div>
                    </section>
                    <section class="bg-white overflow-hidden shadow rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Posts</h2>
                        <!-- Loop through related posts -->
                        @foreach ($relatedPosts as $relatedPost)
                            <div class="mb-4 last:mb-0">
                                <a href="{{ route('blog.show', $relatedPost) }}" class="text-xl text-indigo-600 hover:underline">{{ $relatedPost->title }}</a>
                            </div>
                        @endforeach
                    </section>
                </div>
            </aside>
        </div>
    </section>
@endsection
