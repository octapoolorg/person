@foreach ($acronyms as $acronymData)
    @foreach ($acronymData as $alphabet => $acronym)
        <tr class="hover:bg-gray-50 transition-colors duration-300">
            <th class="p-4 font-semibold text-gray-800 bg-gray-100 uppercase">{{ $alphabet }}</th>
            <td class="p-4">{{ is_string($acronym) ? $acronym : '' }}</td>
        </tr>
    @endforeach
@endforeach