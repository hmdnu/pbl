@extends('layouts.admin')

@section('title', 'Manajemen Profesi')

@section('admin-content')

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-create">Tambah Item</button>

    <x-modal-form id="create" :action="url('/profession')" method="POST" title="Tambah Item">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text">Kategori Id</span>
            <input type="text" class="form-control" name="category_id" placeholder="Kategori id" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" class="form-control" name="name" placeholder="Nama" required>
        </div>
    </x-modal-form>

    @include('profession.table')
@endsection
