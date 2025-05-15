@extends('layouts.app')

@section('title', 'Form Survey Pengguna Alumni')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 1000px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Form Survey Pengguna Alumni</h2>

                <form method="POST" action="/survey/alumni-user/form">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Instansi -->
                    <div class="mb-3">
                        <label for="institution_type" class="form-label">Jenis Instansi</label>
                        <select name="institution_type" class="form-select" id="institution_type" required>
                            <option value="">-- Pilih Jenis Instansi --</option>
                            <option value="pendidikan_tinggi"
                                {{ old('institution_type') == 'pendidikan_tinggi' ? 'selected' : '' }}>Pendidikan Tinggi
                            </option>
                            <option value="instansi_pemerintah"
                                {{ old('institution_type') == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah
                            </option>
                            <option value="perusahaan_swasta"
                                {{ old('institution_type') == 'perusahaan_swasta' ? 'selected' : '' }}>Perusahaan Swasta
                            </option>
                            <option value="BUMN" {{ old('institution_type') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                            <option value="lainnya" {{ old('institution_type') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('institution_type')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Instansi -->
                    <div class="mb-3">
                        <label for="institution_name" class="form-label">Nama Instansi</label>
                        <input type="text" name="institution_name" class="form-control" id="institution_name"
                            value="{{ old('institution_name') }}" required>
                        @error('institution_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" name="position" class="form-control" id="position"
                            value="{{ old('position') }}" required>
                        @error('position')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Instansi -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Instansi</label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- NIM Mahasiswa -->
                    <div class="mb-3">
                        <label for="student_nim" class="form-label">NIM Mahasiswa</label>
                        <input type="text" name="student_nim" class="form-control" id="student_nim"
                            value="{{ old('student_nim') }}" required>
                        @error('student_nim')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Penilaian Soft Skill -->
                    @php
                        $questions = [
                            'teamwork' => 'Kemampuan Kerja Sama dalam Tim',
                            'it_expertise' => 'Keahlian di Bidang TI',
                            'foreign_language' => 'Kemampuan Berbahasa Asing',
                            'communication' => 'Kemampuan Berkomunikasi',
                            'self_development' => 'Pengembangan Diri',
                            'leadership' => 'Kepemimpinan',
                            'work_ethic' => 'Etos Kerja',
                            'unmet_competencies' => 'Kompetensi yang Belum Terpenuhi',
                        ];

                        $options = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
                    @endphp

                    @foreach ($questions as $key => $label)
                        <div class="mb-3">
                            <label class="form-label">{{ $label }}</label>
                            <div class="d-flex flex-column">
                                @foreach ($options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $key }}"
                                            value="{{ $option }}" {{ old($key) == $option ? 'checked' : '' }}
                                            required>
                                        <label class="form-check-label">{{ $option }}</label>
                                    </div>
                                @endforeach
                                @error($key)
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <!-- Saran untuk Kurikulum -->
                    <div class="mb-3">
                        <label for="curriculum_suggestion" class="form-label">Saran untuk Kurikulum</label>
                        <textarea name="curriculum_suggestion" class="form-control" id="curriculum_suggestion" rows="4" required>{{ old('curriculum_suggestion') }}</textarea>
                        @error('curriculum_suggestion')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
