@extends('layouts.main')

@section('content')
<section class="max-w-7xl mx-auto px-6 md:px-4 lg:px-8 py-8 md:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($images as $image)
            <div class="flex flex-col bg-white shadow-lg overflow-hidden rounded-lg">
                <div class="flex-shrink-0">
                    <img src="{{$image}}" alt="Image name" class="h-48 w-full object-cover transition-transform duration-500 hover:scale-110">
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 leading-tight">Image Name</h2>
                    <p class="mt-3 text-base text-gray-500">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum doloribus omnis sequi, animi iure sed voluptate eveniet? Atque asperiores, vitae beatae ex culpa fuga ipsum recusandae minima, similique dolorem saepe.
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
