@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
    <main class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px    ;">
            <h4 class="mb-4 text-center">Login Admin</h4>
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP Anda"
                           required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Masukkan kata sandi" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

            <div class="mt-3 text-center">
                <small>Belum punya akun? Hubungi admin.</small>
            </div>
        </div>
    </main>
@endsection
