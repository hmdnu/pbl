<table class="table">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">NIP</th>
        <th scope="col">Nama</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($admins as $admin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $admin->nip}}</td>
            <td>{{ $admin->name}}</td>
            <td>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-form-{{ $admin->nip }}">Edit
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-target="#modal-confirm-{{ $admin->nip }}"
                            data-bs-toggle="modal">Delete
                    </button>

                    {{-- modal buat edit form --}}
                    <x-modal-form :id="$admin->nip" title="Edit item" :action="url('/admin/' . $admin->nip)"
                                  method="PATCH">
                        @csrf
                        @method('PATCH')
                        {{-- per item --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" name="name" value="{{ $admin->name }}"
                                   placeholder="Nama" required>
                        </div>
                    </x-modal-form>

                    {{-- modal buat delete form --}}
                    <x-modal-confirm :id="$admin->nip" title="Delete item {{ $admin->nip }}"
                                     :action="url('/admin/' . $admin->nip)"
                                     method="DELETE" />
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
