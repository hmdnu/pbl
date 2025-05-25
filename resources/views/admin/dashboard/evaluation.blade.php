@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
    <section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Dashboard Evaluasi Kompetensi Lulusan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </section>

    {{-- graphic --}}
    <section class="mt-5">
        <div class="row">
            <div class="col-md-6 mb-4" id="chart-area">
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

    {{-- table --}}
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
                    {{-- Diisi oleh JS --}}
                </tbody>
            </table>
        </div>
    </section>

    @vite('resources/js/dashboard/evaluation.js')
@endsection
