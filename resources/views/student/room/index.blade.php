@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
@endpush

@section('content')
    <div class="container px-0">
        <div class="row gx-5">
            @foreach ($rooms as $room)
            <div class="col">
                <div class="p-3 border bg-light">
                    <div class="text-muted">{{ $room->assignment->instructor->name }}</div>
                    <div class="h1">{{ $room->assignment->subject->name }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
