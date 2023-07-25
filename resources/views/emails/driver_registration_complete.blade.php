
@component('mail::message')
    Hi {{ $name }}, you has been registered successfully. Please, login into our platform to proceed.
    We will send you an email right after with a verification code.

    {{ config('app.name') }}
@endcomponent


Your account has been created successfully.
              </h2>
              <div class="bg-white overflow-hidden sm:rounded-lg text-justify">
                <!-- For you to login, your account needs to be activated by our admin. An email will be send to you to notify the activation. -->
                