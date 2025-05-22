@extends('layouts.admin')

@section('title', 'Manajemen Mahasiswa')

@section('admin-content')

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-create">Tambah Mahasiswa</button>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Modal Tambah Mahasiswa --}}
    <x-modal-form id="create" :action="url('/student')" method="POST" title="Tambah Mahasiswa">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text">NIM</span>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                placeholder="NIM Mahasiswa" value="{{ old('nim') }}">
            @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Nama</span>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Nama Mahasiswa" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Tanggal Lulus</span>
            <input type="date" name="graduation_date" class="form-control @error('graduation_date') is-invalid @enderror"
                value="{{ old('graduation_date') }}">
            @error('graduation_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Program Studi</span>
            <select name="program_study_id" class="form-select @error('program_study_id') is-invalid @enderror">
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($program_studies as $ps)
                    <option value="{{ $ps->id }}" {{ old('program_study_id') == $ps->id ? 'selected' : '' }}>
                        {{ $ps->name }}
                    </option>
                @endforeach
            </select>
            @error('program_study_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </x-modal-form>

    @include('admin.student.table')
@endsection
