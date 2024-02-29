@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="container mx-auto px-4 py-8 mt-8 md:mt-20 bg-surface dark:bg-base-800">
            <main class="w-full px-4">
                <article>
                    <h1 class="text-4xl font-bold mb-6 text-base-900 dark:text-base-100">{{ $page->title }}</h1>
                    <div class="prose prose-slate max-w-none  dark:prose-invert">
                        {!! $page->content !!}
                    </div>
                </article>
            </main>
        </section>
    </section>
@endsection