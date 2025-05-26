@extends('layouts.app')

@section('title', 'Tracer Study Polinema')

@section('content')

<section class="hero position-relative text-center d-flex align-items-center justify-content-center text-white" style="min-height: 100vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/img/polinema.png') no-repeat center center/cover;">
    <div class="position-absolute top-0 start-0 p-3 d-flex align-items-center">
        <img src="/img/logo_polinema.png" alt="Logo Polinema" class="header-logo" style="height: 60px;">
        <span class="ms-2 fw-bold">POLITEKNIK NEGERI MALANG</span>
    </div>
    <div class="position-absolute top-0 end-0 p-3">
        <a href="{{ route('dashboard.spread') }}" class="btn btn-sm btn-outline-light fw-semibold border-2">
            <i data-feather="user" class="me-1"></i> Dashboard - Admin
        </a>
    </div>
    <div class="container mt-5">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Selamat Datang di Tracer Study Polinema</h1>
        <p class="lead animate__animated animate__fadeInUp">Kami menghargai perjalanan alumni untuk meningkatkan kualitas pendidikan.</p>
        <div class="mt-5 d-flex flex-column flex-md-row justify-content-center align-items-center gap-4 animate__animated animate__zoomIn">
            <a href="{{ route('view.alumni.validation') }}" class="btn btn-warning btn-lg px-5 shadow"> Survey Alumni</a>
            <a href="{{ route('view.alumni-user.agreement') }}" class="btn btn-outline-light btn-lg px-5 border-3"> Survey Pengguna Alumni</a>
        </div>
    </div>
</section>

<!-- Profil Singkat Polinema -->
<section class="container py-5">
    <h2 class="section-title text-center mb-4">Profil Singkat Polinema</h2>
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="/img/graduation.png" class="img-fluid rounded-4 shadow" alt="Kampus Polinema">
        </div>
        <div class="col-md-6">
            <p><strong>Politeknik Negeri Malang (Polinema)</strong> merupakan perguruan tinggi vokasi terkemuka di Indonesia yang berdiri sejak tahun 1982. Polinema berkomitmen mencetak lulusan yang kompeten dan siap kerja melalui pendekatan pendidikan terapan berbasis industri.</p>
            <ul class="list-unstyled">
                <li><strong>Visi:</strong> Menjadi institusi pendidikan vokasi unggul bertaraf internasional.</li>
                <li><strong>Misi:</strong> Menyelenggarakan pendidikan terapan, penelitian, dan pengabdian kepada masyarakat.</li>
                <li><strong>Keunggulan:</strong> Kurikulum berbasis industri, dosen profesional, serta fasilitas pembelajaran modern.</li>
            </ul>
            <a href="https://www.polinema.ac.id" target="_blank" class="btn btn-gradient-primary d-inline-flex align-items-center gap-2 mt-4 px-4 py-2 rounded-pill shadow-sm">
                <i data-feather="external-link"></i> Kunjungi Website Polinema
            </a>
        </div>
    </div>
</section>

<!-- Apa itu Tracer Study -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Apa Itu Tracer Study?</h2>
        <p class="text-center fs-5 mb-5">Tracer Study adalah survei yang ditujukan kepada alumni untuk mengetahui perjalanan karier mereka setelah menyelesaikan studi di Polinema.</p>
        <div class="row text-center">
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <i data-feather="target" class="icon-lg text-primary mb-3"></i>
                <h5 class="fw-bold">Tujuan</h5>
                <p>Mengumpulkan data karier alumni guna mendukung evaluasi dan peningkatan kualitas pendidikan.</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <i data-feather="users" class="icon-lg text-success mb-3"></i>
                <h5 class="fw-bold">Peserta</h5>
                <p>Alumni Polinema yang telah lulus minimal satu tahun sebelumnya.</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <i data-feather="alert-circle" class="icon-lg text-warning mb-3"></i>
                <h5 class="fw-bold">Pentingnya Tracer</h5>
                <p>Data alumni menjadi dasar pengambilan kebijakan akademik dan pengembangan kurikulum yang relevan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Manfaat Tracer Study -->
<section class="container py-5">
    <h2 class="section-title text-center mb-5">Manfaat Tracer Study</h2>
    <div class="row text-center">
        <div class="col-md-4 mb-4" data-aos="zoom-in">
            <i data-feather="award" class="icon-lg text-info mb-3"></i>
            <h5 class="fw-bold">Untuk Kampus</h5>
            <p>Menilai relevansi kurikulum dengan kebutuhan dunia kerja, mendukung akreditasi, serta mendorong inovasi pendidikan.</p>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
            <i data-feather="user-check" class="icon-lg text-secondary mb-3"></i>
            <h5 class="fw-bold">Untuk Alumni</h5>
            <p>Menjaga keterhubungan dengan kampus dan menunjukkan kontribusi alumni di dunia profesional.</p>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
            <i data-feather="briefcase" class="icon-lg text-success mb-3"></i>
            <h5 class="fw-bold">Untuk Industri</h5>
            <p>Menjadi referensi dalam merekrut lulusan berkualitas dan sesuai dengan tuntutan dunia kerja.</p>
        </div>
    </div>
</section>
