@extends('layouts.auth')

@push('title', $title)
@push('header', 'Tambah ' . $title)

@section('content')
    <form method="post" action="{{ route('assignment.store', ['shift' => $shift, 'day' => $day]) }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-4">
            <label for="day">Hari</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="day" value="{{ $dayName }}">
            @error('day')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Shift</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->name }}">
            @error('shift')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="shift">Waktu</label>
            <input type="text" readonly class="form-control-plaintext fw-bold" id="shift" value="{{ $shift->timeFormated('time_start') . ' - ' . $shift->timeFormated('time_end') }}">
        </div>


        <div class="form-group mb-3 col-md-6">
            <label for="name">Subject</label>
            <select name="subject" id="subject" class="form-select">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="name">Instructor</label>
            <select name="instructor" id="instructor" class="form-select">
                @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('assignment.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection
