@php
    // data dummy
    $dummy = [
        [
            'id' => '1',
            'name' => 'ujang',
        ],
        [
            'id' => '2',
            'name' => 'tatang',
        ],
        [
            'id' => '3',
            'name' => 'asep',
        ],
    ];
@endphp


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dummy as $d)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $d['name'] }}</td>
                <td>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-form-{{ $d['id'] }}">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-target="#modal-confirm-{{ $d['id'] }}"
                            data-bs-toggle="modal">Delete</button>

                        {{-- modal buat edit form --}}
                        <x-modal-form :id="$d['id']" title="Edit item" :action="url('/test-crud/' . $d['id'])" method="PATCH">
                            {{-- per item --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nama</span>
                                <input type="text" class="form-control" placeholder="Nama"
                                    value="{{ $d['name'] }}">
                            </div>
                        </x-modal-form>

                        {{-- modal buat delete form --}}
                        <x-modal-confirm :id="$d['id']" title="Delete item {{ $d['name'] }}" :action="url('/test-crud/' . $d['id'])"
                            method="DELETE" />
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
