@extends('layouts.auth')

@push('title', $title)
@push('header', 'Tambah ' . $title)

@section('content')
    <form method="post" action="{{ route('assignment.store', ['shift' => $shift, 'day' => $day]) }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-4">
            <label for="day">Hari</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="day" value="{{ $day }}">
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Shift</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->name }}">
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Waktu</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->timeFormated('time_start') . ' - ' . $shift->timeFormated('time_end') }}">
        </div>


        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('assignment.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection
