<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    @vite('resources/js/app.js')
    @stack('heads')
    <style>
        .flatpickr-input[readonly] {
            background-color: white !important;
            cursor: default;
        }
    </style>
</head>

<body>
    <main class="root">
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
