@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('facility.create') }}" role="button">Tambah</a>
    </div>
@endpush

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilities as $facility)
                <tr>
                    <td>{{ $facility->id }}</td>
                    <td>{{ $facility->name }}</td>
                    <td>{{ $facility->description }}</td>
                    <td class="text-end">
                        <form action="{{ route('facility.destroy', ['facility' => $facility->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-warning" href="{{ route('facility.edit', ['facility' => $facility->id]) }}" role="button">Ubah</a>
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
                order: [1, 'asc']
            });
        });
    </script>
@endpush
