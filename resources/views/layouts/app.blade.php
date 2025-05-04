<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite('resources/bootstrap/css/boostrap.css')
    @vite('resources/bootstrap/js/bootstrap.js')
</head>

<body>
    <main class="root">
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
