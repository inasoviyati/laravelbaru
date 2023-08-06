@extends('layouts.auth')

@push('title', $title)
@push('header', 'Detil ' . $title)

@section('content')
<div class="row">
    <div class="form-group mb-3 col-md-4">
        <label for="npm">NPM</label>
        <input class="form-control" value="{{ $instructor->npm }}" required disabled>
    </div>

    <div class="form-group mb-3 col-md-8">
        <label for="name">Nama</label>
        <input type="text" class="form-control" value="{{ $instructor->name }}" required disabled>
    </div>

    <div class="form-group mb-3 col-md-3">
        <label for="room">Kelas</label>
        <select class="form-select select2" required disabled>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" {{ $instructor->roomUser->room->id == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3 col-md-5">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="{{ $instructor->email }}" required disabled>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('instructor.index') }}" class="btn btn-light">Kembali</a>
        <a href="{{ route('instructor.edit', $instructor->id) }}" class="btn btn-warning">Ubah</a>
    </div>
</div>
@endsection
