<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script>$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });</script>

        <title>App Name - @yield('title')</title>
    </head>
    <body>
        <div class="msg">
        </div>


        @section('sidebar')



        @show

        <div class="container">
            @yield('content')
        </div>


    </body>
</html>
