<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.8.2/dist/alpine.js" defer></script>

    </head>
    <body class="bg-gray-100 text-gray-800">
        @include('partials.navbar')
        
        @yield('content')
    </body>
</html>
