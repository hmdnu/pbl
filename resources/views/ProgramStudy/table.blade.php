<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($programstudies as $programstudy)
            <tr>
                <td>{{ $programstudy->id }}</td>
                <td>{{ $programstudy->name }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-{{ $programstudy->id }}">
                        Edit
                    </button>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-{{ $programstudy->id }}">
                        Delete
                    </button>

                    <!-- Modal Edit -->
                    <x-modal-form 
                        :id="$programstudy->id" 
                        title="Edit item" 
                        :action="url('/program-study/' . $programstudy->id)" 
                        method="PATCH">

                        @csrf
                        @method('PATCH')

                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" value="{{ $programstudy->name }}" required>
                        </div>
                    </x-modal-form>

                    <!-- Modal Delete Confirmation -->
                    <x-modal-confirm 
                        :id="$programstudy->id" 
                        title="Delete item {{ $programstudy->id }}" 
                        :action="url('/program-study/' . $programstudy->id)" 
                        method="DELETE" />

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
