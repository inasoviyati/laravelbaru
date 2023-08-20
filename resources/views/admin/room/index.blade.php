@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('room.create') }}" role="button">Tambah</a>
    </div>
@endpush

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->name }}</td>
                    <td>
                        <a href="{{ route('room.show', ['room' => $room->id]) }}">{{ $room->roomUsers->count() }} orang</a>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('room.destroy', ['room' => $room->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-warning" href="{{ route('room.edit', ['room' => $room->id]) }}"
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
                responsive: true,
                columnDefs: [{
                    targets: 2,
                    orderable: false,
                    searchable: false
                }],
                pageLength: 50,
                order: [0, 'asc']
            });
        });
    </script>
@endpush
