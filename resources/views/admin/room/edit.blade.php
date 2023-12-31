@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@section('content')
    <form method="post" action="{{ route('room.update', ['room' => $room->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $room->name }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('room.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
    </form>
@endsection
