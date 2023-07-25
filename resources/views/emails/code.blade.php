
@component('mail::message')
    Hi, this is your authentication code: {{ $code }}.

    {{ config('app.name') }}
@endcomponent
