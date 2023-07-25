<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'European Events Management 2022') }}</title>
        <link rel="icon" type="image/jpg" sizes="32x32" href="{{ asset('/img/logo.png') }}">
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        @if(Route::getCurrentRoute()->middleware()[0] === 'admin'){
        <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
        @else
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @endif

        <!-- Scripts -->
        @routes
        @if(Route::getCurrentRoute()->middleware()[0] === 'admin'){
        <script src="{{ mix('js/admin.js') }}" defer></script>
        @else
            <script src="{{ mix('js/app.js') }}" defer></script>
            <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google_recaptcha.site_key') }}"></script>
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.google_recaptcha.site_key') }}', {action: 'login'}).then(function(token) {
                    //    $('.login-form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                    //    localStorage.setItem('captcha', token);
                        console.log(token)
                    });
                });
            </script>
        @endif
        @inertiaHead
    </head>
    <body class="antialiased">
        @inertia
    </body>
</html>
