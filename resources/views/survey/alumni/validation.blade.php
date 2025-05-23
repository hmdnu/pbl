@extends('layouts.app')

@section('title', 'Formulir Survei Alumni')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Validasi Alumni</h5>
                <form action="{{ route('post.alumni.send-email', ['role' => 'alumni']) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan alamat email Anda" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @if (session('message'))
                        <p class="text-info mt-1">{{ session('message') }}</p>
                    @endif
                    @error('error')
                        <div class="mb-3">
                            <p class="text-danger text-center">{{ $message }}</p>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
