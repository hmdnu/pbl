@extends('layouts.app')

@push('heads')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        tr td {
            vertical-align: middle
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
@endpush

@section('content')
    @include('partials.header')
    <x-sidebar />
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
                @yield('admin-content')

            </main>
        </div>
    </div>
@endsection
