<div class="my-12 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Attributes & Details</h2>
        <p class="text-gray-600">Explore the unique traits associated with the name</p>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach (['Ruling Hours', 'Lucky Days', 'Passion', 'Life Pursuit', 'Vibration'] as $index => $attribute)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-300 p-4 flex flex-col items-center text-center">
                <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" alt="{{ $attribute }} icon" class="w-24 h-24 rounded-full mb-4" />
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $attribute }}</h3>
                <p class="text-indigo-500">{{ $attribute }} related details</p>
            </div>
        @endforeach
    </div>
</div>
