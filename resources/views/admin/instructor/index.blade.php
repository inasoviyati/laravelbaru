@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->npm ?? '-' }}</td>
                    <td>{{ $instructor->name }}</td>
                    <td>{{ $instructor->email }}</td>
                    <td>{{ $instructor->roomUser->room->name ?? '-' }}</td>
                    <td class="text-end">
                        @if($instructor->role == 'admin')
                        -
                        @else
                        <form action="{{ route('instructor.destroy', ['instructor' => $instructor->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                columnDefs: [{
                    targets: 4,
                    orderable: false,
                    searchable: false
                }],
                pageLength: 50,
                order: [
                    [3, 'asc'],
                    [1, 'asc']
                ]
            });
        });
    </script>
@endpush
