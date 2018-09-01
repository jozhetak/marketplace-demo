<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">

    	<title>{{ config('app.name', 'Laravel') }}</title>

    	<!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    	<!-- Scripts -->
    	<script>
    		window.Laravel = {!! json_encode([
    			'csrfToken' => csrf_token(),
                'clientId' => env('PASSWORD_CLIENT_ID'),
                'clientSecret' => env('PASSWORD_CLIENT_SECRET'),
    		]) !!};
    	</script>
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
