@foreach ($abbreviations as $abbreviationData)
    @foreach ($abbreviationData as $alphabet => $abbreviation)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
            <th class="p-4 font-semibold text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 uppercase">{{ $alphabet }}</th>
            <td class="p-4 text-gray-900 dark:text-gray-100">{{ $abbreviation }}</td>
        </tr>
    @endforeach
@endforeach