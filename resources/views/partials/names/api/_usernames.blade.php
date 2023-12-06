@foreach ($userNames as $username)
    <span class="bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg text-lg font-medium text-gray-800 dark:text-gray-100 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4">
        {{ $username }}
    </span>
@endforeach
