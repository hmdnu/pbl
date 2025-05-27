@extends('layouts.user')

@section('title', 'Form Survey Pengguna Alumni')

@section('user-content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card w-75 p-3">
            <h4 class="mb-0 text-center">Formulir Survei Pengguna Alumni</h4>

            <div class="card-body bg-light mt-3">
                <form method="POST" action={{route('post.alumni-user.form', ['code' => $code])}}>
                    @csrf
                    <div class="mb-3">
                        <label for="student-nim" class="form-label">NIM Mahasiswa</label>
                        <input type="text" name="student_nim" class="form-control" id="student-nim"
                               value="{{ $student->nim }}" readonly>
                        @error('student_nim')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="student-name" class="form-label">Nama Alumni</label>
                        <input type="text" name="student_name" class="form-control" id="student-name"
                               value="{{$student->name}}"
                               readonly>
                        @error('student_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="study-program" class="form-label">Program Studi Alumni</label>
                        <input type="text" name="study_program" class="form-control" id="study-program"
                               value="{{ $program_study }}"
                               required readonly>
                        @error('student_study_program')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                               required placeholder="Masukan nama anda">
                        @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
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
                                Pemerintah
                            </option>
                            <option value="bumn" {{ old('institution_type') == 'bumn' ? 'selected' : '' }}>BUMN</option>
                            <option value="swasta" {{ old('institution_type') == 'swasta' ? 'selected' : '' }}>
                                Perusahaan
                                Swasta
                            </option>
                        </select>
                        @error('institution_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution_name" class="form-label">Nama Instansi</label>
                        <input type="text" name="institution_name" class="form-control" id="institution_name"
                               value="{{ old('institution_name') }}" required placeholder="Masukan nama instansi">
                        @error('institution_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="institution-scope" class="form-label">Skala Instansi</label>
                        <select name="institution_scope" id="institution-scope" class="form-select">
                            <option selected disabled>Pilih skala instansi</option>
                            <option value="nasional" {{ old('institution_scope') == 'nasional' ? 'selected' : '' }}>
                                Nasional
                            </option>
                            <option
                                value="internasional" {{ old('institution_scope') == 'internasional' ? 'selected' : '' }}>
                                Internasional
                            </option>
                            <option value="wirausaha" {{ old('institution_scope') == 'wirausaha' ? 'selected' : '' }}>
                                Wirausaha
                            </option>
                        </select>
                        @error('institution_scope')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Alamat Instansi</label>
                        <input type="text" name="location" class="form-control" id="location"
                               value="{{ old('location') }}" required placeholder="Masukan lokasi anda">
                        @error('location')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" name="position" class="form-control" id="position"
                               value="{{ old('position') }}" required placeholder="Masukan jabatan anda">
                        @error('position')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Instansi</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                               required placeholder="Masukan email instansi">
                        @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

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
                                               value="{{ $option }}"
                                               {{ old($key) == $option ? 'checked' : '' }} required>
                                        <label class="form-check-label">{{ $option }}</label>
                                    </div>
                                @endforeach
                                @error($key)
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label for="curriculum_suggestion" class="form-label">Saran untuk Kurikulum</label>
                        <textarea name="curriculum_suggestion" class="form-control" id="curriculum_suggestion" rows="4"
                                  required>{{ old('curriculum_suggestion') }}</textarea>
                        @error('curriculum_suggestion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
