@extends('layouts.admin')

@section('title', 'Rekap Survey Alumni')

@section('admin-content')
    <a href="{{route('dashboard.download.alumni-survey.recap')}}" class="btn btn-primary">Download Rekap</a>
@endsection
