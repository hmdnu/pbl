@extends('layouts.admin')

@section('title', 'test')

@section('admin-content')

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-create">Tambah Item</button>

    <x-modal-form id="create" :action="url('/test-crud')" method="POST" title="Tambah Item">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nama</span>
            <input type="text" class="form-control" placeholder="Nama">
        </div>
    </x-modal-form>

    @include('test-crud.table')
@endsection
