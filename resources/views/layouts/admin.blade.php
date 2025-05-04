@extends('layouts.app')

<head>
    @stack('heads')
</head>

@section('content')
    @include('partials.sidebar')

    <div class="container">
        @yield('admin-content')
    </div>
@endsection
