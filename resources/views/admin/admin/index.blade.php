@extends('layouts.admin')

@section('title', 'admin')

@section('admin-content')

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-create">Add Item</button>

    <x-modal-form id="create" :action="url('/admin')" method="POST" title="Add item">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">NIP</span>
            <input type="text" class="form-control" placeholder="NIP" name="nip" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nama</span>
            <input type="text" class="form-control" placeholder="Nama" name="name" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Password</span>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
    </x-modal-form>

    @include('admin.admin.table')
@endsection
