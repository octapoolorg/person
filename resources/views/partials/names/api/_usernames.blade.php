@foreach ($userNames as $username)
    <div class="bg-gray-100 hover:bg-gray-200 rounded-lg p-4 flex flex-col items-center justify-center transition duration-300">
        <form method="POST">
            @csrf
            <input type="hidden" name="username" value="{{ $username }}">
            <button type="submit" class="text-lg font-medium text-gray-800 text-center break-words w-full">
                {{ $username }}
            </button>
        </form>
    </div>
@endforeach
