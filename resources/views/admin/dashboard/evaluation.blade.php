@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Dashboard Penilaian</h1>
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
</div>

<h2>Grafik Penilaian Kepuasan</h2>
<div class="row">
    @foreach (['teamwork', 'it_expertise', 'foreign_language', 'communication', 'self_development', 'leadership', 'work_ethic'] as $criteria)
    <div class="col-md-6 mb-4">
        <h5>{{ ucfirst(str_replace('_', ' ', $criteria)) }}</h5>
        <canvas id="chart-{{ $criteria }}" width="400" height="300"></canvas>
    </div>
    @endforeach
</div>

<h2>Penilaian Kepuasan Pengguna Lulusan</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Kemampuan</th>
                <th>Sangat Baik</th>
                <th>Baik</th>
                <th>Cukup</th>
                <th>Kurang</th>
            </tr>
        </thead>
        <tbody id="rekap-table-body">
            {{-- Data akan dimuat oleh JavaScript --}}
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard/evaluation.js') }}"></script>
@endsection
