@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="p-4 rounded shadow" style="background-color: #b3b3b3; width: 100%; max-width: 600px;">
        <h2 class="text-center mb-4 text-white">Formulir Survey Alumni</h2>

        <form action="{{ route('alumni.survey.submit') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="nama" class="text-white">Name</label>
                <input type="text" name="nama" class="form-control bg-light border-0" placeholder="">
            </div>

            <div class="form-group mb-3">
                <label for="nim" class="text-white">NIM</label>
                <input type="text" name="nim" class="form-control bg-light border-0" placeholder="">
            </div>

            <div class="form-group mb-3">
                <label for="email" class="text-white">Email</label>
                <input type="email" name="email" class="form-control bg-light border-0" placeholder="">
            </div>

            <div class="form-group mb-3">
                <label for="no_hp" class="text-white">No Handphone</label>
                <input type="text" name="no_hp" class="form-control bg-light border-0" placeholder="">
            </div>

            <div class="form-group mb-3">
                <label for="kategori_profesi" class="text-white">Profession Category</label>
                <select name="kategori_profesi" class="form-select bg-light border-0">
                    <option selected disabled>Profession Category</option>
                    <option value="infokom">Bidang Infokom</option>
                    <option value="non-infokom">Bidang Non Infokom</option>
                    <option value="belum">Belum Bekerja</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="nama_profesi" class="text-white">Profession Name</label>
                <input type="text" name="nama_profesi" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_kerja" class="text-white">Date of First Employment</label>
                <input type="date" name="tanggal_kerja" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="masa_tunggu" class="text-white">Waiting Period</label>
                <input type="number" name="masa_tunggu" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="jenis_instansi" class="text-white">Type of Institution</label>
                <select name="jenis_instansi" class="form-select bg-light border-0">
                    <option selected disabled>Type of Institution</option>
                    <option value="pt">Pendidikan Tinggi</option>
                    <option value="pemerintah">Instansi Pemerintah</option>
                    <option value="bumn">BUMN</option>
                    <option value="swasta">Perusahaan Swasta</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="nama_instansi" class="text-white">Institution Name</label>
                <input type="text" name="nama_instansi" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="alamat_instansi" class="text-white">Institution Address</label>
                <input type="text" name="alamat_instansi" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_masuk_instansi" class="text-white">Date of First Work at the Institution</label>
                <input type="date" name="tanggal_masuk_instansi" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="nama_atasan" class="text-white">Name of Immediate Supervisor</label>
                <input type="text" name="nama_atasan" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-3">
                <label for="jabatan_atasan" class="text-white">Position of Direct Supervisor</label>
                <input type="text" name="jabatan_atasan" class="form-control bg-light border-0">
            </div>

            <div class="form-group mb-4">
                <label for="email_atasan" class="text-white">Direct Supervisor Email</label>
                <input type="email" name="email_atasan" class="form-control bg-light border-0">
            </div>

            <button type="submit" class="btn btn-dark w-100">Submit</button>
        </form>
    </div>
</div>
@endsection
