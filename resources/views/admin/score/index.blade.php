@extends('layouts.auth')

@section('title', 'Dashboard')
@section('action', 'Dashboard')

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Jml Mata Kuliah</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($instructors))
                <tr>
                    <td align="center" colspan="4">No data available</td>
                </tr>
            @else
                @foreach ($instructors as $instructor)
                    <tr>
                        <td>{{ $instructor->id }}</td>
                        <td>{{ $instructor->npm }}</td>
                        <td>{{ $instructor->name }}</td>
                        <td class="text-center">{{ $instructor->assignmentStudents->count() }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('score.show', $instructor->id) }}">Show</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [2, 'asc']
            });
        });
    </script>
@endpush
