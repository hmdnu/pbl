@extends('layouts.app')

@section('title', 'Formulir Survey Alumni')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="p-4 rounded shadow" style="background-color: #b3b3b3; width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4 text-white">Validasi Alumni</h2>

        <form method="POST" action="{{ route('alumni.survey.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label text-white">Name</label>
                <input type="text" class="form-control bg-light border-0" id="nama" name="nama" placeholder="Enter your name">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label text-white">NIM</label>
                <input type="text" class="form-control bg-light border-0" id="nim" name="nim" placeholder="Enter your NIM">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white">Email</label>
                <div class="d-flex gap-2">
                    <input type="email" class="form-control bg-light border-0" id="email" name="email" placeholder="Enter your Email">
                    <button type="button" class="btn btn-dark px-3" onclick="kirimOTP()">Send OTP</button>
                </div>
            </div>

            <div class="mb-4">
                <label for="otp" class="form-label text-white">OTP</label>
                <input type="text" class="form-control bg-light border-0" id="otp" name="otp" placeholder="Enter OTP code">
            </div>

            <button type="submit" class="btn btn-dark w-100">Submit</button>
        </form>
    </div>
</div>

<script>
    function kirimOTP() {
        let email = document.getElementById('email').value;
        if (!email) {
            alert('Email harus diisi!');
            return;
        }

        fetch('/kirim-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => alert('Gagal mengirim OTP'));
    }
</script>
@endsection
