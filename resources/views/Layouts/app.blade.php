<!doctype html>
<html>

<head>
    <title>
       Power Smile
    </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    @include('libraries.styles')

    <style>


        
    </style>
</head>

<body>
    <div id="app">
        @include('components.nav')
        @yield('toolbar')
        <div class="container">
            @include('components.alerts')
            @yield('content')
        </div>
        @yield('content2')
    </div>
    @include('libraries.scripts')
</body>

</html>
