@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@section('content')
    <form method="post" action="{{ route('subject.update', ['subject' => $subject->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3 col-md-6">
            <label for="alias">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $subject->name }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-md-6">
            <label for="alias">Alias</label>
            <input type="text" id="alias" name="alias" class="form-control" value="{{ $subject->alias }}">
            @error('alias')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('subject.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
    </form>
@endsection
