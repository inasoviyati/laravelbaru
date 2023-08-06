@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('student.create') }}" role="button">Tambah</a>
    </div>
@endpush

@section('content')
    @if (session('status'))
        <div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">
            {{ session('status') }}</div>
    @endif

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
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->npm }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->roomUser->room->name }}</td>
                    <td class="text-end">
                        <form action="{{ route('student.destroy', ['student' => $student->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('student.show', ['student' => $student->id]) }}"
                                role="button">Lihat</a>
                            <a class="btn btn-warning" href="{{ route('student.edit', ['student' => $student->id]) }}"
                                role="button">Ubah</a>
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
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
                responsive: true
            });
        });
    </script>
@endpush
