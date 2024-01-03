@extends('layouts.main')

@section('content')
    <section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8">
        <section class="container mx-auto px-4 py-8 mt-8 md:mt-20">
            <main class="w-full px-4">
                <article>
                    <h1 class="text-4xl font-bold mb-6 text-slate-900">{{ $page->title }}</h1>
                    <div class="prose prose-slate max-w-none ">
                        {!! $page->content !!}
                    </div>
                </article>
            </main>
        </section>
    </section>
@endsection