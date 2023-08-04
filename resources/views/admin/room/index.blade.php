@extends('layouts.auth')

@section('title', 'Mahasiswa')
@section('action', 'Daftar semua mahasiswa')

@section('content')
@if (session('status'))
<div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">{{ session('status') }}</div>
@endif
    
    <div class="mb-3 text-end">
        <a class="btn btn-success" href="{{ route('room.create') }}" role="button">Tambah</a>
    </div>

    <table border="1" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td class="text-end">
                        <form action="{{ route('room.destroy', ['room' => $room->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('room.show', ['room' => $room->id]) }}"
                                role="button">Tampil</a>
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
