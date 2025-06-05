<table class="table">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Kategori</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($professions as $profession)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $profession->category_name }}</td>
            <td>{{ $profession->profession_name }}</td>
            <td>
                <div>
                    {{-- Tombol Edit --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-form-{{ $profession->id }}">Edit
                    </button>

                    {{-- Tombol Delete --}}
                    <button type="button" class="btn btn-danger" data-bs-target="#modal-confirm-{{ $profession->id }}"
                            data-bs-toggle="modal">Delete
                    </button>

                    {{-- Modal Edit --}}
                    <x-modal-form
                        :id="$profession->id"
                        title="Edit item"
                        :action="url('/profession/' . $profession->id)"
                        method="POST"
                    >
                        @csrf
                        @method('PUT') {{-- pakai PUT agar Laravel mengenali update --}}

                        <div class="input-group mb-3">
                            <span class="input-group-text">Kategori Id</span>
                            <input type="text" class="form-control" name="category_id"
                                   value="{{ $profession->category_id }}" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Nama</span>
                            <input type="text" class="form-control" name="name"
                                   value="{{ $profession->profession_name }}" required>
                        </div>
                    </x-modal-form>

                    {{-- Modal Delete --}}
                    <x-modal-confirm
                        :id="$profession->id"
                        title="Delete item {{ $profession->profession_name }}"
                        :action="url('/profession/' . $profession->id)"
                        method="DELETE"
                    />
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
