@extends('layouts.admin')

@section('title','Rekap Survey Pengguna Alumni')

@section('admin-content')
    <a href="{{route('dashboard.download.alumni-user-survey.recap')}}" class="btn btn-primary">Download Rekap</a>
@endsection
