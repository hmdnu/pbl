@extends('layouts.admin')

@section('title','Rekap Alumni Belum Isi Survey')

@section('admin-content')
    <a href="{{route('dashboard.alumni-survey.unfilled.export')}}" class="btn btn-primary">Download Rekap</a>
@endsection
