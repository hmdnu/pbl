@extends('layouts.user')

@section('title', 'Selesai')

@section('user-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title">Selesai Mengisi Survey</h1>
                        <p class="card-text mt-3">Terima kasih telah mengisi survei alumni.</p>
                        <a href="/" class="btn btn-primary mt-4">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
