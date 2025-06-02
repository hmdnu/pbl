@php use Carbon\Carbon; @endphp
<table class="table">
    <thead>
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Tanggal Lulus</th>
        <th>Program Studi</th>
        <th>Isi Survey</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->nim }}</td>
            <td>{{ $student->name }}</td>
            <td>
                @php
                    Carbon::setLocale('id');
                   $date = Carbon::parse($student->graduation_date)->translatedFormat('d F Y');
                @endphp
                {{ $date }}
            </td>
            <td>{{ $student->programStudy->name ?? '-' }}</td>
            <td>
                @if ($student->has_filled_survey)
                    <span class="badge bg-success">Sudah</span>
                @else
                    <span class="badge bg-secondary">Belum</span>
                @endif
            </td>
            <td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modal-form-{{ $student->nim }}">
                    Edit
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modal-confirm-{{ $student->nim }}">
                    Hapus
                </button>

                {{-- Modal Edit --}}
                <x-modal-form :id="$student->nim" title="Edit Mahasiswa" :action="url('/student/' . $student->nim)"
                              method="PATCH">
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" value="{{ $student->nim }}">
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lulus</label>
                        <input type="date" class="form-control" name="graduation_date"
                               value="{{ $student->graduation_date }}">
                    </div>
                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="program_study_id" class="form-select">
                            @foreach ($program_studies as $ps)
                                <option value="{{ $ps->id }}"
                                    {{ $ps->id == $student->program_study_id ? 'selected' : '' }}>
                                    {{ $ps->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </x-modal-form>

                {{-- Modal Delete --}}
                <x-modal-confirm :id="$student->nim" title="Hapus Mahasiswa: {{ $student->name }}"
                                 :action="url('/student/' . $student->nim)"
                                 method="DELETE" />
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
