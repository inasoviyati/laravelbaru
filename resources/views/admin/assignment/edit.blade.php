@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@push('action')
    <div class="text-end">
        <form action="{{ route('assignment.destroy', ['facility' => $facility->id, 'assignment' => $assignment->id, 'shift' => $shift, 'day' => $day]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
@endpush

@section('content')
    <form method="post" action="{{ route('assignment.update', ['shift' => $shift, 'day' => $day, 'assignment' => $assignment->id, 'facility' => $facility->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="form-group mb-3 col-md-3">
            <label for="facility">Fasilitas</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="facility" value="{{ $facility->name }}">
            @error('facility')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="day">Hari</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="day" value="{{ $dayName }}">
            @error('day')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="shift">Shift</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->name }}">
            @error('shift')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
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
            <a href="{{ route('assignment.index', $facility->id) }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
    </form>

    <div class="modal fade" id="modalStudents" tabindex="-1" aria-labelledby="modalStudents" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-row w-100">
                        <div class="form-group col-6 row">
                            <label class="modal-title mb-2 no-wrap col-auto pt-2 fw-bold">Kelas</label>
                            <select id="filterRoomSelect" class="form-select col">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->name }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('assignmentStudent.store', $assignment->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <table id="dataTableStudents" class="display nowrap" width="100%">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="selectAll"></th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="users[]" value="{{ $student->id }}" id="selectAll">
                                        </td>
                                        <td width="1%">{{ $student->npm }}</td>
                                        <td class="text-start">{{ $student->name }}</td>
                                        <td>{{ $student->roomUser->room->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('others')
    <div class="pt-0">
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
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th width="1%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignmentStudents as $assignmentStudent)
                                        <tr>
                                            <td>{{ $assignmentStudent->user->npm }}</td>
                                            <td>{{ $assignmentStudent->user->name }}</td>
                                            <td>{{ $assignmentStudent->roomStudent->room->name }}</td>
                                            <td>
                                                <form action="{{ route('assignmentStudent.destroy', ['facility' => $facility->id, 'assignment' => $assignment->id, 'assignmentStudent' => $assignmentStudent->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" name="" type="submit">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
                    targets: 3,
                    orderable: false,
                    searchable: false
                }],
                pageLength: 50,
                order: [
                    [2, 'asc'],
                    [1, 'asc']
                ]
            });

            var table = $('#dataTableStudents').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderable: false,
                    searchable: false
                }, {
                    targets: [3],
                    searchable: true,
                    visible: false
                }],
                responsive: true,
                pageLength: 50,
                order: [
                    [3, 'asc'],
                    [2, 'asc']
                ]
            });

            $('#filterRoomSelect').on('change', function() {
                var selectedOption = this.value;
                table.column(3).search(selectedOption).draw();
            });

            var initialSelectedOption = $('#filterRoomSelect').val();
            table.column(3).search(initialSelectedOption).draw();

            $('#dataTableStudents tbody').on('click', 'tr', function() {
                var checkbox = $(this).find('input[type="checkbox"]');
                checkbox.prop('checked', !checkbox.prop('checked'));
            });

            $('#dataTableStudents #selectAll').on('click', function() {
                var isChecked = $(this).prop('checked');
                $('#dataTableStudents tbody input[type="checkbox"]').prop('checked', isChecked);
            });
        });
    </script>
@endpush
