
@component('mail::message')
    Hi, {{ $task->executive->name  }}. One driver from our team will pick you up:
    @component('mail::table')
        |               |               |              |
        | ------------- |:-------------:|:-------------:
        | Driver name:    | {{ $task->user->name }}       |  |
        | Driver phone:   | {{ $task->user->phone }}  |  |
        | Address:      | {{ $task->address }}   |  |
        | Date:         | {{ $task->date }}  |  |
        | Hour:         | {{ $task->hour }}  |  |
    @endcomponent

    {{ config('app.name') }}
@endcomponent
