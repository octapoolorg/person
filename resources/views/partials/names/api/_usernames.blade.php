@foreach ($userNames as $username)
    <span class="bg-slate-100 dark:bg-slate-900 dark:border dark:border-slate-800 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg text-lg font-medium text-slate-800 dark:text-slate-100 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4">
        {{ $username }}
    </span>
@endforeach
