@extends('layouts.auth')

@section('title', 'Dashboard')
@section('action', 'Dashboard')

@section('content')
    <h3 class="mb-3 text-center">Daftar Kehadiran Instruktur</h3>
    <h4 class="mb-4 text-muted text-center">{{ $instructorAttendance->name }}</h4>
    <hr>
    @if ($assignments->count() == 0)
        <table class="table" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    @for ($i = 1; $i <= 9; $i++)
                        <th class="text-center">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center" colspan="12">No data available</td>
                </tr>
            </tbody>
        </table>
    @else
        <table id="dataTable" class="display nowrap" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    @for ($i = 1; $i <= 9; $i++)
                        <th class="text-center">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    @php
                        $meets = App\Models\Attendance::whereHas('meet', function ($query) use ($assignment) {
                            $query->where('assignment_id', $assignment->id);
                        })->get();

                        $meetIds = $meets->unique('meet_id')->pluck('meet_id')->toArray();

                        $counter = count($meetIds);
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assignment->subject->name }}</td>
                        <td>{{ $assignment->assignmentStudents->first()->user->roomUser->room->name }}</td>
                        @for ($i = 1; $i <= 9; $i++)
                            @if ($i <= $counter)
                                <td class="text-center text-success">
                                    <i class="align-middle" data-feather="check"></i>
                                </td>
                            @else
                                <td class="text-center text-danger">
                                    <i class="align-middle" data-feather="x"></i>
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@push('js')
    @if ($assignments->count() > 0)
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [3, 4, 5, 6, 7, 8, 9, 10, 11],
                        orderable: false,
                        searchable: false
                    }],
                    pageLength: 10,
                    order: [1, 'asc']
                });
            });
        </script>
    @endif
@endpush
