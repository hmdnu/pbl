@extends('layouts.app')

@section('title', 'Survey Alumni')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card w-100 p-3">
            <h4 class="mb-0 text-center">Formulir Survei Alumni</h4>

            <div class="card-body bg-light">
                <form action="/survey/alumni/form" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control"
                            placeholder="Masukkan NIM Anda">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan alamat email Anda">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Handphone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            placeholder="Masukkan nomor handphone Anda">
                    </div>

                    <div class="mb-3">
                        <label for="profession-category" class="form-label">Kategori Profesi</label>
                        <select name="profession-category" id="profession-category" class="form-select">
                            <option selected disabled>Pilih kategori profesi</option>
                            <option value="infokom">Bidang Infokom</option>
                            <option value="non-infokom">Bidang Non-Infokom</option>
                            <option value="belum">Belum Bekerja</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="profession-name" class="form-label">Nama Profesi</label>
                        <input type="text" name="profession-name" id="profession-name" class="form-control"
                            placeholder="Masukkan nama profesi">
                    </div>

                    <div class="mb-3">
                        <label for="first-work-date" class="form-label">Tanggal Mulai Bekerja</label>
                        <input type="date" name="first-work-date" id="first-work-date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="waiting-period" class="form-label">Masa Tunggu (bulan)</label>
                        <input type="number" name="waiting-period" id="waiting-period" class="form-control"
                            placeholder="Contoh: 3">
                    </div>

                    <div class="mb-3">
                        <label for="institution-type" class="form-label">Jenis Instansi</label>
                        <select name="institution-type" id="institution-type" class="form-select">
                            <option selected disabled>Pilih jenis instansi</option>
                            <option value="pt">Pendidikan Tinggi</option>
                            <option value="pemerintah">Instansi Pemerintah</option>
                            <option value="bumn">BUMN</option>
                            <option value="swasta">Perusahaan Swasta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="institution-name" class="form-label">Nama Instansi</label>
                        <input type="text" name="institution-name" id="institution-name" class="form-control"
                            placeholder="Masukkan nama instansi">
                    </div>

                    <div class="mb-3">
                        <label for="institution-location" class="form-label">Alamat Instansi</label>
                        <input type="text" name="institution-location" id="institution-location" class="form-control"
                            placeholder="Masukkan alamat instansi">
                    </div>

                    <div class="mb-3">
                        <label for="first-institution-work-date" class="form-label">Tanggal Masuk Instansi Saat Ini</label>
                        <input type="date" name="first-institution-work-date" id="first-institution-work-date"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="supervisor-name" class="form-label">Nama Atasan Langsung</label>
                        <input type="text" name="supervisor-name" id="supervisor-name" class="form-control"
                            placeholder="Masukkan nama atasan langsung">
                    </div>

                    <div class="mb-3">
                        <label for="supervisor-position" class="form-label">Jabatan Atasan Langsung</label>
                        <input type="text" name="supervisor-position" id="supervisor-position" class="form-control"
                            placeholder="Masukkan jabatan atasan langsung">
                    </div>

                    <div class="mb-4">
                        <label for="supervisor-email" class="form-label">Email Atasan Langsung</label>
                        <input type="email" name="supervisor-email" id="supervisor-email" class="form-control"
                            placeholder="Masukkan email atasan langsung">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
