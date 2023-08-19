@extends('layouts.auth')

@push('title', $title)
@push('header', 'Tambah ' . $title)

@section('content')

    <form method="post" action="{{ route('room.store') }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('room.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
@endsection
