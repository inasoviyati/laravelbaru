@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@section('content')
    <form method="post" action="{{ route('shift.update', ['shift' => $shift->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $shift->name) }}">
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="time_start">Mulai</label>
            <input type="text" id="time_start" name="time_start" class="form-control" value="{{ old('time_start', date('H:i', strtotime($shift->time_start))) }}">
            @error('time_start')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="time_end">Selesai</label>
            <input type="text" id="time_end" name="time_end" class="form-control" value="{{ old('time_end', date('H:i', strtotime($shift->time_end))) }}">
            @error('time_end')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('shift.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
    </form>
@endsection
