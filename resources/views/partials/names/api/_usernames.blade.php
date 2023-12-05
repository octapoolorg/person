@foreach ($userNames as $username)
<div class="bg-gray-100 hover:bg-gray-200 rounded-lg px-5 py-4 flex items-center transition duration-300 w-full md:w-auto relative">
    <span class="text-lg font-medium text-gray-800 break-words mr-3 copy-to-clipboard">
        {{ $username }}
    </span>
    <form method="POST" class="flex items-center group">
        @csrf
        <input type="hidden" name="username" value="{{ $username }}">
        <button type="submit" class="focus:outline-none flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400 hover:fill-gray-600" viewBox="0 0 512 512">
                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
            </svg>
            <span class="absolute bottom-full mb-2 ml-8 bg-black text-white text-xs rounded py-1 px-3 hidden group-hover:block w-32">
                Check availability on top social media platforms
            </span>
        </button>
    </form>
</div>
@endforeach
