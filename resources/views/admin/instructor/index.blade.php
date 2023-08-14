@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('instructor.create') }}" role="button">Tambah</a>
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
                            {{-- <a class="btn btn-primary" href="{{ route('instructor.show', ['instructor' => $instructor->id]) }}"
                                role="button">Lihat</a>
                            <a class="btn btn-warning" href="{{ route('instructor.edit', ['instructor' => $instructor->id]) }}"
                                role="button">Ubah</a> --}}
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
