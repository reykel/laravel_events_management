
@component('mail::message')
    Hi, your user registration has been {{ $details['result'] }}. 
    
    {{ config('app.name') }}
@endcomponent
