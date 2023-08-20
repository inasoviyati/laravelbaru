@extends('layouts.auth')

@push('title', $title)
@push('header', 'Detil ' . $title)

@section('content')
<div class="row">
    <div class="form-group mb-3 col-md-4">
        <label for="npm">NPM</label>
        <input class="form-control" value="{{ $student->npm }}" required disabled>
    </div>

    <div class="form-group mb-3 col-md-8">
        <label for="name">Nama</label>
        <input type="text" class="form-control" value="{{ $student->name }}" required disabled>
    </div>

    <div class="form-group mb-3 col-md-3">
        <label for="room">Kelas</label>
        <select class="form-select select2" required disabled>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" {{ $student->roomUser->room->id == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3 col-md-5">
        <label for="email">Alamat surel</label>
        <input type="text" class="form-control" value="{{ $student->email }}" required disabled>
    </div>

    <div class="form-row">

        <div class="form-group mb-3 col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="instructor" name="is_instructor" {{ $student->role == 'instructor' ? 'checked' : '' }} disabled>
                <label class="form-check-label" for="instructor">
                    Atur sebagai Instruktur
                </label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('student.index') }}" class="btn btn-light">Kembali</a>
        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">Ubah</a>
    </div>
</div>
@endsection
