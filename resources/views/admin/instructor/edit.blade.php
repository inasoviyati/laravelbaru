@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@section('content')
    <form method="post" action="{{ route('instructor.update', ['instructor' => $instructor->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="form-group mb-3 col-md-4">
            <label for="npm">NPM</label>
            <input id="npm" name="npm" class="form-control" value="{{ $instructor->npm }}" minlength="8" maxlength="8" required>
            @error('npm')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-8">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $instructor->name }}" minlength="2" maxlength="50" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="room">Kelas</label>
            <select id="room" name="room" class="form-select" class="form-select" required>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room', $instructor->roomUser->room->id) == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
            @error('room')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-5">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $instructor->email }}" minlength="8" maxlength="100" required>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" minlength="8" maxlength="50" class="form-control">
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <div class="small text-muted mt-1">kosongkan untuk tidak mengubah password</div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('instructor.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Ubah</button>
        </div>
    </form>
@endsection
