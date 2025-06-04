@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
<section
    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Dashboard Sebaran</h1>
</section>

<form method="GET" action="{{ route('dashboard.spread') }}" class="row g-3 mb-4">
    {{-- Program Studi --}}
    <div class="col-md-3">
        <label for="prodi" class="form-label">Program Studi</label>
        <select name="prodi" id="prodi" class="form-select">
            <option value="">Semua Program Studi</option>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}" {{ request('prodi') == $program->id ? 'selected' : '' }}>
                    {{ $program->name }}
                </option>
            @endforeach
        </select>
    </div>
    {{-- Tahun Lulus --}}
    <div class="col-md-3">
        <label for="tahun" class="form-label">Tahun Lulus</label>
        <select name="tahun" id="tahun" class="form-select">
            <option value="">Semua Tahun</option>
            @php $tahunSekarang = date('Y'); @endphp
            @for ($i = $tahunSekarang; $i > $tahunSekarang - 4; $i--)
                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
    {{-- Tombol Submit --}}
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
    </div>
</form>

{{-- Grafik --}}
<section class="mt-5">
    <div class="mb-4">
        <h4>Sebaran Profesi Lulusan</h4>
        <canvas class="w-100" id="sebaran-profesi-lulusan" width="400" height="100"></canvas>
    </div>
    <div>
        <h4>Sebaran Institusi Tempat Kerja Lulusan</h4>
        <canvas class="w-100" id="sebaran-institution-type" width="400" height="100"></canvas>
    </div>
</section>

{{-- Tabel --}}
<section class="mt-5">
    <h2>Tabel Sebaran Lingkup Tempat Kerja dan Kesesuaian Profesi</h2>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="spread-table">
                    <thead class="table-light">
                        <tr>
                            <th rowspan="2" class="text-center">Tahun Lulus</th>
                            <th rowspan="2" class="text-center">Jumlah Lulusan</th>
                            <th rowspan="2" class="text-center">Jumlah Lulusan Yang Terlacak</th>
                            <th rowspan="2" class="text-center">Profesi Kerja Bidang Infokom</th>
                            <th rowspan="2" class="text-center">Profesi Kerja Bidang Non Infokom</th>
                            <th colspan="3" class="text-center">Lingkup Tempat Kerja</th>
                        </tr>
                        <tr>
                            <th class="text-center">Multinasional/Internasional</th>
                            <th class="text-center">Nasional</th>
                            <th class="text-center">Wirausaha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center text-secondary">Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- Include JS --}}
@vite('resources/js/dashboard/spread.js')

{{-- Fetch data table --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        const prodi = params.get("prodi") ?? "";
        const tahun = params.get("tahun") ?? "";

        const tbody = document.querySelector("#spread-table tbody");
        tbody.innerHTML = `<tr><td colspan="8" class="text-center text-secondary">Memuat data...</td></tr>`;

        fetch(`/dashboard/data/spread-table?prodi=${prodi}&tahun=${tahun}`)
            .then(res => res.json())
            .then(data => {
                tbody.innerHTML = "";
                if (!data.length) {
                    tbody.innerHTML = `<tr><td colspan="8" class="text-center text-muted">Data tidak ditemukan.</td></tr>`;
                    return;
                }

                data.forEach(item => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${item.tahun_lulusan ?? '-'}</td>
                            <td>${item.jumlah_lulusan ?? '-'}</td>
                            <td>${item.jumlah_lulusan_yg_terlacak ?? '-'}</td>
                            <td>${item.jumlah_profesi_infokom ?? '-'}</td>
                            <td>${item.jumlah_profesi_non_infokom ?? '-'}</td>
                            <td>${item.institution_scale_internasional ?? '-'}</td>
                            <td>${item.institution_scale_nasional ?? '-'}</td>
                            <td>${item.institution_scale_wirausaha ?? '-'}</td>
                        </tr>`;
                });
            })
            .catch(error => {
                console.error("Gagal mengambil data spread table:", error);
                tbody.innerHTML =
                    `<tr><td colspan="8" class="text-center text-danger">Gagal mengambil data.</td></tr>`;
            });
    });

</script>
@endpush
@endsection
