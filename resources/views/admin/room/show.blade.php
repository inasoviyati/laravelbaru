@extends('layouts.auth')

@section('title', 'Kelas')
@section('action', "Kelas {$room->name}")

@section('content')
    <table id="dataTable" class="display nowrap" width="100%">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th width="1%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->npm }}</td>
                    <td>{{ $student->name }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary" href="{{ route('student.show', ['student' => $student->id]) }}"
                            role="button">Lihat</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('room.index') }}" class="btn btn-light">Kembali</a>
    </div>
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
