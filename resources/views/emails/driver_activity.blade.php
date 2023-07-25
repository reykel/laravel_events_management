
@component('mail::message')
    Hi, you has been assigned a new activity.
    @component('mail::table')
        |               |               |              |
        | ------------- |:-------------:|:-------------:
        | Activity name:    | {{ $activity->name }}       |  |
        | Date:         | {{ $activity->date }}  |  |
        | Hour:         | {{ $activity->hour }}  |  |
        | Address:      | {{ $activity->address }}   |  |
    @endcomponent

    {{ config('app.name') }}
@endcomponent
