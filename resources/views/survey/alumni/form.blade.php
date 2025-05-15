@extends('layouts.app')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card w-100 p-3">
            <h4 class="mb-0 text-center">Formulir Survei Alumni</h4>

            <div class="card-body bg-light">
                <form action="/survey/alumni/form" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone</label>
                        <input type="text" name="no_hp" class="form-control"
                            placeholder="Masukkan nomor handphone Anda">
                    </div>

                    <div class="mb-3">
                        <label for="kategori_profesi" class="form-label">Kategori Profesi</label>
                        <select name="kategori_profesi" class="form-select">
                            <option selected disabled>Pilih kategori profesi</option>
                            <option value="infokom">Bidang Infokom</option>
                            <option value="non-infokom">Bidang Non-Infokom</option>
                            <option value="belum">Belum Bekerja</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_profesi" class="form-label">Nama Profesi</label>
                        <input type="text" name="nama_profesi" class="form-control" placeholder="Masukkan nama profesi">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kerja" class="form-label">Tanggal Mulai Bekerja</label>
                        <input type="date" name="tanggal_kerja" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="masa_tunggu" class="form-label">Masa Tunggu (bulan)</label>
                        <input type="number" name="masa_tunggu" class="form-control" placeholder="Contoh: 3">
                    </div>

                    <div class="mb-3">
                        <label for="jenis_instansi" class="form-label">Jenis Instansi</label>
                        <select name="jenis_instansi" class="form-select">
                            <option selected disabled>Pilih jenis instansi</option>
                            <option value="pt">Pendidikan Tinggi</option>
                            <option value="pemerintah">Instansi Pemerintah</option>
                            <option value="bumn">BUMN</option>
                            <option value="swasta">Perusahaan Swasta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control"
                            placeholder="Masukkan nama instansi">
                    </div>

                    <div class="mb-3">
                        <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                        <input type="text" name="alamat_instansi" class="form-control"
                            placeholder="Masukkan alamat instansi">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_masuk_instansi" class="form-label">Tanggal Masuk Instansi</label>
                        <input type="date" name="tanggal_masuk_instansi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="nama_atasan" class="form-label">Nama Atasan Langsung</label>
                        <input type="text" name="nama_atasan" class="form-control"
                            placeholder="Masukkan nama atasan langsung">
                    </div>

                    <div class="mb-3">
                        <label for="jabatan_atasan" class="form-label">Jabatan Atasan Langsung</label>
                        <input type="text" name="jabatan_atasan" class="form-control"
                            placeholder="Masukkan jabatan atasan langsung">
                    </div>

                    <div class="mb-4">
                        <label for="email_atasan" class="form-label">Email Atasan Langsung</label>
                        <input type="email" name="email_atasan" class="form-control"
                            placeholder="Masukkan email atasan langsung">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
