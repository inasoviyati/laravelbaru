@extends('layouts.auth')

@push('title', $title)
@push('header', 'Ubah ' . $title)

@section('content')
    <form method="post" action="{{ route('assignment.update', ['assignment' => $assignment->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $assignment->name }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('assignment.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
