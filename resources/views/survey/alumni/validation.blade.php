@extends('layouts.app')

@section('title', 'Formulir Survei Alumni')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Validasi Alumni</h5>
                <form action="{{ route('post.alumni.send-otp') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan alamat email Anda" value="{{ old('email') }}">
                            <button type="submit" class="btn btn-secondary">Kirim OTP</button>
                        </div>
                        @if (session('message'))
                            <p class="text-success mt-1">{{ session('message') }}</p>
                        @endif
                        @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </form>

                <form method="POST" action="{{ route('post.alumni.verifying-otp') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                            placeholder="Masukkan NIM Anda" value="{{ old('nim') }}">
                        @error('nim')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="otp" class="form-label">Kode OTP</label>
                        <div class="input-group">
                            <input type="otp" class="form-control" id="otp" name="otp"
                                placeholder="Masukan kode OTP anda">
                        </div>
                        @error('otp')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ('wrong_otp')
                        <div class="mb-3">
                            <p class="text-danger text-center">{{ session('wrong_otp') }}</p>
                        </div>
                    @endif

                    @error('error')
                        <div class="mb-3">
                            <p class="text-danger text-center">{{ $message }}</p>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100">Verifikasi OTP</button>
                </form>
            </div>
        </div>
    </div>
@endsection
