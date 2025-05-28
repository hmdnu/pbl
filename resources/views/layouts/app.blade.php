<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    @vite('resources/js/app.js')
    @stack('heads')
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
<script>
    feather.replace();
</script>
</body>
</html>
