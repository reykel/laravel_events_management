<table>
    <thead>
    <tr>
        <th>Activity name</th>
        <th>Driver</th>
        <th>Date</th>
        <th>Hour</th>
        <th>Address</th>
        <th>Comment</th>
    </tr>
    </thead>
    <tbody>
    @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->user->name }}</td>
            <td>{{ $activity->date }}</td>
            <td>{{ $activity->hour }}</td>
            <td>{{ $activity->address }}</td>
            <td>{{ $activity->comment }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

