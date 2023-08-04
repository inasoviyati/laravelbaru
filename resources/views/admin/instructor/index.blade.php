@extends('layouts.auth')

@section('title', 'Instruktur')
@section('action', 'Daftar Instruktur')

@section('content')
@if (session('status'))
<div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">{{ session('status') }}</div>
@endif
    
    <div class="mb-3 text-end">
        <a class="btn btn-success" href="{{ route('instructor.create') }}" role="button">Tambah</a>
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
            @foreach ($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->name }}</td>
                    <td>{{ $instructor->email }}</td>
                    <td class="text-end">
                        <form action="{{ route('instructor.destroy', ['instructor' => $instructor->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{ route('instructor.show', ['instructor' => $instructor->id]) }}"
                                role="button">Tampil</a>
                            <a class="btn btn-warning" href="{{ route('instructor.edit', ['instructor' => $instructor->id]) }}"
                                role="button">Ubah</a>
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
