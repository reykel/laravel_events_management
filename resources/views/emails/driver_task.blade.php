
@component('mail::message')
    Hi, you has been assigned a new task.
    @component('mail::table')
        |               |               |              |
        | ------------- |:-------------:|:-------------:
        | Task name:    | {{ $task->name }}       |  |
        | Date:         | {{ $task->date }}  |  |
        | Hour:         | {{ $task->hour }}  |  |
        | Address:      | {{ $task->address }}   |  |
        | Assistant name: | {{ $task->executive->name }}   |  |
        | Address: | {{ $task->address }}   | |
        | Phone: | +{{ $task->executive->phone_code }} {{ $task->executive->phone }}   | |
        | Mobile: | +{{ $task->executive->mobile_code }} {{ $task->executive->mobile }}   | |
    @endcomponent

    {{ config('app.name') }}
@endcomponent
