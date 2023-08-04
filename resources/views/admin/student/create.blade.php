@extends('layouts.auth')

@section('title', 'Mahasiswa')
@section('action', 'Tambah Mahasiswa')

@section('content')

    <form method="post" action="{{ route('student.store') }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('student.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection
