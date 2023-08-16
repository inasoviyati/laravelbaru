@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@push('action')
    <div class="text-end">
        <form action="{{ route('assignment.destroy', ['assignment' => $assignment->id, 'shift' => $shift, 'day' => $day]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
@endpush

@section('content')
    <form method="post" action="{{ route('assignment.update', ['shift' => $shift, 'day' => $day, 'assignment' => $assignment->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="form-group mb-3 col-md-4">
            <label for="day">Hari</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="day" value="{{ $dayName }}">
            @error('day')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Shift</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->name }}">
            @error('shift')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Waktu</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->timeFormated('time_start') . ' - ' . $shift->timeFormated('time_end') }}">
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="name">Mata Kuliah</label>
            <select name="subject" id="subject" class="form-select">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $assignment->subject_id == old('subject', $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="name">Instruktur</label>
            <select name="instructor" id="instructor" class="form-select">
                @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ $assignment->instructor_id == old('instructor', $instructor->id) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('assignment.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
    </form>

    <div class="modal fade" id="modalStudents" tabindex="-1" aria-labelledby="modalStudents" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Pilih Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="dataTableStudents" class="display nowrap" width="100%">
                        <thead class="bg-light">
                            <tr>
                                <th>NPM</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('others')
    <div class="content pt-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title my-auto">Daftar Mahasiswa</div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalStudents">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dataTableAssigned" class="display nowrap" width="100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th width="1%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTableAssigned').DataTable({
                responsive: true,
                columnDefs: [{
                    targets: 4,
                    orderable: false,
                    searchable: false
                }],
                pageLength: 50,
                order: [2, 'asc']
            });
        });

        $(document).ready(function() {
            $('#dataTableStudents').DataTable({
                responsive: true,
                pageLength: 50,
                order: [1, 'asc']
            });
        });
    </script>
@endpush
