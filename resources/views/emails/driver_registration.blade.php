
@component('mail::message')
    Hi, a driver has been registered with this data:
    @component('mail::table')
        |               |               |              |
        | ------------- |:-------------:|:-------------:
        | Name:         | {{ $details['name'] }}       |  |
        | Email:        | {{ $details['email'] }}  |  |
        | Phone:        | {{ $details['phone'] }}      |  |
    @endcomponent

    {{ config('app.name') }}
@endcomponent
