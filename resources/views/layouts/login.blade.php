<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    @yield('styles')
</head>
<body>

    <div class="container">
        
        <div class="form-container">
            @yield('content')
        </div>

        <div class="bg-content"></div>
    </div>
    

    @yield('scripts')
</body>
</html>
