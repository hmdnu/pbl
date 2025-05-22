@extends('layouts.admin')

@section('title', 'progamStudy')

@section('admin-content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-create">Add Item</button>

    <x-modal-form id="create" :action="url('/study-program')" method="POST" title="Add item">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" class="form-control" placeholder="Name" name="name" required>
        </div>
    </x-modal-form>

    @include('admin.program_study.table')
@endsection
