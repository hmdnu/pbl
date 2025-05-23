@extends('layouts.app')

@section('title', 'Tracer Study')

@section('content')
    <div class="d-flex flex-column container mt-5">
        <a href="{{ route('dashboard.spread') }}">Dashboard</a>
        <a href="{{ route('view.alumni.validation') }}">Survey Alumni</a>
        <a href="{{ route('view.alumni-user.agreement') }}">Survey Pengguna Alumni</a>
    </div>
@endsection
