@extends('layouts.auth')

@section('title', 'Mahasiswa')
@section('action', 'Rincian Mahasiswa')

@section('content')
    <form method="post" action="{{ route('student.store') }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-6">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $student->name }}" disabled>
        </div>
        
        <div class="form-group mb-3 col-md-6">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ $student->email }}" disabled>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('student.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </form>
@endsection
