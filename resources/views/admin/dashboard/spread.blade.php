@extends('layouts.admin')

@section('title', 'Admin Dahsboard')


@section('admin-content')
<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Dashboard Sebaran</h1>
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
    <div>
        <h4>Sebaran profesi lulusan</h4>
        <canvas class="w-100" id="sebaran-profesi-lulusan" width="400" height="100"></canvas>
    </div>
</section>

{{-- table --}}
<section class="mt-5">
    <h2>Tabel Sebaran Lingkup Tempat Kerja dan Kesesuaian Profesi</h2>
    <div class="card shadow-sm mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="spread-table">
                    <thead class="table-light">
                        <tr>
                            <th rowspan="2" style="text-align: center;">Tahun Lulus</th>
                            <th rowspan="2" style="text-align: center;">Jumlah Lulusan</th>
                            <th rowspan="2" style="text-align: center;">Jumlah Lulusan Yang Terlacak</th>
                            <th rowspan="2" style="text-align: center;">Profesi Kerja Bidang Infokom</th>
                            <th rowspan="2" style="text-align: center;">Profesi Kerja Bidang Non Infokom</th>
                            <th colspan="3" style="text-align: center;">Lingkup Tempat Kerja</th>
                        </tr>
                        <tr>
                            <th>Multinasional/Internasional</th>
                            <th>Nasional</th>
                            <th>Wirausaha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- data akan diisi dengan JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@vite('resources/js/dashboard/spread.js')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        fetch("{{ route('dashboard.data.spread-table') }}")
            .then(res => res.json())
            .then(data => {
                const tbody = document.querySelector("#spread-table tbody");
                tbody.innerHTML = "";
                data.forEach(item => {

                    tbody.innerHTML += `
                    <tr>
                        <td>${item.tahun_lulusan ?? ''}</td>
                        <td>${item.jumlah_lulusan ?? ''}</td>
                        <td>${item.jumlah_lulusan_yg_terlacak ?? ''}</td>
                        <td>${item.jumlah_profesi_infokom ?? ''}</td>
                        <td>${item.jumlah_profesi_non_infokom ?? ''}</td>
                    </tr>`;
                });
            });
    });

</script>
@endsection