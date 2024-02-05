@foreach ($abbreviations as $abbreviationData)
    @foreach ($abbreviationData as $alphabet => $abbreviation)
        <tr class="hover:bg-base-50 dark:hover:bg-base-800 transition-colors duration-300">
            <th class="p-4 font-semibold text-base-800 dark:text-base-100 bg-base-100 dark:bg-base-800 uppercase">{{ $alphabet }}</th>
            <td class="p-4 text-base-900 dark:text-base-100">{{ $abbreviation }}</td>
        </tr>
    @endforeach
@endforeach