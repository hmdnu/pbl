@extends('layouts.admin')

@section('title', 'Import Data Mahasiswa')

@section('admin-content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('student.import.post') }}">
        @csrf
        <div class="mb-3">
            <input class="form-control" type="file" id="formFile" name="file" accept=".xlsx,.xls,.csv">
        </div>
        @if(session('success'))
            <p class="text-success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-danger">{{ session('error') }}</p>
        @endif
        @error('file')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <button class="btn btn-primary" type="submit">Import</button>
    </form>
@endsection
