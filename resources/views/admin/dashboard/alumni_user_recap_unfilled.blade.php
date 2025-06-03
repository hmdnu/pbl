@extends('layouts.admin')

@section('title','Rekap Pengguna Alumni Belum Isi Survey')

@section('admin-content')
    <a href="{{ route('dashboard.alumni-user-survey.unfilled.export') }}" class="btn btn-primary">Download Rekap</a>
@endsection
