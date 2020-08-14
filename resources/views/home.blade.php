<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!--Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
</head>
<body>
    <div id="app">
        {{-- <router-link to="/login"><a>url to category</a></router-link> --}}
        {{-- <p>asdasdasd</p> --}}
        {{-- <index-component></index-component> --}}
        {{-- <example-component></example-component> --}}
        <router-view></router-view>
    </div>

    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsMyaK7aIpFYjTIbPBafSnxxOg3SwSIIk&libraries=places"
        async defer></script> --}}
</body>
</html>
