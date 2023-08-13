@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('shift.create') }}" role="button">Tambah</a>
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
                <th>ID</th>
                <th>No</th>
                <th>Mulai</th>
                <th>Nama</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td>{{ $shift->id }}</td>
                    <td>{{ $shift->day }}</td>
                    <td>{{ $shift->time_start }}</td>
                    <td>{{ $shift->name }}</td>
                    <td>{{ $shift->dayLocale }}</td>
                    <td class="text-end">
                        <div class="small text-muted">{{ $shift->diffTime }}</div>
                        {{ date('H:i', strtotime($shift->time_start)) }} - {{ date('H:i', strtotime($shift->time_end)) }}
                    </td>
                    <td class="text-end">
                        <form action="{{ route('shift.destroy', ['shift' => $shift->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('shift.show', ['shift' => $shift->id]) }}" role="button">Lihat</a>
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
                        targets: 6,
                        orderable: false,
                        searchable: false
                    },
                    {
                        target: [1, 2],
                        visible: false,
                        searchable: false
                    }
                ],
                pageLength: 50,
                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ]
            });
        });
    </script>
@endpush
