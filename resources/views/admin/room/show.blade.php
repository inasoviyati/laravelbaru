@extends('layouts.auth')

@section('title', 'Kelas')
@section('action', 'Rincian kelas')

@section('content')
    <div class="form-group mb-3 col-md-6">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $room->name }}" disabled>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('room.index') }}" class="btn btn-light">Kembali</a>
    </div>
@endsection
