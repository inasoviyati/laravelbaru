@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('student.create') }}" role="button">Tambah</a>
    </div>
@endpush

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Alamat surel</th>
                <th>Kelas</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->npm }}</td>
                    <td>
                        {{ $student->name }}
                        @if ($student->role == 'instructor')
                            <span class="text-danger">*</span>
                        @endif
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->roomUser->room->name }}</td>
                    <td class="text-end">
                        <form action="{{ route('student.destroy', ['student' => $student->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('student.show', ['student' => $student->id]) }}" role="button">Lihat</a>
                            <a class="btn btn-warning" href="{{ route('student.edit', ['student' => $student->id]) }}" role="button">Ubah</a>
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-3">
        <span class="text-danger">(*</span> Instruktur
    </div>
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
