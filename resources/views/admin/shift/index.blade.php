@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('shift.create') }}" role="button">Tambah</a>
    </div>
@endpush

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Durasi</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td>{{ $shift->id }}</td>
                    <td>{{ $shift->name }}</td>
                    <td>{{ $shift->timeFormated('time_start') }}</td>
                    <td>{{ $shift->timeFormated('time_end') }}</td>
                    <td>{{ $shift->diffTime }}</td>
                    <td class="text-end">
                        <form action="{{ route('shift.destroy', ['shift' => $shift->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-warning" href="{{ route('shift.edit', ['shift' => $shift->id]) }}" role="button">Ubah</a>
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
                    targets: 5,
                    orderable: false,
                    searchable: false
                }],
                pageLength: 10,
                order: [1, 'asc']
            });
        });
    </script>
@endpush
