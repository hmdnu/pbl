@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Dashboard Masa Tunggu</h1>
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

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Data Masa Tunggu Alumni</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="waiting-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tahun Lulus</th>
                        <th>Jumlah Lulusan</th>
                        <th>Jumlah Lulusan Yang Terlacak</th>
                        <th>Masa Tunggu (bulan)</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("{{ route('dashboard.data.wait-periode') }}")
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector("#waiting-table tbody");
                tbody.innerHTML = ""; // bersihkan isi sebelumnya
                data.forEach((item, index) => {
                    const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.tahun_lulusan}</td>
                        <td>${item.jumlah_lulusan}</td>
                        <td>${item.jumlah_lulusan_yg_terlacak}</td>
                        <td>${item.rata2_masa_tunggu ?? '-'}</td>
                    </tr>
                `;
                    tbody.innerHTML += row;
                });
            });
    });
</script>
@endsection
