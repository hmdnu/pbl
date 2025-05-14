@extends('layouts.app')

@section('title', 'Persetujuan & Verifikasi OTP')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">
      <div class="card-body">
        <h5 class="card-title">Form Persetujuan Alumni</h5>
        <form id="agreementForm" method="POST" action="{{ route('survey.agreement.submit') }}">
          @csrf
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <input type="email" class="form-control" id="email" name="email" required>
              <button type="button" class="btn btn-secondary" id="sendOtp">Kirim OTP</button>
            </div>
          </div>
          <div class="mb-3">
            <label for="otp" class="form-label">Kode OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Submit</button>
          <div id="otpError" class="text-danger mt-2 d-none">Kode OTP salah atau expired.</div>
        </form>
      </div>
    </div>
</div>
@endsection
