@extends('layouts.app')

@section('title', 'Form Survey Pengguna Alumni')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 1000px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Form Survey Pengguna Alumni</h2>

                <form method="POST" action="{{ route('survey.form.submit') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}"
                            required>
                        @error('nama')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Instansi -->
                    <div class="mb-3">
                        <label for="jenis_instansi" class="form-label">Jenis Instansi</label>
                        <select name="jenis_instansi" class="form-select" id="jenis_instansi" required>
                            <option value="">-- Pilih Jenis Instansi --</option>
                            <option value="pendidikan_tinggi"
                                {{ old('jenis_instansi') == 'pendidikan_tinggi' ? 'selected' : '' }}>Pendidikan Tinggi
                            </option>
                            <option value="instansi_pemerintah"
                                {{ old('jenis_instansi') == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah
                            </option>
                            <option value="perusahaan_swasta"
                                {{ old('jenis_instansi') == 'perusahaan_swasta' ? 'selected' : '' }}>Perusahaan Swasta
                            </option>
                            <option value="BUMN" {{ old('jenis_instansi') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                            <option value="lainnya" {{ old('jenis_instansi') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('jenis_instansi')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Instansi -->
                    <div class="mb-3">
                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control" id="nama_instansi"
                            value="{{ old('nama_instansi') }}" required>
                        @error('nama_instansi')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" id="jabatan"
                            value="{{ old('jabatan') }}" required>
                        @error('jabatan')
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
                        <label for="nim_mahasiswa" class="form-label">NIM Mahasiswa</label>
                        <input type="text" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa"
                            value="{{ old('nim_mahasiswa') }}" required>
                        @error('nim_mahasiswa')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Penilaian Soft Skill -->
                    @php
                        $questions = [
                            'kerjasama_tim' => 'Kemampuan Kerja Sama dalam Tim',
                            'keahlian_ti' => 'Keahlian di Bidang TI',
                            'bahasa_asing' => 'Kemampuan Berbahasa Asing',
                            'komunikasi' => 'Kemampuan Berkomunikasi',
                            'pengembangan_diri' => 'Pengembangan Diri',
                            'kepemimpinan' => 'Kepemimpinan',
                            'etos_kerja' => 'Etos Kerja',
                            'kompetensi_kurang' => 'Kompetensi yang Belum Terpenuhi',
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
                        <label for="saran_kurikulum" class="form-label">Saran untuk Kurikulum</label>
                        <textarea name="saran_kurikulum" class="form-control" id="saran_kurikulum" rows="4" required>{{ old('saran_kurikulum') }}</textarea>
                        @error('saran_kurikulum')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary w-100">Kirim Jawaban</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
