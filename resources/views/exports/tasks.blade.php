<table>
    <thead>
    <tr>
        <th>Task name</th>
        <th>Driver</th>
        <th>Date</th>
        <th>Hour</th>
        <th>Assistant</th>
        <th>Address</th>
        <th>Comment</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->name }}</td>
            <td>{{ $task->user->name }}</td>
            <td>{{ $task->date }}</td>
            <td>{{ $task->hour }}</td>
            <td>{{ $task->executive->name }} {{ $task->executive->last_name }}</td>
            <td>{{ $task->address }}</td>
            <td>{{ $task->comment }}</td>


        </tr>
    @endforeach
    </tbody>
</table>
