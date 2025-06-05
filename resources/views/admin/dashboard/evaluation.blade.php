@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Dashboard Evaluasi Kompetensi Lulusan</h1>
</section>

<form method="GET" action="{{ route('dashboard.evaluation') }}" class="row g-3 mb-4">
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
    <div class="row">
        <div class="col-md-12 mb-4" id="chart-area">
            @foreach ([
                'teamwork' => 'Kerjasama Tim',
                'it_expertise' => 'Keahlian TI',
                'foreign_language' => 'Bahasa Asing',
                'communication' => 'Komunikasi',
                'self_development' => 'Pengembangan Diri',
                'leadership' => 'Kepemimpinan',
                'work_ethic' => 'Etos Kerja'
            ] as $key => $label)
                <div class="mb-4">
                    <h5>{{ $label }}</h5>
                    <canvas class="w-100" id="chart-{{ $key }}" height="200"></canvas>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tabel --}}
<section class="mt-5">
    <h2>Tabel Rekap Evaluasi Kompetensi</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Aspek</th>
                    <th scope="col">Sangat Baik</th>
                    <th scope="col">Baik</th>
                    <th scope="col">Cukup</th>
                    <th scope="col">Kurang</th>
                </tr>
            </thead>
            <tbody id="rekap-table-body">
                <tr>
                    <td colspan="6" class="text-center text-secondary">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

{{-- Include JS --}}
@vite('resources/js/dashboard/evaluation.js')

@endsection
