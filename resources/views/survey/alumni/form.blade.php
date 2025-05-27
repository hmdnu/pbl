@extends('layouts.user')

@section('title', 'Survey Alumni')

@section('user-content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card w-100 p-3">
            <h4 class="mb-0 text-center">Formulir Survei Alumni</h4>

            <div class="card-body bg-light">
                <form action="{{ route('post.alumni.form', ['code' => $code]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control" value="{{ $student->nim }}"
                               required readonly>
                        @error('nim')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ $student->name }}" required readonly>
                        @error('name')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="graduation-date" class="form-label">Tanggal Lulus</label>
                        <input type="text" name="graduation-date" id="graduation-date" class="form-control"
                               value="{{ $student->graduation_date }}" required readonly>
                        @error('graduation-date')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="Masukkan alamat email Anda" required>
                        @error('email')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Handphone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                               placeholder="Masukkan nomor handphone Anda" required>
                        @error('phone')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="profession-category" class="form-label">Kategori Profesi</label>

                        <select name="profession-category" id="profession-category" class="form-select" required>
                            <option selected disabled>Pilih kategori profesi</option>
                            @foreach ($profession_categories as $profession)
                                <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                            @endforeach
                        </select>
                        @error('profession-category')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (session('error'))
                        <p>{{ session('error') }}</p>
                    @endif
                    <button type="submit" id="btn" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/alumniFirstForm.js')
@endsection
