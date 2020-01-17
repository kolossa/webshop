<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
		<script src="{{ asset('js/app.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>