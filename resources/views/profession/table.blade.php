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
                        @method('PUT')

                        <div class="input-group mb-3">
                            <span class="input-group-text">Kategori</span>
                            <select class="form-select" name="category_id">
                                @foreach($professionCategory as $pc)
                                    @if ($pc->id !== 3)
                                        <option value="{{ $pc->id }}">{{ $pc->name }}</option>
                                    @endif
                                @endforeach
                            </select>
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
