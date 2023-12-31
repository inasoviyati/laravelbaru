@extends('layouts.auth')

@push('title', $title)
@push('header', 'Tambah ' . $title)

@section('content')

    <form method="post" action="{{ route('facility.store') }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="description">Deskripsi</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ old('description') }}" required>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('facility.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
@endsection
