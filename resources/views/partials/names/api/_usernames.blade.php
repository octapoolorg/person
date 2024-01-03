@foreach ($userNames as $username)
    <span class="bg-slate-100 hover:bg-slate-200 rounded-lg text-lg font-medium text-slate-800 break-words mr-3 copy-to-clipboard transition duration-300 px-5 py-4">
        {{ $username }}
    </span>
@endforeach
