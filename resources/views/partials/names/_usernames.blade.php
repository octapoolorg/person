@foreach ($userNames as $username)
    <tr class="hover:bg-gray-50 transition-colors duration-300">
        <td class="p-4">{{ $username }}</td>
    </tr>
@endforeach
