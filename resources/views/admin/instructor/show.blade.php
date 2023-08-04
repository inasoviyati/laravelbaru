@extends('layouts.auth')

@section('title', 'Instruktur')
@section('action', 'Rincian Instruktur')

@section('content')
    <form method="post" action="{{ route('instructor.store') }}" class="row" autocomplete="off">
        @csrf

        <div class="form-group mb-3 col-md-6">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $instructor->name }}" disabled>
        </div>
        
        <div class="form-group mb-3 col-md-6">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ $instructor->email }}" disabled>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('instructor.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </form>
@endsection
