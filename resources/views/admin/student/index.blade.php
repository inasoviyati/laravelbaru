@extends('layouts.auth')

@section('title', 'Mahasiswa')
@section('action', 'Daftar Mahasiswa')

@section('content')
@if (session('status'))
<div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">{{ session('status') }}</div>
@endif
    
    <div class="mb-3 text-end">
        <a class="btn btn-success" href="{{ route('student.create') }}" role="button">Tambah</a>
    </div>

    <table border="1" class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td class="text-end">
                        <form action="{{ route('student.destroy', ['student' => $student->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('student.show', ['student' => $student->id]) }}"
                                role="button">Tampil</a>
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
