@extends('layouts.auth')

@section('title', 'Kelas')
@section('action', 'Daftar semua kelas')

@section('content')
    @if (session('status'))
        <div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">
            {{ session('status') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a class="btn btn-success" href="{{ route('room.create') }}" role="button">Tambah</a>
    </div>

    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->roomUsers->count() }} orang</td>
                    <td class="text-end">
                        <form action="{{ route('room.destroy', ['room' => $room->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('room.show', ['room' => $room->id]) }}"
                                role="button">Lihat</a>
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
                responsive: true
            });
        });
    </script>
@endpush
