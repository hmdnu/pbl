@extends('layouts.app')

@section('title', 'Verifikasi OTP')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Verifikasi OTP</h5>
                <form method="POST" action="{{ route('post.alumni.verifying-otp') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="otp" class="form-label">OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp"
                            placeholder="Masukkan OTP Anda" value="{{ old('otp') }}">
                        @error('otp')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <a href="{{ route('view.alumni.validation') }}" class="btn btn-primary">Kirim Ulang</a>
                        {{-- <h5>1:00</h5>   --}}
                    </div>

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
