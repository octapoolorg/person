@foreach ($userNames as $username)
    <span class="bg-base-100 dark:bg-base-900 dark:border dark:border-base-800 hover:bg-base-200 dark:hover:bg-base-800 rounded-lg text-lg font-medium text-base-800 dark:text-base-100 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4 cursor-pointer select-all" @click.prevent="Utility.copyTextToClipboard($event.target.innerText,$event)">
        {{ $username }}
    </span>
@endforeach
