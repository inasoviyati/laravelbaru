@extends('layouts.auth')

@section('title', 'Kelas')
@section('action', 'Rincian kelas')

@section('content')
    <form method="post" action="{{ route('room.update', ['room' => $room->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3 col-md-6">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $room->name }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('room.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
