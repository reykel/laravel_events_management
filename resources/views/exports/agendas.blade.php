<table>
    <thead>
    <tr>
        <th>Event name</th>
        <th>Date</th>
        <th>Hour</th>
    </tr>
    </thead>
    <tbody>
    @foreach($agendas as $agenda)
        <tr>
            <td>{{ $agenda->name }}</td>
            <td>{{ $agenda->date }}</td>
            <td>{{ $agenda->hour_start }}</td>
            <td>{{ $agenda->hour_end }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

