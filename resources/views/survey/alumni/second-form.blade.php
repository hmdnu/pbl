@extends('layouts.app')

@section('title', 'Survey Alumni')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card w-100 p-3">
            <h4 class="mb-0 text-center">Formulir Survei Alumni</h4>
            <div class="card-body bg-light">
                <form action="{{ route('post.alumni.form.2', ['code' => $code]) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="profession-category" class="form-label">Kategori Profesi</label>
                        <input type="text" name="profession_category" id="profession-category" class="form-control"
                            disabled value="{{ $category }}">
                    </div>

                    <div class="mb-3">
                        <label for="profession" class="form-label">Nama Profesi</label>
                        <select name="profession" id="profession" class="form-select">
                            <option selected disabled>Pilih profesi</option>
                            @foreach ($professions as $p)
                                <option value="{{ $p->id }}" {{ old('profession') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('profession')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="graduation-date" class="form-label">Tanggal Lulus</label>
                        @php
                            \Carbon\Carbon::setLocale('id');
                            $gradDate = \Carbon\Carbon::parse($graduationDate)->format('Y-m-d');
                        @endphp
                        <input type="text" name="graduation_date" id="graduation-date" class="form-control"
                            value="{{ $gradDate }}" readonly>
                        @error('graduation_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="first-work-date" class="form-label">Tanggal Pertama Kali Bekerja</label>
                        <input type="text" name="first_work_date" id="first-work-date" class="form-control"
                            placeholder="Tanggal pertama kali bekerja" value="{{ old('first_work_date') }}">
                        @error('first_work_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="waiting-period" class="form-label">Masa Tunggu (bulan)</label>
                        <input type="text" id="waiting-period" name="waiting_period" class="form-control" value="-"
                            readonly>

                        @error('waiting_period')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution-type" class="form-label">Jenis Instansi</label>
                        <select name="institution_type" id="institution-type" class="form-select">
                            <option selected disabled>Pilih jenis instansi</option>
                            <option value="pendidikan-tinggi"
                                {{ old('institution_type') == 'pendidikan-tinggi' ? 'selected' : '' }}>Pendidikan Tinggi
                            </option>
                            <option value="instansi-pemerintah"
                                {{ old('institution_type') == 'instansi-pemerintah' ? 'selected' : '' }}>Instansi
                                Pemerintah</option>
                            <option value="bumn" {{ old('institution_type') == 'bumn' ? 'selected' : '' }}>BUMN</option>
                            <option value="swasta" {{ old('institution_type') == 'swasta' ? 'selected' : '' }}>Perusahaan
                                Swasta</option>
                        </select>
                        @error('institution_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution-name" class="form-label">Nama Instansi</label>
                        <input type="text" name="institution_name" id="institution-name" class="form-control"
                            placeholder="Masukkan nama instansi" value="{{ old('institution_name') }}">
                        @error('institution_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution-location" class="form-label">Alamat Instansi</label>
                        <input type="text" name="institution_location" id="institution-location" class="form-control"
                            placeholder="Masukkan alamat instansi" value="{{ old('institution_location') }}">
                        @error('institution_location')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="first-institution-work-date" class="form-label">Tanggal Masuk Instansi Saat Ini</label>
                        <input type="text" placeholder="Masukan tanggal pertama bekerja di instansi ini"
                            name="first_institution_work_date" id="first-institution-work-date" class="form-control"
                            value="{{ old('first_institution_work_date') }}">
                        @error('first_institution_work_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="supervisor-name" class="form-label">Nama Atasan Langsung</label>
                        <input type="text" name="supervisor_name" id="supervisor-name" class="form-control"
                            placeholder="Masukkan nama atasan langsung" value="{{ old('supervisor_name') }}">
                        @error('supervisor_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="supervisor-position" class="form-label">Jabatan Atasan Langsung</label>
                        <input type="text" name="supervisor_position" id="supervisor-position" class="form-control"
                            placeholder="Masukkan jabatan atasan langsung" value="{{ old('supervisor_position') }}">
                        @error('supervisor_position')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="supervisor-email" class="form-label">Email Atasan Langsung</label>
                        <input type="email" name="supervisor_email" id="supervisor-email" class="form-control"
                            placeholder="Masukkan email atasan langsung" value="{{ old('supervisor_email') }}">
                        @error('supervisor_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" id="btn" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/alumniSecondForm.js')
@endsection
