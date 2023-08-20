@extends('layouts.auth')

@push('title', $title)
@push('header', 'Tambah ' . $title)

@section('content')

    <form method="post" action="{{ route('student.store') }}" class="row">
        @csrf

        <div class="form-group mb-3 col-md-4">
            <label for="npm">NPM</label>
            <input type="text" data-mask="00000000" id="npm" name="npm" class="form-control" value="{{ old('npm') }}" required>
            @error('npm')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-8">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" minlength="2" maxlength="50" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-3">
            <label for="room">Kelas</label>
            <select id="room" name="room" class="form-select" value="{{ old('room') }}" required>
                @foreach ($rooms as $room)
                <option value="{{ $room->id }}" {{ old('room') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                @endforeach
            </select>
            @error('room')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-5">
            <label for="email">Alamat surel</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" minlength="8" maxlength="100" required>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-4">
            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password" minlength="8" maxlength="50" class="form-control">
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <div class="small text-muted mt-1">kosongkan untuk atur password acak</div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('student.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $('.select2').select2()
    </script>
@endpush
