@foreach ($abbreviations as $abbreviationData)
    @foreach ($abbreviationData as $alphabet => $abbreviation)
        <tr class="hover:bg-slate-50 transition-colors duration-300">
            <th class="p-4 font-semibold text-slate-800 bg-slate-100 uppercase">{{ $alphabet }}</th>
            <td class="p-4 text-slate-900">{{ $abbreviation }}</td>
        </tr>
    @endforeach
@endforeach