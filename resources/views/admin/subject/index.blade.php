@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('subject.create') }}" role="button">Tambah</a>
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
                <th>Nama</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td class="text-end">
                        <form action="{{ route('subject.destroy', ['subject' => $subject->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-warning" href="{{ route('subject.edit', ['subject' => $subject->id]) }}" role="button">Ubah</a>
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
