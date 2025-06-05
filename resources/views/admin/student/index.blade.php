@extends('layouts.admin')

@section('title', 'Manajemen Mahasiswa')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-create">
            Tambah Mahasiswa
        </button>
        <a href="{{ route('student.import') }}" class="btn btn-primary">
            Import Excel
        </a>
    </div>

    <form method="GET" action="{{ route('student.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
        <div>
            <select name="prodi" class="form-select">
                <option value="">Semua Prodi</option>
                @foreach ($program_studies as $program)
                    <option value="{{ $program->id }}" {{ request('prodi') == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="tahun" class="form-select">
                <option value="">Semua Tahun</option>
                @php
                    $currentYear = date('Y');
                    for ($i = $currentYear; $i >= $currentYear - 3; $i--) {
                        echo '<option value="'.$i.'"'.(request('tahun') == $i ? ' selected' : '').'>'.$i.'</option>';
                }
                @endphp
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
    </div>

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
            <input type="date" name="graduation_date"
                   class="form-control @error('graduation_date') is-invalid @enderror"
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
