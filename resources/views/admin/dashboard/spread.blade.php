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
        <div>
            <h4>Sebaran profesi lulusan</h4>
            <canvas class="w-100" id="sebaran-institusi" width="400" height="100"></canvas>
        </div>
    </section>

    {{-- table --}}
    <section class="mt-5">
        <h2>Tabel Sebaran Lingkup Tempat Kerja dan Kesesuaian Profesi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Header</th>
                        <th scope="col">Header</th>
                        <th scope="col">Header</th>
                        <th scope="col">Header</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </section>
    </div>
    @vite('resources/js/dashboard/spread.js')
@endsection
