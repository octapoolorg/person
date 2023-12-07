@foreach ($abbreviations as $abbreviationData)
    @foreach ($abbreviationData as $alphabet => $abbreviation)
        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors duration-300">
            <th class="p-4 font-semibold text-slate-800 dark:text-slate-100 bg-slate-100 dark:bg-slate-700 uppercase">{{ $alphabet }}</th>
            <td class="p-4 text-slate-900 dark:text-slate-100">{{ $abbreviation }}</td>
        </tr>
    @endforeach
@endforeach