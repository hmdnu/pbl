@extends('layouts.app')

@section('title', 'Formulir Survei Alumni')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Validasi Alumni</h5>

                <form method="POST" action="/survey/alumni/validation">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                            placeholder="Masukkan NIM Anda">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan alamat email Anda">
                            <button type="button" class="btn btn-secondary" onclick="kirimOTP()">Kirim OTP</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="otp" class="form-label">Kode OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp"
                            placeholder="Masukkan kode OTP">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
