@extends('layouts.auth')

@section('title', 'Mahasiswa')
@section('action', 'Rincian mahasiswa')

@section('content')
    <form method="post" action="{{ route('student.update', ['student' => $student->id]) }}" class="row" autocomplete="off">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $student->name }}">
        </div>
        
        <div class="form-group mb-3 col-md-6">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ $student->email }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('student.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
